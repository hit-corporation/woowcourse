<?php

class Transaction extends MY_Controller {

    public function __construct() {
        parent::__construct();
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
				'payment_method' => $post['jenis_pembayaran'],
				'user_bank_account' => $post['no_rekening_member'],
				'member_id' =>  $memberId,
				'transaction_dt' => date('Y-m-d H:i:s')
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
				$this->db->update('carts', ['status' => 'paid'], ['member_id' => $memberId, 'course_id' => $val]);
			}

    }

}
