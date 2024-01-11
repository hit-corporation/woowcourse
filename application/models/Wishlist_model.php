<?php

class Wishlist_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function get_all(array $filter = [], int $limit = null, int $page = null): array{
		if(isset($filter['member_id'])){
			$this->db->where('member_id', $filter['member_id']);
		}

		$this->db->select('w.*, c.course_img, c.course_title, c.price, i.first_name, i.last_name');
		$this->db->from('wishlists w');
		$this->db->join('courses c', 'c.id = w.course_id', 'left');
		$this->db->join('instructors i', 'i.id = c.instructor_id', 'left');

		return $this->db->get()->result_array() ?? [];
	}
}
