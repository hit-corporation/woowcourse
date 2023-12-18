<?php

class Rating extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }


    public function get_all(): void {
        
    }

    /**
     * Store Rating and comment in database
     *
     * @return void
     */
    public function store(): void {

        try 
        {
            
        }
        catch(Exception $e)
        {
            log_message("error", $e->getMessage());
        }
    }

}