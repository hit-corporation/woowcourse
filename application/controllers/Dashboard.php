<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(['user_model', 'member_model', 'book_model', 'dashboard_model']);

		$this->load->library('form_validation');
		
	}

	public function index(){
		// MENGGUNAKAN TEMPLATE ENGINE PLATES
		echo $this->template->render('index');
	}

	public function dashboard2(){
	}
}
