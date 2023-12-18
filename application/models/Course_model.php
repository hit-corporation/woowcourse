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

    public function get_all(): array {
        $query = $this->db->get('rating');

        return $query->result_array();
    }
}