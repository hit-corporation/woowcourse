<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class History extends MY_Controller {
	
	public function __construct(){
		parent::__construct();
	}

	public function index(){
		echo $this->template->render('index');
	}

}
