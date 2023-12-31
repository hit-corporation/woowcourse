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
		$data['courses'] = $this->instructor_model->get_courses($instruktur['id']);

		foreach ($data['courses'] as $key => $value) {
			$total_video = $this->db->where('course_id', $value['id'])->get('course_videos')->num_rows();
			$data['courses'][$key]['total_video'] = $total_video;
		}

		echo $this->template->render('instructor/detail', $data);
	}

	public function all(){
		$data['instructors'] = $this->instructor_model->get_all();
		foreach($data['instructors'] as $key => $val){
			$data['instructors'][$key]['total_sub'] 	= $this->db->where('instructor_id', $val['instructor_id'])->get('subscriptions')->num_rows();
			$data['instructors'][$key]['total_course'] 	= $this->db->where('instructor_id', $val['instructor_id'])->get('courses')->num_rows();
		}

		echo $this->template->render('instructor/all', $data);
	}

}
