<?php defined('BASEPATH') OR exit('No direct script access allowed');

class auth extends CI_Controller 
{
	function __construct() {
		parent::__construct();
		$this->load->model('M_login');
		// $this->load->model('m_users');
		$this->load->library('session');
		$this->load->helper('cek');

		$lang = ($this->session->userdata('lang')) ? $this->session->userdata('lang') : config_item('language');
		$this->lang->load('message', $lang);
	}

	public function changePassword()
	{
		$userid		= $this->session->userdata['userid'];
		$username	= $this->session->userdata['username'];
		
		$pw_lama	= $this->input->post('password_lama');
		$hasil		= $this->m_login->loginCek($username)->row();
		
		if(hash_verified($pw_lama, $hasil->password)){
			$data = array(
				'userid'=>$userid,
				'password' => get_hash($this->input->post('repassword')),
			);
			$this->m_users->change_pw($data);
			echo "success";
		}else{
			echo "pw_salah";
		}
	}

	public function loginx() {
		header('Content-Type: application/json');

		$username = trim($this->input->post('username'));
		$password = trim($this->input->post('password'));

		if(empty($username)) {
			http_response_code(422);
            $msg = ['err_status' => 'error', 'message' => $this->lang->line('woow_login_empty_username')];
            echo json_encode($msg, JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP|JSON_HEX_TAG);
            return;
		}
		if(empty($password)) {
			http_response_code(422);
            $msg = ['err_status' => 'error', 'message' => $this->lang->line('woow_login_empty_password')];
            echo json_encode($msg, JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP|JSON_HEX_TAG);
            return;
		}

		$getUser = $this->db->get_where('users', ['username' => $username]);
		$dt = $getUser->row();
		$bisaliat = [1,10];

		if(!in_array($dt->user_level, $bisaliat))
		{
			http_response_code(403);
            $msg = ['err_status' => 'error', 'message' => $this->lang->line('woow_unauthorized')];
            echo json_encode($msg, JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP|JSON_HEX_TAG);
            return;
		}

		if($getUser->num_rows() == 0) {
			http_response_code(422);
            $msg = ['err_status' => 'error', 'message' => $this->lang->line('woow_login_username_mismatch')];
            echo json_encode($msg, JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP|JSON_HEX_TAG);
            return;
		}

		if(password_verify($password, $dt->password) == FALSE) {
			http_response_code(422);
            $msg = ['err_status' => 'error', 'message' => $this->lang->line('woow_login_password_mismatch')];
            echo json_encode($msg, JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP|JSON_HEX_TAG);
            return;
		}

		$this->session->set_userdata(
			array(
				'status_login' => 'y',
				'userid' => $dt->userid,
				'username' => $dt->username,
				'userpic' => $dt->photo,
				'user_level' => $dt->user_level, 
				'sekolah_id' => $dt->sekolah_id, 
				'user_token' => (empty($dt->users_token)) ? md5(uniqid($dt->username, true)) : $dt->users_token, 
				'logged_in' => true
			)
		);

		http_response_code(200);
        $msg = ['err_status' => 'success', 'message' => 'Login Success','ulevel'=>$dt->user_level];
        echo json_encode($msg, JSON_HEX_APOS|JSON_HEX_AMP|JSON_HEX_TAG|JSON_HEX_QUOT);
        exit;
	}

	public function login()
	{ 
		chek_session_login();
		$data['google_link'] = $this->getgoogle_link();
		$data['facebook_link'] = $this->getfb_link();
		$this->load->view('login/index', $data);
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login');
	}


	public function test() {
		//$this->db->update('users', ['password' => password_hash('admin', PASSWORD_DEFAULT)], ['userid' => 1]);
		$data = [
			'username'		=> 'naquib',
			'password'		=> password_hash('123456', PASSWORD_DEFAULT),
			'user_level'	=> 1
		];
		$this->db->insert('users', $data);
	}

	##################################################### GOOGLE & FACEBOOK LOGIN #####################################################
	public function sign_in_popup(){
		$data['google_link'] = $this->getgoogle_link();
		$data['facebook_link'] = $this->getfb_link(); 
		$this->load->view('login/sign_in', $data);  
   	}

