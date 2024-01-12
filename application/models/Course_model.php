<?php

class Course_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Insert Or Update
     *
     * @return boolean
     */
    public function upsert(): bool {

    }

    public function get_all_ratings(): array {
        $query = $this->db->get('rating');
        return $query->result_array() ?? [];
    }

	public function get_all_carts($id): array{
		$this->db->select('c.*, co.course_title, co.course_img, co.price');
		$this->db->from('carts c');
		$this->db->join('members m', 'm.id = c.member_id');
		$this->db->join('courses co', 'co.id = c.course_id');
		$this->db->where('member_id', $id);
		return $this->db->get()->result_array() ?? [];
		
	}

	public function get_all_wishlist($id): array{
		$this->db->select('w.*, co.course_title, co.course_img, co.price, co.rating, m.first_name, m.last_name');
		$this->db->from('wishlists w');
		$this->db->join('members m', 'm.id = w.member_id');
		$this->db->join('courses co', 'co.id = w.course_id');
		$this->db->where('member_id', $id);
		return $this->db->get()->result_array() ?? [];
		
	}
}
