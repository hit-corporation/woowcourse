<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(['user_model', 'member_model', 'dashboard_model', 'topics_model', 'instructor_model', 'wishlist_model']);

		$this->load->library('form_validation');
		
	}

	public function index(){
		$data = [];
		$user = [];
		$member = [];
		$wishlists = [];

		if(isset($_SESSION['user'])) {
			$user = $_SESSION['user'];
			$member = $this->db->where('email', $user['email'])->get('members')->row_array();
		} 

		// AMBIL DATA COURSE YANG SUDAH DI SUBSCRIBE OLEH MEMBER
		$topicSubsc = $this->topics_model->get_topic_subscribe();
		foreach ($topicSubsc as $key => $val) {
			$topicSubsc[$key]['details'] = $this->topics_model->get_course($val['topic_id']);
		}

		$data['courses'] = $topicSubsc ?? [];

		// AMBIL DATA COURSE TERBARU LIMIT 12
		$data['new_courses'] = $this->topics_model->get_new_courses() ?? [];

		// POPULAR CATEGORY
		$data['popular_categories'] = $this->db->limit('12')->get('categories')->result_array() ?? [];

		// AMBIL DATA LIST INSTRUCTORS
		$popularInstructor = $this->instructor_model->get_popular_instructors();
		foreach ($popularInstructor as $key => $val) {
			$popularInstructor[$key]['details'] = $this->db->select('instructors.*, members.photo as member_photo')
													->from('instructors')
													->where('members.id', $val['instructor_id'])
													->join('members', 'members.email = instructors.email')
													->get()->row_array();
		}
		$data['instructors'] = $popularInstructor ?? [];

		if($member){
			$filter = ['member_id' => $member['id']];
			$wishlists = $this->wishlist_model->get_all($filter);
		}

		$data['wishlists'] = $wishlists;

		// var_dump($data['wishlists']);die;

		// MENGGUNAKAN TEMPLATE ENGINE PLATES
		echo $this->template->render('index', $data);
	}

	public function dashboard2(){
	}
}
