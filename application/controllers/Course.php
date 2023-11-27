<?php

class Course extends MY_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model(['topics_model']);
    }

    /**
     * View All Courses
     *
     * @return void
     */
    public function index(): void {
		// $data['topics'] 	= $this->topics_model->get_all();
		$data['categories'] = $this->db->limit(10)->get('categories')->result_array();
        echo $this->template->render('index', $data);
    }

	public function get_all(){
		$page 			= isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$limit 			= isset($_GET['limit']) ? (int)$_GET['limit'] : 3;
		$filter['title']= isset($_GET['title']) ? $_GET['title'] : '';
		$filter['categories'] = isset($_GET['categories']) ? $_GET['categories'] : [];
		$filter['ratingChecked'] = isset($_GET['ratingChecked']) ? $_GET['ratingChecked'] : [];
		
		$page = ($page - 1) * $limit;

		$data['data'] 			= $this->topics_model->get_all($filter, $limit, $page);
		$data['total_records'] 	= $this->topics_model->get_total($filter);
		$data['total_pages'] 	= ceil($data['total_records'] / $limit);

		// create json header	
		header('Content-Type: application/json');
		echo json_encode($data);
	}

	public function detail($id = ''){
		$data['data'] = $this->topics_model->detail($id);
		echo $this->template->render('course/detail', $data);
	}

	public function create(){
		echo $this->template->render('course/create');
	}

	public function store(){
		$post = $this->input->post();

		// PROSES UPLOAD VIDEO
		$this->load->helper('file');
		$config['upload_path']	= './assets/files/upload/courses/';
		$config['allowed_types']= 'mp4';
		$config['encrypt_name']	= true;

		$this->load->library('upload', $config);
		// $this->upload->initialize($config);
		if ( ! $this->upload->do_upload('video')){
			# Upload Failed
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect('course/create');
		}

		$upload_data_video = $this->upload->data();

		// PROSES UPLOAD GAMBAR
		$config2['upload_path']	= './assets/files/upload/courses/';
		$config2['allowed_types']= 'gif|jpg|jpeg|png';
		$config2['max_size']     = 2048;
		$config2['encrypt_name'] = true;
		$this->load->library('upload', $config2);
		$this->upload->initialize($config2);
		if ( ! $this->upload->do_upload('image')){
			# Upload Failed
			$this->session->set_flashdata('error', $this->upload->display_errors());
			redirect('course/create');
		}

		// upload success
		$upload_data_image = $this->upload->data();

		$email = $this->session->userdata('user')['email'];
		$instructor_id = $this->db->where('email', $email)->get('instructors')->row_array()['id'];

		$data = [
			'course_code' => $this->random_string(),
			'course_title' => $post['course_title'],
			'course_img' => $upload_data_image['file_name'],
			'description' => base64_decode($post['description']),
			'instructor_id' => $instructor_id,
			'category_id' => $post['category_id'],
			'course_video' => $upload_data_video['file_name']
		];
		$insert = $this->db->insert('courses', $data);
		var_dump($insert);die;
		
	}

	public function random_string(){
		$str = '';
		for ($i=0; $i<5; $i++) { 
			$d=rand(1,30)%2; 
			$str .= $d ? chr(rand(65,90)) : chr(rand(48,57)); 
		}
		return $str;
	}
}

