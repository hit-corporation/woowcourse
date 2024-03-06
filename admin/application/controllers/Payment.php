<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends MY_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(['payment_model']);
	}

	public function index(){
		$data['payment_methods'] = $this->db->select('payment_method')->group_by('payment_method')->get('transactions t')->result_array();
		$data['status'] = $this->db->select('status')->group_by('status')->get('transactions t')->result_array();

		// MENGGUNAKAN TEMPLATE ENGINE PLATES
		echo $this->template->render('index', $data);
	}

	public function get_all_paginated(): void {
		$limit  = $this->input->get('length');
		$offset = $this->input->get('start');
        $filter = $this->input->get('columns');

        $dataTable = [
            'draw'            => $this->input->get('draw') ?? NULL,
            'data'            => $this->payment_model->get_all($filter, $limit, $offset),
            'recordsTotal'    => $this->db->count_all_results('members'),
            'recordsFiltered' => $this->payment_model->count_all($filter)
        ];

        echo json_encode($dataTable, JSON_HEX_AMP | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT);
	}

	/**
     * get all data
     *
     * @return void
     */
    public function get_all(): void {
        $data = $this->payment_model->get_all();

        echo json_encode($data, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
    }

	public function get_payment(){
		$post = $this->input->post();

		$data['data'] = $this->db->where('id', $post['id'])->get('transactions')->row_array();
		$data['details'] = $this->db->where('transaction_id', $post['id'])->get('transaction_details')->result_array();

		echo json_encode($data, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
	}

}
