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
		$data['courses'] = $this->get_course_subscribe($member) ?? [];

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
		$data['instructors'] = $this->popular_instructor() ?? [];

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

	private function get_course_subscribe($member){
		
		// AMBIL SEMUA DATA COURSE YANG SUDAH DI SUBSCRIBE OLEH MEMBER

		$topicSubsc = $this->topics_model->get_topic_subscribe();

		// Jika kursus yang sudah di subscribe di bawah 6, tambahkan data kursus dari yang ada
		if(count($topicSubsc) < 6){
			$get_all = $this->topics_model->get_all([], 12, null);
			
			foreach ($get_all as $value) { // looping untuk menggabungkan data
				$topicSubsc[] = $value;
			}
			
			// ambil topic id nya aja
			$topicIds = [];
			foreach ($topicSubsc as $key => $value) {
				$topicIds[] = $value['topic_id'];
			}
			$topicIds = array_unique($topicIds);
		}	

		$topicSubsc = array_slice($topicIds, 0, 12);

		$final_topic_subs = [];
		foreach ($topicSubsc as $key => $val) {
			$final_topic_subs[] = $this->topics_model->get_course($val);

			// cek wishlist
			if($member){ // jika sudah login lakukan pengecekan pada tabel wishlist
				$cek = $this->db->where('member_id', $member['id'])->where('course_id', $val)->get('wishlists')->row_array();
				if($cek){
					$final_topic_subs[$key]['is_wishlist'] = true;
				}else{
					$final_topic_subs[$key]['is_wishlist'] = false;
				}
			}else{
				$final_topic_subs[$key]['is_wishlist'] = false;
			}
		}

		return $final_topic_subs;
	}

	private function popular_instructor(){
		$instructorIds = [];

		$popularInstructor = $this->instructor_model->get_popular_instructors();

		// Jika instruktor yang sudah di subscribe di bawah 6, tambahkan data instructor dari yang ada
		if(count($popularInstructor) < 6){
			$a = $this->instructor_model->get_all();

			foreach ($a as $key => $value) {
				$popularInstructor[] = $value;
			}

			// ambil instruktor id nya
			foreach ($popularInstructor as $key => $value) {
				$instructorIds[] = $value['instructor_id'];
			}
			$instructorIds = array_unique($instructorIds); // buang id instruktor yg duplikat
			$instructorIds = array_slice($instructorIds, 0, 12); // ambil hanya 12 id saja
		}else{
			foreach ($popularInstructor as $key => $value) {
				$instructorIds[] = $value['instructor_id'];
			}
		}

		$res = [];
		foreach ($instructorIds as $key => $val) {
			$res[$key] = $this->db->select('instructors.*, members.photo as member_photo, members.job, members.first_name, members.last_name')
									->from('instructors')
									->where('instructors.id', $val)
									->join('members', 'members.email = instructors.email', 'left')
									->get()->row_array();
		}

		return $res;
	}
}
