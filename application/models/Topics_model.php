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
        
        if(!empty($limit) && !is_null($offset))
            $this->db->limit($limit, $offset);
            
        $query = $this->db->get('courses');
        return $query->result_array();
    }

	public function get_total($filter){
		if(!empty($filter['title']))
			$this->db->where('LOWER(course_title) LIKE \'%'.trim(strtolower($filter['title'])).'%\'', NULL, FALSE);

		$query = $this->db->get('courses');
		return $query->num_rows();
	}
}
