<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// class User extends MY_Controller {
class Instructor extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('instructor_model');
		$this->load->library('form_validation');
	}

	/**
     * function for view
     *
     * @return void
     */
	public function index(): void {
		echo $this->template->render('index');
	}

	public function detail($id = ''){
		// CEK APAKAH USER SUDAH TERDAFTAR SEBAGAI INSTRUKTOR
		$data['is_instructor'] = false;
		if(!$id){
			$email = $this->session->userdata('user')['email'];
			$cek = $this->db->where('email', $email)->get('instructors')->row_array();
			$id = $cek['id'];
			$data['is_instructor'] = true;
		}

		$data['data'] = $this->instructor_model->detail($id);
		$data['courses'] = $this->instructor_model->get_courses($id);
		$data['is_instructor'];

		echo $this->template->render('instructor/detail', $data);
	}

}
