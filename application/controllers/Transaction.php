<?php

use Midtrans\MidtransSnapTest;

class Transaction extends MY_Controller {

	public $client_key;
	private $server_key;
	public $midtrans_base_url;
	public $midtrans_snap_base_url;


    public function __construct() {
        parent::__construct();

		require_once APPPATH . "libraries/Midtrans/midtrans.php";

		$this->server_key = Midtrans\Config::$serverKey;
		$this->client_key = Midtrans\Config::$clientKey;
		$this->midtrans_base_url = Midtrans\Config::getBaseUrl();
		$this->midtrans_snap_base_url = Midtrans\Config::getSnapBaseUrl();
    }

	public function midtrans_history(){
		$data = array(
			'from_date' => '2024-01-01',
			'to_date' => '2024-02-28'
		);

		$json = json_encode($data);

		// persiapkan curl
		$ch = curl_init(); 

		// set url 
		curl_setopt($ch, CURLOPT_URL, $this->midtrans_base_url."/iris/api/v1/statements");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	
		// return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

		$headers = [
			'Content-Type' => 'application/json',
			'Accept'=> 'application/json',
			'Authorization' => 'Basic '.base64_encode($this->server_key.':')
		];
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		// $output contains the output string 
		$output = curl_exec($ch); 
	
		// tutup curl 
		curl_close($ch);      
	
		// menampilkan hasil curl
		echo $output;
	}

    public function store() {
		$post = $this->input->post();
		$userEmail = $_SESSION['user']['email'];
		$memberId = $this->db->where('email', $userEmail)->get('members')->row_array()['id'];
		$transaction_number = 'INV/'.date('Ymd').'/'.time();

		// insert ke tabel transactions
		$data = [
			'code' => $transaction_number,
			'amount' => str_replace(['Rp ', ','], '', $post['total_bayar']),
			'discount' => 0,
			'member_id' =>  $memberId,
		];

		$this->db->insert('transactions', $data);
		$insert_id = $this->db->insert_id();

		// insert ke tabel transaction_details
		foreach ($post['courses_ids'] as $key => $val) {

			$data_detail = [
				'transaction_id' => $insert_id,
				'course_id' => $val,
				'price' => $post['course_prices'][$key]
			];

			$this->db->insert('transaction_details', $data_detail);

			// update status menjadi paid di tabel cart
			$course = $this->db->where('id', $val)->get('courses')->row_array(); // get data kursus

			$data_cart = [
				'status' => 'pending',
				'start_dt' => date('Y-m-d H:i:s'),
				'end_dt' => date('Y-m-d H:i:s', strtotime('+'.$course['duration'].' day', time())),
			];
			$this->db->update('carts', $data_cart, ['member_id' => $memberId, 'course_id' => $val]);
		}


		####################################################################################################################################
		############################################################# MIDTRANS #############################################################
		####################################################################################################################################

		// Required
		$transaction_details = array(
			'order_id' => $data['code'],
			'gross_amount' => $data['amount'], // no decimal allowed for creditcard
		);

		// Fill transaction details
		$transaction = array(
			'transaction_details' => $transaction_details,
		);

		$snap_token = '';
		try {
			$snap_token = Midtrans\Snap::getSnapToken($transaction);
		}
		catch (\Exception $e) {
			echo $e->getMessage();
		}

		$data = [
			"success" => true,
			"message" => "Data berhasil di simpan!",
			"data" => [
				"snap_token" => $snap_token
			]
		];
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($data);

    }

	public function midtrans_callback(){
		redirect('course/history');
	}

	public function midtrans_update(){
		$post = $this->input->post();

		$data = [
			"status_message" 	=> $post['status_message'],
			"transaction_id" 	=> $post['transaction_id'],
			"transaction_dt" 	=> $post['transaction_time'],
			"payment_method" 	=> $post['payment_type'],
			"status"		 	=> ($post['transaction_status'] == 'settlement') ? 'paid' : $post['transaction_status'],
			"pdf_url"			=> $post['pdf_url']
		];

		$this->db->update('transactions', $data, ['code' => $post['order_id']]);

		if($data['status'] == 'paid'){
			// update status menjadi paid di tabel cart
			$transaction = $this->db->where('transaction_id', $post['transaction_id'])->get('transactions')->row_array(); // cari transaksi nya
			$details = $this->db->where('transaction_id', $transaction['id'])->get('transaction_details')->result_array(); // cari detail untuk mendapatkan course id

			foreach ($details as $key => $val) {
				$course = $this->db->where('id', $val['course_id'])->get('courses')->row_array(); // get data kursus
		
				$data_cart = [
					'status' => 'paid',
					'start_dt' => date('Y-m-d H:i:s'),
					'end_dt' => date('Y-m-d H:i:s', strtotime('+'.$course['duration'].' day', time())),
				];
				$this->db->update('carts', $data_cart, ['member_id' => $transaction['member_id'], 'course_id' => $val['course_id']]);
			}

		}

	}

	public function list(){
		$email = $_SESSION['user']['email'];

		$member = $this->db->where('email', $email)->get('members')->row_array();
		$transactions = $this->db->where('member_id', $member['id'])
			->get('transactions t')->result_array();

		$data['transactions'] = $transactions;

		echo $this->template->render('transaction/list', $data);
	}

	public function detail(){
		$get = $this->input->get();

		$data['data'] = $this->db->where('code', $get['code'])->get('transactions')->row_array();
		$data['details'] = $this->db->where('transaction_id', $data['data']['id'])
			->join('courses c', 'c.id = transaction_details.course_id')
			->join('instructors i', 'i.id = c.instructor_id')
			->get('transaction_details')->result_array();

		// JALANKAN API KE MIDTRANS UNTUK CEK TRANSAKSI YANG MASIH PENDING
		if($data['data']['status'] == 'pending'){
	
			// persiapkan curl
			$ch = curl_init(); 
			
			$url = $this->midtrans_base_url.'/'.$data['data']['transaction_id']."/status";

			var_dump($url);die;

			// set url 
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
		
			// return the transfer as a string 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	
			$headers = [
				'Content-Type' => 'application/json',
				'Accept'=> 'application/json',
				'Authorization' => 'Basic '.base64_encode($this->server_key.':')
			];
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	
			// $output contains the output string 
			$output = curl_exec($ch); 
		
			// tutup curl 
			curl_close($ch);      
		
			// menampilkan hasil curl
			echo $output;die;
		}

		echo $this->template->render('transaction/detail', $data);
	}

}
