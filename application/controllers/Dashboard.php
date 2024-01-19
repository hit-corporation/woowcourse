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

		// AMBIL SEMUA DATA COURSE YANG SUDAH DI SUBSCRIBE OLEH MEMBER
		$topicSubsc = $this->topics_model->get_topic_subscribe();
		foreach ($topicSubsc as $key => $val) {
			$topicSubsc[$key]['details'] = $this->topics_model->get_course($val['topic_id']);

			// cek wishlist
			if($member){ // jika sudah login lakukan pengecekan pada tabel wishlist
				$cek = $this->db->where('member_id', $member['id'])->where('course_id', $val['topic_id'])->get('wishlists')->row_array();
				if($cek){
					$topicSubsc[$key]['is_wishlist'] = true;
				}else{
					$topicSubsc[$key]['is_wishlist'] = false;
				}
			}else{
				$topicSubsc[$key]['is_wishlist'] = false;
			}
		}

		$data['courses'] = $topicSubsc ?? [];

		// AMBIL DATA COURSE TERBARU LIMIT 12
		$data['new_courses'] = $this->topics_model->get_new_courses() ?? [];
			// CEK DATA WISHLIST
			foreach ($data['new_courses'] as $key => $val) {
				if($member){ // jika sudah login lakukan pengecekan pada tabel wishlist
					$cek = $this->db->where('member_id', $member['id'])->where('course_id', $val['id'])->get('wishlists')->row_array();
					if($cek){
						$data['new_courses'][$key]['is_wishlist'] = true;
					}else{
						$data['new_courses'][$key]['is_wishlist'] = false;
					}
				}else{
					$data['new_courses'][$key]['is_wishlist'] = false;
				}
			}

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

		// GET DATA NEW INSTRUCTORS
		$data['new_instructors'] = $this->db->select('m.*')->join('members m', 'm.email=i.email')->limit('10')->order_by('id','desc')->get('instructors i')->result_array();

		// GET SEMUA WISHLIST USER JIKA SUDAH LOGIN
		if($member){
			$filter = ['member_id' => $member['id']];
			$wishlists = $this->wishlist_model->get_all($filter);
		}

		// GET RATING LIMIT 5
		$data['ratings'] = $this->db->select('r.*, m.first_name, m.last_name, m.photo')->where('rate >=', 4)->join('members m', 'm.id=r.member_id')->limit(5)->order_by('id', 'desc')->get('ratings r')->result_array();

		$data['wishlists'] = $wishlists;

		

		// MENGGUNAKAN TEMPLATE ENGINE PLATES
		echo $this->template->render('index', $data);
	}

	public function dashboard2(){
	}
}
