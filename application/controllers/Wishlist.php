<?php

class Wishlist extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(['course_model']);
    }

	public function index() {
		$email = $this->session->userdata('user')['email'];
		$member = $this->db->where('email', $email)->get('members')->row_array();

		$data['wishlists'] = $this->course_model->get_all_wishlist($member['id']);

        echo $this->template->render('wishlist', $data, 'course\\');
    }

	public function delete(){
		$post = $this->input->post();
		$id = $post['id'];

		$q = $this->db->where('id', $id)->delete('wishlists');
		
		if($q){
			$res = ['success' => true, 'message' => 'Data berhasil di hapus!'];
		} else {
			$res = ['success' => false, 'message' => 'Data gagal di hapus!'];
		}

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($res);
	}

	public function store(){
		$post = $this->input->post();
		$id = $post['id'];
		
		$email = isset($_SESSION['user']['email']) ? $_SESSION['user']['email'] : null;
		
		if(!$email){ // cek apakah sudah login
			$res = ['success' => false, 'message' => 'Silahkan login terlebih dahulu!'];
			header('Content-Type: application/json; charset=utf-8');
			echo json_encode($res);
			die;
		}
		
		$member = $this->db->where('email', $email)->get('members')->row_array();

		// CEK APAKAH SUDAH ADA DI WISHLIST
		$cek = $this->db->where('member_id', $member['id'])->where('course_id', $id)->get('wishlists')->num_rows();
		if($cek > 0){
			$delete = $this->db->where('member_id', $member['id'])->where('course_id', $id)->delete('wishlists');
			if($delete){
				$res = ['success' => true, 'message' => 'Berhasil menghapus wishlists.'];
				header('Content-Type: application/json; charset=utf-8');
				echo json_encode($res);
				die;
			}
		}

		$data = [
			'member_id' => $member['id'],
			'course_id' => $id
		];

		$q = $this->db->insert('wishlists', $data);

		if($q){
			$res = ['success' => true, 'message' => 'Wishlist berhasil di tambah!'];
		} else {
			$res = ['success' => false, 'message' => 'Gagal menambah wishlist!'];
		}

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($res);
	}
}
