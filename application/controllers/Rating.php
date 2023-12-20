<?php

class Rating extends MY_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('course_model');
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

            $data = [
                'rate'      => $rate,
                'comments'  => $text,
                'topic_id'  => $id,
                'member_id' => $_SESSION['user']['id']
            ];

            if(!$this->db->insert('rating', $data))
            {
                http_response_code(422);
                $resp = ['success' => false, 'message' => 'Data mandatori harus terisi !!!' ];
                echo json_encode($resp, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
                return;
            }

            // $this->db->insert('ratings', $data);

            http_response_code(200);
            $ratings = ['success' => true, 'message' => 'Komentar anda berhasil di masukkan', 'data' => $data];
            echo json_encode($ratings, JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG);
        }
        catch(Exception $e)
        {
            log_message("error", $e->getMessage());
        }
    }

}