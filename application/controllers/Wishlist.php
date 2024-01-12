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
}
