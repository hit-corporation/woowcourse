<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course extends MY_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model([]);
		$this->load->library('form_validation');
	}

	/**
	 * View
	 *
	 * @return void
	 */
	public function index(){
		echo $this->template->render('index');
	}
}
