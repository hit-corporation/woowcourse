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
		$data['topics'] = $this->topics_model->get_all();
        echo $this->template->render('index', $data);
    }

	public function get_all(){
		$page 			= isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$limit 			= isset($_GET['limit']) ? (int)$_GET['limit'] : 3;
		$filter['title']= isset($_GET['title']) ? $_GET['title'] : '';

		$page = ($page - 1) * $limit;

		$data['data'] 			= $this->topics_model->get_all($filter, $limit, $page);
		$data['total_records'] 	= $this->topics_model->get_total($filter);
		$data['total_pages'] 	= ceil($data['total_records'] / $limit);

		// create json header	
		header('Content-Type: application/json');
		echo json_encode($data);
	}
}
