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

		$data['data'] = $this->db->where('id', $post['id'])->get('transactions')->row_array() ?? [];
		$data['details'] = $this->db->where('transaction_id', $post['id'])
							->join('courses c','c.id = t.course_id','left')
							->join('instructors i','i.id = c.instructor_id','left')
							->get('transaction_details t')->result_array();

		echo json_encode($data, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
	}

	function array2csv(array &$array)
	{
		if (count($array) == 0) {
			return null;
		}
		ob_start();
		$df = fopen("php://output", 'w');
		fputcsv($df, array_keys(reset($array)));
		foreach ($array as $row) {
			fputcsv($df, $row);
		}
		fclose($df);
		return ob_get_clean();
	}

	function download_send_headers($filename) {
		// disable caching
		$now = gmdate("D, d M Y H:i:s");
		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Last-Modified: {$now} GMT");
	
		// force download  
		header("Content-Type: application/force-download");
		header("Content-Type: application/octet-stream");
		header("Content-Type: application/download");
	
		// disposition / encoding on response body
		header("Content-Disposition: attachment;filename={$filename}");
		header("Content-Transfer-Encoding: binary");
	}

	public function download_payment(){
		$get = $this->input->get();
		$this->download_send_headers("data_export_" . date("Y-m-d") . ".csv");
		$array = [
			[
				'nama' => 'ahmad'
			],
			[
				'nama' => 'fauzi'
			]
		];
		echo $this->array2csv($array);
		die();
	}

}
