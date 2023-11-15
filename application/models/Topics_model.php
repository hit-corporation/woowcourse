<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Topics_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all(?array $filter = NULL, ?int $limit=NULL, ?int $offset=NULL): array {
        if(!empty($filter['title']))
            $this->db->where('LOWER(course_title) LIKE \'%'.trim(strtolower($filter['title'])).'%\'', NULL, FALSE);

		if(!empty($filter['categories'])){
			$category = $this->get_categories($filter['categories']);
			$this->db->where_in('category_id', $category);
		}
        
        if(!empty($limit) && !is_null($offset))
            $this->db->limit($limit, $offset);

		if(!empty($filter['ratingChecked'])){
			$this->db->where_in('FLOOR(rating)', $filter['ratingChecked']);
		}
            
        $query = $this->db->get('courses');
        return $query->result_array();
    }

	public function get_total($filter){
		if(!empty($filter['title']))
			$this->db->where('LOWER(course_title) LIKE \'%'.trim(strtolower($filter['title'])).'%\'', NULL, FALSE);

		$query = $this->db->get('courses');
		return $query->num_rows();
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

	public function detail($id){
		$this->db->where('c.id', $id);
		$this->db->join('instructors i', 'i.id = c.instructor_id', 'left');
		return $this->db->get('courses c')->row_array();
	}
}
