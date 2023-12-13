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
		$data['categories'] = $this->db->get('categories')->result_array();
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
		$data['videos'] = $this->db->where('course_id', $id)->get('course_videos')->result_array();
		$data['comments'] = $this->db->where('topic_id', $id)->join('members m', 'm.id = r.member_id')->get('ratings r')->result_array();
		echo $this->template->render('course/detail', $data);
	}

	// CREATE NEW COURSE
	public function create(){
		if(!isset($this->session->userdata()['user'])) redirect('course');
		echo $this->template->render('course/create');
	}

	// SIMPAN COURSE
	public function store(){
		$post = $this->input->post();

		// PROSES UPLOAD VIDEO
			$this->load->helper('file');

			// Count total files
			$countfiles = count($_FILES['course_video']['name']);
			$upload_location	= './assets/files/upload/courses/';
			$files_arr = [];

			for($index = 0;$index < $countfiles;$index++){
				$filename = $_FILES['course_video']['name'][$index];
				// Get extension
				$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); 
				$filenameEncode = base64_encode($filename.microtime()).'.'.$ext;
				// Valid image extension
				$valid_ext = array("mp4");
				// Check extension
				if(in_array($ext, $valid_ext)){
					// File path
					$path = $upload_location.$filenameEncode;
					move_uploaded_file($_FILES['course_video']['tmp_name'][$index],$path);
					$files_arr[] = [
						'seq' => $index+1,
						'video' => $filenameEncode
					];
				}
			}

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
				$res = ['success'=>false, 'message'=>'Course Image gagal disiman!'];
				echo json_encode($res); die;
			}

		// upload success
		$upload_data_image = $this->upload->data();
		$email = $this->session->userdata('user')['email'];
		$instructor_id = $this->db->where('email', $email)->get('instructors')->row_array()['id'];
		
		// INSERT COURSE
			$data = [
				'course_code' => $this->random_string(5),
				'course_title' => $post['course_title'],
				'course_img' => $upload_data_image['file_name'],
				'description' => base64_decode($post['description']),
				'instructor_id' => $instructor_id,
				'category_id' => $post['category_id'],
			];	
			$this->db->insert('courses', $data);
			$insert = $this->db->insert_id();

		// INSERT VIDEO
			foreach($files_arr as $key => $val){
				$dataVideo = [
					'course_id' => $insert,
					'video' => $val['video'],
					'seq' => $val['seq'],
				];
				$this->db->insert('course_videos', $dataVideo);
			}

		if($insert){
			$res = ['success'=>true, 'message'=>'Data berhasil di simpan!'];
			echo json_encode($res);
		}
		
	}

	// EDIT COURSE
	public function edit($id){
		$d['data'] = $this->db->where('id', $id)->get('courses')->row_array();
		$d['videos'] = $this->db->where('course_id', $d['data']['id'])->get('course_videos')->result_array();
		echo $this->template->render('course/create', $d);
	}

	// UPDATE COURSE
	public function update(){
		$post = $this->input->post();
		
		// PROSES UPLOAD VIDEO
			$countfiles = count($_FILES['course_video']['name']);
			$upload_location	= './assets/files/upload/courses/';
			$files_arr = [];

			for($index = 0;$index < $countfiles; $index++){
				$filename = $_FILES['course_video']['name'][$index];
				// jika filename ada ada isi nya
				if($filename){
					// Get extension
					$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); 
					$filenameEncode = base64_encode($filename.microtime()).'.'.$ext;
					// Valid image extension
					$valid_ext = array("mp4");
					// Check extension
					if(in_array($ext, $valid_ext)){
						// File path
						$path = $upload_location.$filenameEncode;
						move_uploaded_file($_FILES['course_video']['tmp_name'][$index],$path);
						$files_arr[] = [
							'seq' => $index+1,
							'video' => $filenameEncode
						];
					}
				}
			}

		// UPDATE DATA COURSE VIDEO DAN HAPUS FILE VIDEO LAMA
			foreach ($files_arr as $key => $value) {
				$video = $this->db->where('course_id', $post['id'])->where('seq', $value['seq'])->get('course_videos')->row_array();
				// delete video lama
				$fileLama = './assets/files/upload/courses/'.$video['video'];
				if(file_exists($fileLama)){
					$hapusFile = unlink('./assets/files/upload/courses/'.$video['video']);
				}
				// update video baru
				$this->db->where('id', $video['id'])->update('course_videos', ['video' => $value['video']]);
			}

		// UPDATE FILE IMAGE COURSE
			if($_FILES['image']['name']){ // jika gambar ada maka jalankan source ini
				$course = $this->db->where('id', $post['id'])->get('courses')->row_array(); // ambil data kursus
				// delete course image yang lama
				$fileLama = './assets/files/upload/courses/'.$course['course_img'];
				if(file_exists($fileLama)){
					$hapusFile = unlink('./assets/files/upload/courses/'.$course['course_img']);
				}
				$filename = $_FILES['image']['name']; // ambil nama file gambar
				$ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION)); // ambil extension gambar
				$filenameEncode = base64_encode($filename.microtime()).'.'.$ext;
				
				// File path
				$path = $upload_location.$filenameEncode;
				move_uploaded_file($_FILES['image']['tmp_name'],$path);

				// isi data gambar yang baru
				$data['course_img'] = $filenameEncode;
				// $this->db->where('id', $post['id'])->update('courses', ['course_img'=> $filenameEncode]);
			}
		
		// UPDATE DATA COURSE 
			$data['course_title'] = $post['course_title'];
			$data['description'] = base64_decode($post['description']);
			$data['category_id'] = $post['category_id'];
			$data['updated_at'] = date('Y-m-d H:i:s');

			$update = $this->db->where('id', $post['id'])->update('courses', $data);
			if($update){
				$res = ['success'=>true, 'message'=>'Data berhasil di update!'];
				echo json_encode($res);
			}else{
				$res = ['success'=>false, 'message'=>'Data gagal di update!'];
				echo json_encode($res);
			}
	}

	// GENERATE RANDOM STRING 5 DIGIT
	public function random_string($number){
		$str = '';
		for ($i=0; $i<$number; $i++) { 
			$d=rand(1,30)%2; 
			$str .= $d ? chr(rand(65,90)) : chr(rand(48,57)); 
		}
		return $str;
	}
}

