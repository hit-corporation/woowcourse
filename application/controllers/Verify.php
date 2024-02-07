<?php

class Verify extends MY_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->library(['form_validation', 'email']);
		$this->load->helper('customstring');
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

		$this->db->update('users', ['active' => 1], ['user_code' => $row['user_no']]); // lakukan update status active user

        $update = [
            'last_used_at' => date('Y-m-d H:i:s')
        ];

        if(!$this->db->update('personal_access_tokens', $update, ['user_no' => $row['user_no'], 'token' => $row['token']]))
        {
            return;
        }
        echo $this->template->render('verify', [], 'login');
    }

	public function resend_email(){
		$get = $this->input->get();

		$activation = [
			'user_no' 	 => $get['user_no'],
			'name'	  	 => 'reg_'.time(),
			'token'	  	 => str_random(24),
			'expired_at' => (new DateTime)->add(new DateInterval('PT1H'))->format('Y-m-d H:i:s'),
			'created_at' => date('Y-m-d H:i:s.u'),
			'updated_at' => date('Y-m-d H:i:s.u'),
		];
		
		if(!$this->db->insert('personal_access_tokens', $activation)) {
			$this->session->set_flashdata('error', ['message' => 'Email gagal di kirim !!!']);
			redirect(base_url('login/register'));
			return;
		}

		$token = [
			'token'		=> $activation['token'],
			'user_no'	=> $activation['user_no']
		];

		$email = $this->load->view('email/registration', $token, TRUE);

		// get email
		$user = $this->db->where('user_code', $get['user_no'])->get('users')->row_array();

		$this->email->from('naquib@hitcorporation.com');
		$this->email->to($user['email']);
		$this->email->subject('Verification Email');
		$this->email->message($email);
		$this->email->send();

		$this->session->set_flashdata('success', ['message' => 'Registrasi berhasil']);
		redirect(base_url('login/email_register'));
	}
}
