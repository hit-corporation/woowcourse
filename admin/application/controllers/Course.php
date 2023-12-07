<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model(['course_model']);
		$this->load->library('form_validation');
	}

	/**
	 * View
	 *
	 * @return void
	 */
	public function index(){
		echo $this->template->render('index');
	}

	public function get_all_paginated(){
		$get = $this->input->get();

		$draw 		= $get['draw'] ?? NULL;
		$offset 	= $get['start'];
		$limit 		= $get['length'];
		$filters	= $get['columns'];

		$data = $this->course_model->get_all($filters, $limit, $offset);
		
		$response = [
			'draw' => $draw,
			'data' => $data,
			'recordsTotal' => $this->db->count_all_results('courses'),
			'recordsFiltered' => $this->course_model->count_all($filters)
		];


		echo json_encode($response, JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_TAG);
	}

	public function delete(){
		if(!isset($this->session->userdata('user')['email'])) redirect('');

		$post = $this->input->post();
		
		$this->db->where('course_id', $post['course_id'])->delete('course_videos'); // delete video
		$deleteCourse = $this->db->where('id', $post['course_id'])->delete('courses'); // delete course
		
		if($deleteCourse){
			$response = ['success'=>true, 'message'=>'Data berhasil di hapus'];
			echo json_encode($response, JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_TAG);
		}else{
			$response = ['success'=>false, 'message'=>'Data gagal di hapus'];
			echo json_encode($response, JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_TAG);
		}
	}
}