	private function getgoogle_link(){
		$this->load->library("Google");
		include_once APPPATH . "libraries/google-client/contrib/Google_Oauth2Service.php";

		$google_client = new Google();
		$google_client->setClientId(''); //Define your ClientID
		$google_client->setClientSecret(''); //Define your Client Secret Key
		$google_client->setRedirectUri(''); //Define your Redirect Uri

		// local config
		// $client_id = '619907275291-35nmtu88c480u7gfqfmsceas659d88n0.apps.googleusercontent.com'; // Google client ID
		$client_id = '637414319997-bko93nu7v2r6cq0tmig116hkcv370fq3.apps.googleusercontent.com'; // Google client ID
		// $client_secret = 'qDhnbMmBQOxXipqrysCkmcwu'; // Google Client Secret
		$client_secret = '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'; // Google Client Secret
		$redirect_url = 'https://localhost/woowcourse/woowcourse_1_3/login/google_sign_in'; // Callback URL


		$google_client->setApplicationName('Google Login'); // Set dengan Nama Aplikasi Kalian
		$google_client->setClientId($client_id); // Set dengan Client ID
		$google_client->setClientSecret($client_secret); // Set dengan Client Secret 
		$google_client->setRedirectUri($redirect_url); // Set URL untuk Redirect setelah berhasil login
		
		$google_oauthv2 = new Google_Oauth2Service($google_client);		 
		return $google_client->createAuthUrl();		 
	}

	private function getfb_link(){
		require_once APPPATH . "libraries/Facebook/autoload.php";

		// local config
		$facebook = new Facebook\Facebook ([
			// 'app_id' => '671931400184126',
			'app_id' => '1341891983366621',
			'app_secret' => 'a38146f41f593d35677427a8abaf7e25',
			// 'default_graph_version' => 'v9.0'
			'default_graph_version' => 'v18.0'
		]);

		$facebook_output = '';
		$facebook_helper = $facebook->getRedirectLoginHelper();	
		$facebook_permissions = ['email']; // Optional permissions
		$facebook_login_url = $facebook_helper->getLoginUrl('https://localhost/woowcourse/woowcourse_1_3/login/facebook_sign_in', $facebook_permissions); 
		return 	$facebook_login_url;
	}

	public function google_sign_in(){

		$this->load->library("Google");
		include_once APPPATH . "libraries/google-client/contrib/Google_Oauth2Service.php";
		$google_client = new Google();
		$google_client->setClientId(''); //Define your ClientID
		$google_client->setClientSecret(''); //Define your Client Secret Key
		$google_client->setRedirectUri(''); //Define your Redirect Uri
		$google_client->setScopes('email');
		$google_client->setScopes('profile');
			
		// local config
		$client_id = '637414319997-bko93nu7v2r6cq0tmig116hkcv370fq3.apps.googleusercontent.com'; // Google client ID
		$client_secret = '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'; // Google Client Secret
		$redirect_url = 'https://localhost/woowcourse/woowcourse_1_3/login/google_sign_in'; // Callback URL
			
 			
					 
		$google_client->setApplicationName('Google Login'); // Set dengan Nama Aplikasi Kalian
		$google_client->setClientId($client_id); // Set dengan Client ID
		$google_client->setClientSecret($client_secret); // Set dengan Client Secret 
		$google_client->setRedirectUri($redirect_url); // Set URL untuk Redirect setelah berhasil login
		$google_oauthv2 = new Google_Oauth2Service($google_client);		
	
		if(isset($_GET["code"])){
			
			 
			$google_client->authenticate($_GET['code']);  
			$token = $google_client->getAccessToken();
			
			if($google_client->getAccessToken()){
 
				$data = $google_oauthv2->userinfo->get();
 
				$data_user = array(
					'first_name' 	=> $data['given_name'],
					'last_name' 	=> $data['family_name'],
					'email' 		=> $data['email'],
					'active' 		=> 1,
				); 
							
				$valid_email = $this->user_model->check_user_email($data['email']);

				if($valid_email->num_rows() > 0) {
					$row_user = $valid_email->result();
					$data_user['last_login'] = date('d-m-Y h:i:s');
					
					// update user
					$this->db->where('userid', $row_user[0]->userid)->update('users', $data_user);
				}else{
					$this->session->set_flashdata('error', ['message' => 'Email tidak ditemukan, Harap melakukan registrasi!']);
					redirect('login');
					// $data_user['created_at'] = date('d-m-Y h:i:s');
					// insert user
					// $result = $this->db->insert('users',$data_user);						
				}
				
				$user_rec = $this->user_model->check_user_email($data['email']);
				$row_user = $user_rec->row_array();

				

				// $session_data = array(
				// 	'c_user_id' => $row_user[0]->user_id,
				// 	'c_email' => $data['email'],
				// 	'user_type' => $row_user[0]->user_type
				// );
				// Add user data in session
				// $this->session->set_userdata('c_email', $session_data);
				// $this->session->set_userdata('c_user_id', $session_data);
				// $this->session->set_userdata('user_type', $session_data);
				$this->session->set_userdata('user', $row_user);
				redirect('/');						
				
				$current_datetime = date('Y-m-d H:i:s');
 
			 }
		}
	}

