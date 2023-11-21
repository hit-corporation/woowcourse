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
			// load file helper
			$this->load->helper('file');
			// upload images
			$config['upload_path']          = './assets/images/instructors/';
			$config['allowed_types']        = 'gif|jpg|jpeg|png';
			$config['max_size']             = 2048;
			$config['encrypt_name']         = true;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('image')){
				// upload fails
				// $resp = ['success' => false, 'message' => $this->upload->display_errors()];
				// $this->session->set_flashdata('error', $resp);
				// echo json_encode($resp); die;
			}else{
				// upload success
				$upload_data = $this->upload->data();
				// resize image
				$config['image_library'] = 'gd2';
				$config['source_image'] = './assets/images/instructors/'.$upload_data['file_name'];
				$config['create_thumb'] = FALSE;
				$config['maintain_ratio'] = FALSE;
				$config['width']         = 300;
				$config['height']       = 300;

				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				// remove old image
				$old_image = $this->db->where('id', $id)->get('instructors')->row_array()['photo'];
				if($old_image != '' || $old_image != null){
					unlink('./assets/images/instructors/'.$old_image);
				}
				// update user data
				$data = [ 
					'photo' => $upload_data['file_name']
				];

				if(isset($data['photo'])){
					// update user data
					$update = $this->db->where('id', $id)->update('instructors', $data);
				}
			}

			$data = [ 
				'first_name' => $post['first_name'],
				'last_name' => $post['last_name'],
				'phone' => $post['phone'],
				'address' => $post['address'],
				'about' => base64_decode($post['about']),
			];
			
			$update = $this->db->where('id', $id)->update('instructors', $data);
			$res = isset($update) ?  ['success' => true, 'message' => 'Data berhasil diubah.'] :  ['success' => false, 'message' => 'Data gagal diubah.'];
			// set success message
			$this->session->set_flashdata('success', $res);
			echo json_encode($res); die;
		}

		echo $this->template->render('instructor/update_profile', ['data'=>$instructor]);
	}

}
