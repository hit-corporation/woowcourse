<?php

class Verify extends MY_Controller {

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

        $row = $aktif->row_array();

        $update = [
            'last_used_at' => date('Y-m-d H:i:s')
        ];

        if(!$this->db->update('personal_access_tokens', $update, ['user_no' => $row['user_no'], 'token' => $row['token']]))
        {
            return;
        }
        echo $this->template->render('verify', [], 'login');
    }
}
