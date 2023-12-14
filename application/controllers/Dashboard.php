<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(['user_model', 'member_model', 'dashboard_model', 'topics_model', 'instructor_model']);

		$this->load->library('form_validation');
		
	}

	public function index(){

		// AMBIL DATA COURSE YANG SUDAH DI SUBSCRIBE OLEH MEMBER
		$topicSubsc = $this->topics_model->get_topic_subscribe();
		foreach ($topicSubsc as $key => $val) {
			$topicSubsc[$key]['details'] = $this->topics_model->get_course($val['topic_id']);
		}

		$data['courses'] = $topicSubsc;

		// AMBIL DATA COURSE TERBARU LIMIT 12
		$data['new_courses'] = $this->topics_model->get_new_courses();

		// AMBIL DATA LIST INSTRUCTORS
		$popularInstructor = $this->instructor_model->get_popular_instructors();
		foreach ($popularInstructor as $key => $val) {
			$popularInstructor[$key]['details'] = $this->db->where('id', $val['instructor_id'])->get('instructors')->row_array();
		}

		$data['instructors'] = $popularInstructor;

		// MENGGUNAKAN TEMPLATE ENGINE PLATES
		echo $this->template->render('index', $data);
	}

	public function dashboard2(){
	}
}
