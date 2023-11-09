<?php

class Verify extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($params): void 
    {
        $_ver = explode(':', base64_decode($params));
    }
}