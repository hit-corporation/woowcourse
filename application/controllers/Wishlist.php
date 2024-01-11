<?php

class Wishlist extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(['course_model']);
    }

	public function index() {
		$email = $this->session->userdata('user')['email'];
		$member = $this->db->where('email', $email)->get('members')->row_array();

		$data['carts'] = $this->course_model->get_all_wishlist($member['id']);

        echo $this->template->render('wishlist', $data, 'course\\');
    }

}
