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
		if(empty($id)) redirect('instructor');

		$data['data'] = $this->instructor_model->detail($id);
		$data['courses'] = $this->instructor_model->get_courses($id);

		echo $this->template->render('instructor/detail', $data);
	}

	public function update_profile($id = ''){
		$post = $this->input->post();

		$instructor = $this->db->where('id', $id)->get('instructors')->row_array();
		
		if($instructor['email'] !== $this->session->userdata('user')['email']) redirect('Instructor/detail/'.$id);

		if(isset($post['type']) && $post['type'] == 'update'){
			var_dump($post);die;
		}

		echo $this->template->render('instructor/update_profile', ['data'=>$instructor]);
	}

}
