<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaction_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function get_data($code){
		$q = $this->db->where('code', $code)->get('transactions');
		return $q->row_array();
	}

	public function get_detail($transaction_id){
		$q = $this->db->select('transaction_details.*, c.duration, c.course_img, c.course_title, i.first_name, i.last_name')
			->from('transaction_details')
			->where('transaction_id', $transaction_id)
			->join('courses c', 'c.id = transaction_details.course_id')
			->join('instructors i', 'i.id = c.instructor_id');
		return $q->get()->result_array();
	}
}
