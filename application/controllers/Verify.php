<?php

class Verify extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Undocumented function
     *
     * @param [type] $params
     * @return void
     */
    public function index($params): void 
    {
        $_ver = explode(':', base64_decode($params));

        header('Content-Type: text/plain');
        
        $aktif = $this->db->get_where('personal_access_tokens', ['user_no' => $_ver[1], 'token' => $_ver[0]]);
        // check token is exists or not
        if(!$aktif->num_rows() > 0)
        {
            echo 'Aktivasi Gagal !!!';
            return;
        }

        $time = $aktif->row()->expired_at;

        // check if token is expired
        if(time() >= strtotime($time))
        {
            echo 'Token already expired !!!';
            return;
        }

        echo "OK";
    }
}