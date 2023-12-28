<?php

class Cart extends MY_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->model(['course_model']);
    }

    public function index() {
		$email = $this->session->userdata('user')['email'];
		$member = $this->db->where('email', $email)->get('members')->row_array();

		$data['carts'] = $this->course_model->get_all_carts($member['id']);

        echo $this->template->render('cart', $data, 'course\\');
    }

	public function add(){
		$post = $this->input->post();

		$member = $this->db->where('email', $post['email'])->get('members')->row_array();

		$data = [
			'course_id' => $post['course_id'],
			'member_id' => $member['id'],
			'status' 	=> 'unpaid',
		];

		$insert = $this->db->insert('carts', $data);

		header('Content-Type: application/json');
		if($insert){
			$res = ['success'=>true, 'message'=>'Data berhasil di simpan!'];
			echo json_encode($res);
		}else{
			$res = ['success'=>false, 'message'=>'Data gagal di simpan!'];
			echo json_encode($res);
		}
	}
}
