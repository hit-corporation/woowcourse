<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'User.php';

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('user_model');
	}

	public function index(){
		$post = $this->input->post();

		if(isset($post['submit'])) {
			$data = [
				'email' => $post['email']
			];

			$this->form_validation->set_rules('email', 'email', 'required|callback_is_exists', [
				'is_exists' => 'email tidak di kenali !!!'
			]);
			$this->form_validation->set_rules('password', 'Password', 'required');


			if(!$this->form_validation->run()) 
			{
				$this->session->set_flashdata('error', ['errors' => $this->form_validation->error_array(),'old' => $_POST]);
				redirect('login');
			}

			$user = $this->user_model->login($data);

			if(!password_verify($post['password'], $user['password']))
			{
				$this->session->set_flashdata('error', ['message' => 'email atau password tidak valid','old' => $_POST]);
				redirect('login');
			}

			unset($user['password']);
			$this->session->set_userdata('user', $user);
			redirect('dashboard');
		}

		 

		$data['google_link'] = $this->getgoogle_link();
		$data['facebook_link'] = $this->getfb_link();

		$this->load->view('login/index', $data);
	}

	public function register(){
		$post = $this->input->post();
		
		if(isset($post['submit'])){
			$this->form_validation->set_rules('userName', 'User Name', 'required');
			$this->form_validation->set_rules('fullName', 'Full Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('repeatPassword', 'Repeat Password', 'required|matches[password]');

			if($this->form_validation->run() == TRUE){
				$data = [
					'username' 		=> $post['userName'],
					'full_name' 	=> $post['fullName'],
					'email' 		=> $post['email'],
					'password' 		=> password_hash($post['password'], PASSWORD_DEFAULT),
					'active' 		=> 1,
					'user_level' 	=> 1
				];
				$insert = $this->db->insert('users', $data);

				if($insert){
					$this->session->set_flashdata('success', ['message' => 'Registrasi berhasil']);
				}else{
					$this->session->set_flashdata('error', ['message' => 'Registrasi gagal']);
				}
				redirect(base_url('login'));
			}
		}

		$this->load->view('login/register');
	}

	public function email_register() {
		$this->load->view('email/registration');
	}

	public function forgot_password(){
		$this->load->view('login/forgot_password');
	}

	public function logout(){
		$this->session->unset_userdata('user');
		redirect(base_url('login'));
	}

	/*
	*************************************************
	*			VALIDATION CALLBACK
	*************************************************
	*/

	/**
	 * Check if username is exists callback
	 *
	 * @param [type] $str
	 * @return boolean
	 */
	public function is_exists($str): bool {
		if($this->db->get_where('users', ['email' => $str])->num_rows() == 0)
			return false;
		return true;
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
		$redirect_url = 'https://localhost/woowcourse/woowcourse_1_3/admin/login/google_sign_in'; // Callback URL


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
			'app_id' => '671931400184126',
			'app_secret' => '57002c8948829ea5cf24758fc0af215a',
			'default_graph_version' => 'v9.0'
		]);

		$facebook_output = '';
		$facebook_helper = $facebook->getRedirectLoginHelper();	
		$facebook_permissions = ['email']; // Optional permissions
		$facebook_login_url = $facebook_helper->getLoginUrl('http://localhost:82/user/facebook_sign_in', $facebook_permissions); 
		return 		$facebook_login_url;
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
		$redirect_url = 'https://localhost/woowcourse/woowcourse_1_3/admin/login/google_sign_in'; // Callback URL
			
 			
					 
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
					'full_name' => $data['given_name'].' '.$data['family_name'],
					'email' => $data['email'],
					'active' => 1,
				); 
							
				$valid_email = $this->user_model->check_user_email($data['email']);
				if($valid_email->num_rows() > 0) {
					$row_user = $valid_email->result();
					$data_user['last_login'] = date('d-m-Y h:i:s');
					
					// update user
					$this->db->where('userid', $row_user[0]->userid)->update('users', $data_user);
				}else{
					$data_user['created_at'] = date('d-m-Y h:i:s');
					
					// insert user
					$result = $this->db->insert('users',$data_user);						
				}
				
				$user_rec = $this->user_model->check_user_email($data['email']);
				$row_user = $user_rec->row_array();

				########## Check data user di table members dan instructor ##########

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
			'app_id' => '671931400184126',
			'app_secret' => '57002c8948829ea5cf24758fc0af215a',
			'default_graph_version' => 'v9.0'
		]);
					
 
		$facebook_output = '';
		$facebook_helper = $facebook->getRedirectLoginHelper();

		if(isset($_GET['code'])){
			if(isset($_SESSION['access_token'])){
				$access_token = $_SESSION['access_token'];
			} else {
				$access_token = $facebook_helper->getAccessToken();
				$_SESSION['access_token'] = $access_token;
				$facebook->setDefaultAccessToken($_SESSION['access_token']);
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
				$data_user['last_login_date'] = date('d-m-Y h:i:s');
				$this->user_model->update_record($data_user, $row_user[0]->user_id);
			}else{
				$data_user['created_at'] = date('d-m-Y h:i:s');
				$result = $this->user_model->add($data_user);						
			}
			
			$user_rec = $this->user_model->check_user_email($facebook_user_info['email']);
			$row_user = $user_rec->result();
			$session_data = array(
				'c_user_id' => $row_user[0]->user_id,
				'c_email' => $facebook_user_info['email'],
				'user_type' => $row_user[0]->user_type
			);
			// Add user data in session
			$this->session->set_userdata('c_email', $session_data);
			$this->session->set_userdata('c_user_id', $session_data);
			$this->session->set_userdata('user_type', $session_data);
			redirect('/');	
		}
	}

}
