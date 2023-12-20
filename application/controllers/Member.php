<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		$this->load->model('member_model');
		$this->load->library('form_validation');
	}

	 /**
     * function for view
     *
     * @return void
     */
	public function index(): void {
		echo $this->template->render('index');
	}

	public function get_all_paginated(): void {
		$limit  = $this->input->get('length');
		$offset = $this->input->get('start');
        $filter = $this->input->get('columns');

        $dataTable = [
            'draw'            => $this->input->get('draw') ?? NULL,
            'data'            => $this->member_model->get_all($filter, $limit, $offset),
            'recordsTotal'    => $this->db->count_all_results('members'),
            'recordsFiltered' => $this->member_model->count_all($filter)
        ];

        echo json_encode($dataTable, JSON_HEX_AMP | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
	}

	/**
     * get all data
     *
     * @return void
     */
    public function get_all(): void {
        $data = $this->member_model->get_all();

        if(!empty($this->input->get('is_borrowing')))
            $data = $this->member_model->get_borrowing_member();

        echo json_encode($data, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
    }

	/**
     * Storing submitted Data to database
     *
     * @return void
     */
    public function store(): void
    {
        $member_name   	= $this->input->post('member_name');
        $card_number 	= $this->input->post('card_number');
        $no_induk 	= $this->input->post('no_induk');
        $email 		= $this->input->post('email');
        $address 	= $this->input->post('address');
        $phone 		= $this->input->post('phone');

        $this->form_validation->set_rules('no_induk', 'Nomor Induk', 'required');
        $this->form_validation->set_rules('member_name', 'Nama', 'required');

        if(!$this->form_validation->run())
        {
            $return = ['success' => false, 'errors' => $this->form_validation->error_array(), 'old' => $_POST];
            $this->session->set_flashdata('error', $return);
            redirect($_SERVER['HTTP_REFERER']);
        }

        $data = [
            'member_name' 			=> $member_name,
			'card_number'			=> $card_number,
            'no_induk' 				=> $no_induk,
            'email' 				=> $email,
            'address' 				=> $address,
            'phone' 				=> $phone,
			'created_at' 			=> date('Y-m-d H:i:s'),
        ];

        if(!$this->db->insert('members', $data))
        {
            $return = ['success' => false, 'message' =>  'Data Gagal Di Simpan', 'old' => $_POST];
            $this->session->set_flashdata('error', $return);
            redirect($_SERVER['HTTP_REFERER']);
        }
       
       $return = ['success' => true, 'message' =>  'Data Berhasil Di Simpan'];
       $this->session->set_flashdata('success', $return);
       redirect($_SERVER['HTTP_REFERER']);
    }

	/**
     * Editing data in database
     *
     * @return void
     */
    public function edit(): void
    {
        $id     		= trim($this->input->post('member_id', TRUE));
        $member_name   	= trim($this->input->post('member_name', TRUE));
        $card_number 	= trim($this->input->post('card_number', TRUE));
        $no_induk   	= trim($this->input->post('no_induk', TRUE));
        $email   		= trim($this->input->post('email', TRUE));
        $address   		= trim($this->input->post('address', TRUE));
        $phone   		= trim($this->input->post('phone', TRUE));

		$this->form_validation->set_rules('no_induk', 'Nomor Induk', 'required');
		$this->form_validation->set_rules('member_name', 'Nama Member', 'required');

        if(!$this->form_validation->run())
        {
            $return = ['success' => false, 'errors' => $this->form_validation->error_array(), 'old' => $_POST];
            $this->session->set_flashdata('error', $return);
            redirect($_SERVER['HTTP_REFERER']);
        }

        $data = [
            'member_name' => $member_name,
            'no_induk' => $no_induk,
            'email' => $email,
            'address' => $address,
            'phone' => $phone,
            'card_number' => $card_number
        ];

        if(!$this->db->update('members', $data, ['id' => $id]))
        {
            $return = ['success' => false, 'message' =>  'Data Gagal Di Simpan', 'old' => $_POST];
            $this->session->set_flashdata('error', $return);
            redirect($_SERVER['HTTP_REFERER']);
        }
       
       $return = ['success' => true, 'message' =>  'Data Berhasil Di Simpan'];
       $this->session->set_flashdata('success', $return);
       redirect($_SERVER['HTTP_REFERER']);
    }

	/**
     * Delete data in db
     *
     * @return void
     */
    public function erase(int $id): void {
        if(!$this->db->update('members', ['deleted_at' => date('Y-m-d H:i:s')], ['id' => $id]))
        {
            $return = ['success' => false, 'message' =>  'Data Gagal Di Hapus'];
            $this->session->set_flashdata('error', $return);
            redirect($_SERVER['HTTP_REFERER']);
        }

        $return = ['success' => true, 'message' =>  'Data Berhasil Di Hapus'];
        $this->session->set_flashdata('success', $return);
        redirect($_SERVER['HTTP_REFERER']);
    }

	/**
	 * Get data by id
	 *
	 * @return void
	 */
	public function get_by_card_number(string $card_number): void {
		$data = $this->member_model->get_by_card_number($card_number);
		echo json_encode($data, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
	}

	/**
	 * Get data by member name
	 *
	 * @return void
	 */
	public function get_by_member_name(string $member_name): void {
		$data = $this->member_model->get_by_member_name($member_name);
		echo json_encode($data, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
	}

	/**
	 * Import dataa from excel
	 *
	 * @return void
	 */
	public function import(): void {
		require_once APPPATH.'third_party'.DIRECTORY_SEPARATOR.'xlsx'.DIRECTORY_SEPARATOR.'SimpleXLSX.php';
		// Upload
		$config['upload_path'] = 'assets/files/uploads';
		$config['allowed_types'] = 'xlsx|xls';
		$config['max_size'] = 10000;
		$config['overwrite'] = TRUE;
		$config['file_name'] = 'member_'.time();

		$this->load->library('upload', $config);

		if(!$this->upload->do_upload('file'))
		{
			$resp = ['success' => false, 'message' => $this->upload->display_errors(), 'old' => $_POST];
			$this->session->set_flashdata('error', $resp);
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}

		$data = $this->upload->data();
		// Parse Excel
		if(!$xlsx = SimpleXLSX::parse($data['full_path']))
			throw new Exception(SimpleXLSX::parseError());
		$excel = $xlsx->rows(0);
		unset($excel[0]);
		// looping data

		$this->db->trans_start();
		foreach($excel as $x)
		{
			$ls = [
				'member_name'	=> $x[0],
				'no_induk'		=> "$x[1]",
				'kelas'			=> $x[2],
				'card_number'	=> "$x[3]",
				'email'			=> $x[4],
				'phone'			=> "$x[5]",
				'address'		=> $x[6]
			];
			
			if($this->db->get_where('members', ['no_induk' => "$x[1]" ])->num_rows() > 0)
				$this->db->update('members', $ls, ['no_induk' => "$x[1]"]);
			else
				$this->db->insert('members', $ls);
		}
		$this->db->trans_complete();

		if($this->db->trans_status() == FALSE)
		{
			$this->session->set_flashdata('error', ['message' => 'Beberapa data gagal di input']);
			redirect($_SERVER['HTTP_REFERER']);
			return;
		}

		@unlink($data['full_path']);

		$this->session->set_flashdata('success', ['message' => 'Beberapa data berhasil di input']);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function detail(){
		$post = $this->input->post();

		if(isset($post['type']) && $post['type'] == 'update'){
			// load file helper
			$this->load->helper('file');
			// upload images
			$config['upload_path']          = './assets/images/members/';
			$config['allowed_types']        = 'gif|jpg|jpeg|png';
			$config['max_size']             = 2048;
			$config['encrypt_name']         = true;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('image')){
				// upload fails
				// $resp = ['success' => false, 'message' => $this->upload->display_errors()];
				// $this->session->set_flashdata('error', $resp);
				// echo json_encode($resp); die;
			}else{
				// upload success
				$upload_data = $this->upload->data();
				// resize image
				$config['image_library'] 	= 'gd2';
				$config['source_image'] 	= './assets/images/members/'.$upload_data['file_name'];
				$config['create_thumb'] 	= FALSE;
				$config['maintain_ratio'] 	= FALSE;
				$config['width']         	= 300;
				$config['height']       	= 300;

				$this->load->library('image_lib', $config);
				$this->image_lib->resize();	

				// remove old image jika sudah ada fotonya
				$old_image = $this->db->where('email', $post['email'])->get('members')->row_array();
				if($old_image){
					$old_image = $old_image['photo'];
					if($old_image != '' || $old_image != null){
						unlink('./assets/images/members/'.$old_image);
					}
					
					$data = [ 'photo' => $upload_data['file_name']];
	
					// update foto member
					if(isset($data['photo'])){
						$update = $this->db->where('email', $post['email'])->update('members', $data);
					}
				}
			}

			// cek apakah data sudah ada di tabel members apa belum
			$member = $this->db->where('email', $post['email'])->get('members')->row_array();

			// jika data member tidak ada maka lakukan insert
			if(!$member){
				$data = [ 
					'first_name' => $post['first_name'],
					'last_name' => $post['last_name'],
					'phone' => $post['phone'],
					'email' => $post['email'],
					'photo' => isset($upload_data['file_name']) ? $upload_data['file_name'] : null,
					'last_login_date' => date('Y-m-d H:i:s'),
					'as_instructor' => $post['as_instructor'],
				];
				

				$simpan = $this->db->insert('members', $data);

				// jika as_instructor di check simpan data ke tabel instructors
				if($post['as_instructor'] == 'true'){
					$data['address'] = $post['address'];
					$data['about'] = base64_decode($post['about']);
					unset($data['last_login_date']);
					unset($data['as_instructor']);
					$simpan = $this->db->insert('instructors', $data);
				}

				$res = isset($simpan) ?  ['success' => true, 'message' => 'Data berhasil disimpan.'] :  ['success' => false, 'message' => 'Data gagal disimpan.'];
				// set success message
				$this->session->set_flashdata('success', $res);
				echo json_encode($res); die;
			}else{
				$data = [ 
					'first_name' 	=> $post['first_name'],
					'last_name' 	=> $post['last_name'],
					'phone' 		=> $post['phone'],
					'as_instructor' => $post['as_instructor'],
				];
				
				$update = $this->db->where('email', $post['email'])->update('members', $data);

				// jika as_instructor di check update data tabel instructors
				if($post['as_instructor'] == true){
					$data['address'] = $post['address'];
					$data['about'] = base64_decode($post['about']);
					unset($data['as_instructor']);
					$update = $this->db->where('email', $post['email'])->update('instructors', $data);
				}

				$res = isset($update) ?  ['success' => true, 'message' => 'Data berhasil diubah.'] :  ['success' => false, 'message' => 'Data gagal diubah.'];
				// set success message
				$this->session->set_flashdata('success', $res);
				echo json_encode($res); die;
			}
		}


		$email = $this->session->userdata('user')['email'];
		$data['data'] = $this->member_model->get_by_email($email);

		echo $this->template->render('member/detail', $data);
	}
}
