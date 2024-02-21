<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$email = $_SESSION['user']['email'];
		$memberId = $this->db->where('email', $email)->get('members')->row_array()['id'];

		$this->db->where('status', 'paid')
			->where('ca.member_id', $memberId)
			->join('courses c', 'c.id = ca.course_id', 'left');
		$data = $this->db->get('carts ca')->result_array(); 

		echo $this->template->render('index', ['data' => $data]);
	}

}
