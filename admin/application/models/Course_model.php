<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Course_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get All Data
	 *
	 * @param array|null $filter
	 * @param integer|null $limit
	 * @param integer|null $offset
	 * @return array
	 */
	public function get_all(?array $filters=null, ?int $limit=null, int $offset=null): array {

		$this->db->select('c.*, ct.category_name, i.first_name, i.last_name');
		$this->db->from('courses c');
		$this->db->join('categories ct', 'c.category_id = ct.id', 'left');
		$this->db->join('instructors i', 'i.id = c.instructor_id', 'left');

		if(!empty($filters[0]['search']['value']))
			$this->db->where('LOWER(c.course_title) LIKE \'%'.trim(strtolower($filters[0]['search']['value'])).'%\'', NULL, FALSE);

		if(!empty($filters[1]['search']['value']))
			$this->db->where('LOWER(i.first_name) LIKE \'%'.trim(strtolower($filters[1]['search']['value'])).'%\'', NULL, FALSE)->or_where('LOWER(i.last_name) LIKE \'%'.trim(strtolower($filters[1]['search']['value'])).'%\'', NULL, FALSE);

		if(!empty($limit) && !is_null($offset))
			$this->db->limit($limit, $offset);

		return $this->db->get()->result_array();
	}

	public function count_all(?array $filters=null): int {

		$this->db->select('c.*, ct.category_name, i.first_name, i.last_name');
		$this->db->from('courses c');
		$this->db->join('categories ct', 'c.category_id = ct.id', 'left');
		$this->db->join('instructors i', 'i.id = c.instructor_id', 'left');

		if(!empty($filters[0]['search']['value']))
			$this->db->where('LOWER(c.course_title) LIKE \'%'.trim(strtolower($filters[0]['search']['value'])).'%\'', NULL, FALSE);

		if(!empty($filters[1]['search']['value']))
			$this->db->where('LOWER(i.first_name) LIKE \'%'.trim(strtolower($filters[1]['search']['value'])).'%\'', NULL, FALSE)->or_where('LOWER(i.last_name) LIKE \'%'.trim(strtolower($filters[1]['search']['value'])).'%\'', NULL, FALSE);

		return $this->db->get()->num_rows();
	}
}
