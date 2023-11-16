<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Instructor_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function detail($id){
		$this->db->where('id', $id);
		return $this->db->get('instructors')->row_array();
	}

	public function get_courses($id){
		$this->db->where('instructor_id', $id);
		return $this->db->get('courses')->result_array();
	}
}
