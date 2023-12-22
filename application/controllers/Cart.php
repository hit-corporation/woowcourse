<?php

class Cart extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        echo $this->template->render('cart', [], 'course\\');
    }
}