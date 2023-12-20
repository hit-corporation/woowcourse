<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// class User extends MY_Controller {
class Instructor extends MY_Controller {
	
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
			
			// JIKA DATA INSTRUKTOR TIDAK ADA MAKA REDIRECT KE LIST ALL INSTRUCTORS
			if(is_null($cek)) redirect('instructor/all');


			$id = $cek['id'];
			$data['is_instructor'] = true;
		}

		$instruktur = $this->instructor_model->detail($id);
		$data['data'] = (!is_null($instruktur)) ? $instruktur : [];
		$data['courses'] = $this->instructor_model->get_courses($id);

		echo $this->template->render('instructor/detail', $data);
	}

	public function all(){
		$instructors = $this->db->where('as_instructor', true)->get('members')->result_array();
		echo $this->template->render('instructor/all');
	}

}
