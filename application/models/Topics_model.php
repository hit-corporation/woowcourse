<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Topics_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_all(?array $filter = NULL, ?int $limit=NULL, ?int $offset=NULL): array {
		if(!empty($filter['categories'])){ // BLOK INI DI LETAKAN DI ATAS AGAR TIDAK BENTROK DENGAN QUERY BAWAH YG MENYEBABKAN ERROR
			$category = $this->get_categories($filter['categories']);
			$this->db->where_in('co.category_id', $category);
		}

		$this->db->select('co.*, co.id as topic_id, m.photo as photo_instructor, m.first_name, m.last_name');
		$this->db->from('courses co');
		$this->db->join('instructors i', 'co.instructor_id = i.id', 'left');
        $this->db->join('members m', 'm.email = i.email', 'left');

        if(!empty($filter['title']))
            $this->db->where('LOWER(co.course_title) LIKE \'%'.trim(strtolower($filter['title'])).'%\'', NULL, FALSE);
        
        if(!empty($limit) && !is_null($offset))
            $this->db->limit($limit, $offset);

		if(!empty($filter['ratingChecked'])){
			$this->db->where_in('FLOOR(co.rating)', $filter['ratingChecked']);
		}
    
        return $this->db->get()->result_array();
    }

	public function get_total($filter){
		if(!empty($filter['title']))
			$this->db->where('LOWER(course_title) LIKE \'%'.trim(strtolower($filter['title'])).'%\'', NULL, FALSE);

		$query = $this->db->get('courses');
		return $query->num_rows();
	}

	public function get_categories($categories){
	
		// check child 1
		$child_1 = $this->db->where_in('cat.parent_category', $categories)->get('categories cat')->result_array();
		$data = array_column($child_1, 'id');

		// check child 2
		if(!empty($data)){
			$child_2 = $this->db->where_in('cat2.parent_category', $data)->get('categories cat2')->result_array();
			$child_2 = array_column($child_2, 'id');
			$data = array_merge($data, $child_2);
		}

		$data = array_merge($data, $categories);
		return $data;

		// check child 3
	}

	public function detail($id){
		$this->db->select('c.*, m.first_name, m.last_name, m.photo');
		$this->db->from('courses c');
		$this->db->where('c.id', $id);
		$this->db->join('instructors i', 'i.id = c.instructor_id', 'left');
		$this->db->join('members m', 'm.email = i.email', 'left');
		return $this->db->get()->row_array();
	}

	public function get_course($id){
		$this->db->select('c.*, i.first_name, i.last_name, m.photo');
		$this->db->from('courses c');
		$this->db->join('instructors i', 'i.id = c.instructor_id');
		$this->db->join('members m', 'm.email = i.email');
		$this->db->where('c.id', $id);
		return $this->db->get()->row_array();
	}

	public function get_topic_subscribe(){
		$this->db->select('topic_id, count(topic_id) as jumlah');
		$this->db->from('subscriptions s');
		$this->db->group_by('topic_id');
		$this->db->order_by('jumlah', 'desc');
		$this->db->limit('12');
		return $this->db->get()->result_array();
	}

	public function get_new_courses(){
		return $this->db->select('courses.*, members.photo, members.first_name, members.last_name')
					->from('courses')
					->join('instructors', 'instructors.id = courses.instructor_id')
					->join('members', 'members.email = instructors.email', 'left')
					->order_by('courses.id', 'DESC')
					->limit('12')
					->get()->result_array();
	}
}
