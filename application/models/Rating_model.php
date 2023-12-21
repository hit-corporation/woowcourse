<?php

class Rating_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function get_data(int $id): array{
		$this->db->select('r.*, m.first_name, m.last_name');
		$this->db->from('ratings r');
		$this->db->join('members m', 'm.id = r.member_id');
		$this->db->where('course_id', $id);
		return $this->db->get()->result_array() ?? [];
	}
}
