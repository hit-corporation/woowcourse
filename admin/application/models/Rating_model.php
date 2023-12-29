<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Rating_model extends CI_Model {

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
		if(!empty($filters[2]['search']['value'])) $categories = $this->get_categories($filters[2]['search']['value']);

		$this->db->select('c.*, r.id, r.created_at as tanggal_rating, r.rate, r.comments, ct.category_name, m.first_name, m.last_name');
		$this->db->from('ratings r');
		$this->db->join('courses c', 'r.course_id = c.id', 'left');
		$this->db->join('categories ct', 'c.category_id = ct.id', 'left');
		$this->db->join('members m', 'm.id = r.member_id', 'left');
		
		if(!empty($filters[0]['search']['value']))
			$this->db->where('LOWER(c.course_title) LIKE \'%'.trim(strtolower($filters[0]['search']['value'])).'%\'', NULL, FALSE);

		if(!empty($filters[1]['search']['value'])){
			$this->db->where('LOWER(m.first_name) LIKE \'%'.trim(strtolower($filters[1]['search']['value'])).'%\'', NULL, FALSE)->or_where('LOWER(m.last_name) LIKE \'%'.trim(strtolower($filters[1]['search']['value'])).'%\'', NULL, FALSE);
		}

		if(!empty($filters[2]['search']['value'])){
			$this->db->where_in('category_id', $categories);
		}

		if(!empty($limit) && !is_null($offset))
			$this->db->limit($limit, $offset);

		return $this->db->get()->result_array();
	}

	public function count_all(?array $filters=null): int {

		$this->db->select('c.*, r.id, r.created_at as tanggal_rating, r.rate, r.comments, ct.category_name, m.first_name, m.last_name');
		$this->db->from('ratings r');
		$this->db->join('courses c', 'r.course_id = c.id', 'left');
		$this->db->join('categories ct', 'c.category_id = ct.id', 'left');
		$this->db->join('members m', 'm.id = r.member_id', 'left');

		if(!empty($filters[0]['search']['value']))
			$this->db->where('LOWER(c.course_title) LIKE \'%'.trim(strtolower($filters[0]['search']['value'])).'%\'', NULL, FALSE);

		if(!empty($filters[1]['search']['value']))
			$this->db->where('LOWER(i.first_name) LIKE \'%'.trim(strtolower($filters[1]['search']['value'])).'%\'', NULL, FALSE)->or_where('LOWER(i.last_name) LIKE \'%'.trim(strtolower($filters[1]['search']['value'])).'%\'', NULL, FALSE);

		if(!empty($filters[2]['search']['value']))
			$this->db->where('category_id', $filters[2]['search']['value']);

		return $this->db->get()->num_rows();
	}

	public function get_categories($categories){
	
		// check child 1
		$child_1 = $this->db->where_in('parent_category', $categories)->get('categories')->result_array();
		$data = array_column($child_1, 'id');

		// check child 2
		if(!empty($data)){
			$child_2 = $this->db->where_in('parent_category', $data)->get('categories')->result_array();
			$child_2 = array_column($child_2, 'id');
			$data = array_merge($data, $child_2);
		}

		$data = array_merge($data, $categories);
		return $data;

		// check child 3
	}
}
