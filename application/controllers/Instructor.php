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

}
