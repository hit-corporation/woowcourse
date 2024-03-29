<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Instructor_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function detail($id){
		$this->db->select('i.*, m.photo');
		$this->db->from('instructors i');
		$this->db->where('m.id', $id);
		$this->db->join('members m', 'm.email = i.email');
		return $this->db->get()->row_array();
	}

	public function get_courses($id){
		$this->db->where('instructor_id', $id);
		return $this->db->get('courses')->result_array();
	}

	public function get_popular_instructors(){
		$this->db->select('s.instructor_id, count(s.instructor_id) as total');
		$this->db->from('subscriptions s');
		$this->db->group_by('s.instructor_id');
		$this->db->order_by('total', 'desc');
		$this->db->limit('12');
		return $this->db->get()->result_array();
	}

	public function get_all($start = null, $limit = null, $filter = []):array{
		$this->db->select('m.*, i.about, i.id as instructor_id');
		$this->db->from('members m');
		$this->db->join('instructors i', 'm.email = i.email', 'left');
		$this->db->where('as_instructor', 'true');
		return $this->db->get()->result_array();
	}
}
