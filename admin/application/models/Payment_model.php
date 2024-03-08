<?php

class Payment_model extends CI_Model {

    public function __construct(){
        parent::__construct();
    }

	public function get_all(?array $filter = NULL, ?int $limit=NULL, ?int $offset=NULL): array {
        $this->db->select('t.*, m.first_name, m.last_name');
        $this->db->from('transactions t');

		if(!empty($filter[1]['search']['value'])){
			$this->db->group_start();
				$this->db->where('LOWER(m.first_name) LIKE \'%'.trim(strtolower($filter[1]['search']['value'])).'%\'', NULL, FALSE);
				$this->db->or_where('LOWER(m.last_name) LIKE \'%'.trim(strtolower($filter[1]['search']['value'])).'%\'', NULL, FALSE);
			$this->db->group_end();
		}

		if(!empty($filter[2]['search']['value']))
			$this->db->where('date(t.created_at) >= ', $filter[2]['search']['value'], NULL, FALSE);

		if(!empty($filter[3]['search']['value']))
			$this->db->where('date(t.created_at) <= ', $filter[3]['search']['value'], NULL, FALSE);
		
		if(!empty($filter[4]['search']['value']))
			$this->db->where('t.payment_method', $filter[4]['search']['value'], NULL, FALSE);

		if(!empty($filter[5]['search']['value']))
			$this->db->where('t.status', $filter[5]['search']['value'], NULL, FALSE);
	
		if(!empty($limit) && !is_null($offset))
			$this->db->limit($limit, $offset);
        
		$this->db->order_by('t.created_at', 'desc');
		$this->db->join('members m', 'm.id = t.member_id');
        $q = $this->db->get();
        return $q->result_array();
    }

	public function count_all(?array $filter = NULL){
        $query = $this->db->get('members');
        return $query->num_rows();
    }

}
