<?php

class Course extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * View All Courses
     *
     * @return void
     */
    public function index(): void {
        echo $this->template->render('index');
    }
}