	public function facebook_sign_in(){
		require_once APPPATH . "libraries/Facebook/autoload.php";
 
		// local config
		$facebook = new Facebook\Facebook ([
			// 'app_id' => '671931400184126',
			'app_id' => '1341891983366621',
			'app_secret' => 'a38146f41f593d35677427a8abaf7e25',
			// 'default_graph_version' => 'v9.0'
			'default_graph_version' => 'v18.0'
		]);

 
		$facebook_output = '';
		$facebook_helper = $facebook->getRedirectLoginHelper();

		try{
			$access_token = $facebook_helper->getAccessToken();
		}catch(Facebook\Exceptions\FacebookResponseException $e){
			echo 'Graph returned an error: ' . $e->getMessage();
  			exit;
		}catch(Facebook\Exception\SDKException $e){
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}

		if(isset($_GET['code'])){
			if(isset($_SESSION['access_token'])){
				$access_token = $_SESSION['access_token'];
			} else {
				// $access_token = $facebook_helper->getAccessToken();
				// $_SESSION['access_token'] = $access_token;
				$facebook->setDefaultAccessToken($access_token);
			}
			
			$graph_response = $facebook->get("/me?fields=name,email", $access_token);

			$facebook_user_info = $graph_response->getGraphUser();
			$fb_name = explode(" ", $facebook_user_info['name']);
			
			$data_user = array(
				'first_name' => $fb_name[0],
				'last_name' => $fb_name[1],
				'email' => $facebook_user_info['email'],
				'facebook_id' => $facebook_user_info['id'],
				'is_active' => 1,
				'user_type' => 1
			); 
					
			$valid_email = $this->user_model->check_user_email($facebook_user_info['email']);
			if($valid_email->num_rows() > 0) {
				$row_user = $valid_email->result();
				// $data_user['last_login'] = date('d-m-Y h:i:s');
				$this->db->where('userid', $row_user[0]->userid)->update('users', ['last_login'=>date('d-m-Y h:i:s')]);
				// $this->user_model->update_record($data_user, $row_user[0]->user_id);
			}else{
				// $data_user['created_at'] = date('d-m-Y h:i:s');
				// $result = $this->user_model->add($data_user);		
				$this->session->set_flashdata('error', ['message' => 'Email tidak ditemukan, Harap melakukan registrasi!']);
				redirect('login');				
			}
			
			$user_rec = $this->user_model->check_user_email($facebook_user_info['email']);
			$row_user = $user_rec->row_array();
			// $session_data = array(
			// 	'c_user_id' => $row_user[0]->user_id,
			// 	'c_email' => $facebook_user_info['email'],
			// 	'user_type' => $row_user[0]->user_type
			// );
			// Add user data in session
			// $this->session->set_userdata('c_email', $session_data);
			// $this->session->set_userdata('c_user_id', $session_data);
			// $this->session->set_userdata('user_type', $session_data);
			// redirect('/');	
			unset($row_user['password']);
			$this->session->set_userdata('user', $row_user);
			redirect('dashboard');
		}
	}

	public function check_facebook_email(){
		$post = $this->input->post();

		// check email apakah sudah ada di tabel users
		// $user = $this->db->where('email', $post['email'])->get('users')->row_array();
		$user = $this->user_model->login($post['email']);
		if(!$user){
			$response = ['success' => false, 'message' => 'Email tidak ditemukan'];
		}else{
			unset($user['password']);
			$this->session->set_userdata('user', $user);
			$response = ['success' => true, 'message' => 'Email ditemukan'];
		}

		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($response);
	}

}
