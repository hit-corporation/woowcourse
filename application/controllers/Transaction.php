<?php

class Transaction extends MY_Controller {

    public function __construct() {
        parent::__construct();
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
		curl_setopt($ch, CURLOPT_URL, "https://app.sandbox.midtrans.com/iris/api/v1/statements");
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
	
		// return the transfer as a string 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

		$api_key = base64_encode('SB-Mid-server-Kk4WUNC1k7dZkgpJcX0WMdie:');

		$headers = [
			'Content-Type' => 'application/json',
			'Accept'=> 'application/json',
			'Authorization' => 'Basic '.$api_key
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
		require_once APPPATH . "libraries/Midtrans/midtrans.php";

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
			"status_message" => $post['status_message'],
			"transaction_id" => $post['transaction_id'],
			"transaction_dt" => $post['transaction_time'],
			"payment_method" => $post['payment_type'],
			"status"		 => ($post['transaction_status'] == 'settlement') ? 'paid' : $post['transaction_status']
		];

		$this->db->update('transactions', $data, ['code' => $post['order_id']]);
	}

}
