<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rating extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model(['rating_model']);
		$this->load->library('form_validation');
	}

	/**
	 * View
	 *
	 * @return void
	 */
	public function index(){
		$categories = $this->db->get('categories')->result_array();
		echo $this->template->render('index', ['categories'=>$categories]);
	}

	public function get_all_paginated(){
		$get = $this->input->get();

		$draw 		= $get['draw'] ?? NULL;
		$offset 	= $get['start'];
		$limit 		= $get['length'];
		$filters	= $get['columns'];

		$data = $this->rating_model->get_all($filters, $limit, $offset);
		$response = [
			'draw' => $draw,
			'data' => $data,
			'recordsTotal' => $this->db->count_all_results('ratings'),
			'recordsFiltered' => $this->rating_model->count_all($filters)
		];


		echo json_encode($response, JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_TAG);
	}

	public function delete(){
		if(!isset($this->session->userdata('user')['email'])) redirect('');

		$post = $this->input->post();

		// delete course
		$deleteCourse = $this->db->where('id', $post['comment_id'])->delete('ratings');

		// hitung average rating
		$courseId = $this->db->where('course_code', $post['course_code'])->get('courses')->row_array()['id'];
		
		$q = $this->db->select_avg('rate')
			->from('ratings')
			->where('course_id', $courseId)
			->get()->row_array();

		$rating = round($q['rate'], 2);

		// update rating course
		$update = $this->db->where('id', $courseId)->update('courses', ['rating'=>$rating]);

		if($update){
			$response = ['success'=>true, 'message'=>'Data berhasil di hapus'];
			echo json_encode($response, JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_TAG);
		}else{
			$response = ['success'=>false, 'message'=>'Data gagal di hapus'];
			echo json_encode($response, JSON_HEX_AMP|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_TAG);
		}
	}
}
