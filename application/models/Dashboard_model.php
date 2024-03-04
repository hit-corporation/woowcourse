<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_new_instructor():array{
		$q = $this->db->select('m.*')
				->join('members m', 'm.email=i.email')
				->limit('10')
				->order_by('id','desc')
				->where('as_instructor', true)
				->get('instructors i');

		return $q->result_array();
	}

	public function get_member_by_rating(): array{
		$q =  $this->db->select('r.*, m.first_name, m.last_name, m.photo')
				->where('rate >=', 4)
				->join('members m', 'm.id=r.member_id')
				->limit(5)->order_by('id', 'desc')
				->get('ratings r');

		return $q->result_array();
	}

	public function running_fine(){
		$running_fine = $this->db->select('*')
			->from('reports')
			->where('actual_return', null)
			->get()->result_array();

		return $running_fine;
	}

	public function fines_this_month(){
		$this->db->select('SUM(fines_payment) as total_fine');
		$this->db->from('reports');
		$this->db->where('EXTRACT(MONTH FROM actual_return)=', date('m'));
		$this->db->where('EXTRACT(YEAR FROM actual_return)=', date('Y'));
		
		return $this->db->get()->row()->total_fine;
	}

	public function fines_last_month(){
		$this->db->select('SUM(fines_payment) as total_fine');
		$this->db->from('reports');
		$this->db->where('EXTRACT(MONTH FROM actual_return)=',date('m') - 1);
		$this->db->where('EXTRACT(YEAR FROM actual_return)=', date('Y'));

		return $this->db->get()->row()->total_fine;
	}

}
