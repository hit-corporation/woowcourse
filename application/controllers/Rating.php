<?php

class Rating extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model(['course_model', 'rating_model']);
    }


    public function get_all(): void {
        $data = $this->course_model->get_all_ratings();
        
        header('Content-Type: application/json');
        echo json_encode(['data' => $data], JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
    }

    /**
     * Store Rating and comment in database
     *
     * @return void
     */
    public function store(): void {

        if(!isset($_SESSION['user']))
        {
            http_response_code(403);
            die('NON AUTHORIZED ACTION');
        }
        
        $id = trim($this->input->post('det_id', TRUE));
        $rate = trim($this->input->post('rating'));
        $text = trim($this->input->post('text-review', TRUE));

        try 
        {
            header('Content-Type: application/json');

            if(empty($id) || empty($rate) || empty($text))
            {
                http_response_code(422);
                $resp = ['success' => false, 'message' => 'Data mandatori harus terisi !!!' ];
                echo json_encode($resp, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
                return;
            }

            $member = $this->db->get_where('members', ['email' => $_SESSION['user']['email']])->row_array() ?? [];

			// update course rating
				$rating = $this->db->select_avg('rate')->where('course_id', $id)->get('ratings')->row_array()['rate'];
				$rating = round($rating,2);
				
				$update = $this->db->where('id', $id)->update('courses', ['rating' => $rating]);


            $data = [
                'rate'       => $rate,
                'comments'   => $text,
                'course_id'  => $id,
                'member_id'  => $member['id'],
            ];

            if(!$this->db->insert('ratings', $data))
            {
                http_response_code(422);
                $resp = ['success' => false, 'message' => 'Data gagal di input !!!' ];
                echo json_encode($resp, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
                return;
            }

            // $this->db->insert('ratings', $data);
			$data['member_name'] = $member['first_name'].' '.$member['last_name'];
            http_response_code(200);
            $ratings = ['success' => true, 'message' => 'Komentar anda berhasil di masukkan', 'data' => $data];
            echo json_encode($ratings, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
        }
        catch(Exception $e)
        {
            log_message("error", $e->getMessage());
        }
    }

	public function get_data(){
		$get = $this->input->get();
		$ratings = $this->rating_model->get_data($get['course_id']);
		
		http_response_code(200);
		$ratings = ['success' => true, 'data' => $ratings];
		echo json_encode($ratings, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
	}

}
