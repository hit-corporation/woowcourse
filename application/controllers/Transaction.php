<?php

use Midtrans\MidtransSnapTest;

class Transaction extends MY_Controller {

	public $client_key;
	private $server_key;
	public $midtrans_base_url;
	public $midtrans_snap_base_url;


    public function __construct() {
        parent::__construct();

		$this->load->model('transaction_model');

		require_once APPPATH . "libraries/Midtrans/midtrans.php";
		require_once APPPATH . '../vendor/autoload.php';

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

		$data['data'] = $this->transaction_model->get_data($get['code']);
		$data['details'] = $this->transaction_model->get_detail($data['data']['id']);

		// JALANKAN API KE MIDTRANS UNTUK CEK TRANSAKSI YANG MASIH PENDING
		if($data['data']['status'] == 'pending'){

			$client = new \GuzzleHttp\Client();

			$basic_auth = base64_encode($this->server_key.':');
			$response = $client->request('GET', $this->midtrans_base_url.'/'.$data['data']['transaction_id'].'/status', [
			'headers' => [
				'accept' => 'application/json',
				'authorization' => 'Basic '.$basic_auth,
			],
			]);

			// echo $response->getBody();die;
			$res = json_decode($response->getBody(), true);
			
			if($res['status_code'] == '200'){ 
				// jika sudah 200 maka lakukan update transaksi menjadi paid
				$data_update = [
					'status' 			=> 'paid', 
					'status_message' 	=> $res['status_message'],
					'transaction_dt' 	=> $res['settlement_time'],
					'updated_at'		=> $res['settlement_time'],
				];
				$this->db->update('transactions', $data_update, ['transaction_id' => $data['data']['transaction_id']]);

				// update cart menjadi paid & start_dt, end_dt update menjadi terbaru
				// looping dulu detail transaksi nya
				foreach ($data['details'] as $key => $value) {
					$where = [
						'member_id' => $data['data']['member_id'], 
						'course_id' => $value['course_id'], 
						'status' => 'pending'
					];

					$data_cart = [
						'updated_at' 	=> $res['settlement_time'],
						'status'		=> 'paid',
						'start_dt'		=> $res['settlement_time'],
						'end_dt'		=>  date('Y-m-d H:i:s', strtotime('+'.$value['duration'].' day', strtotime($res['settlement_time']))),
					];

					
					$this->db->update('carts', $data_cart, $where);
				}
			}elseif($res['status_code'] == '407'){
				$this->db->update('transactions', ['status' => $res['transaction_status']], ['transaction_id' => $data['data']['transaction_id']]);
			}
		}

		$data['data'] = $this->transaction_model->get_data($get['code']); // get data yg terbaru
		echo $this->template->render('transaction/detail', $data);
	}

}
