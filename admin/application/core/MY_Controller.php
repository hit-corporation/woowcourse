<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    protected $data;
    protected $settings;

    public function __construct()
    {
        parent::__construct();

		$this->load->helper(['cek']);

        if (!isset($_SESSION['user']))
            redirect(base_url('login'));

        $this->template->registerFunction('base_url', function () {
            return base_url();
        });
        $this->template->registerFunction('html_escape', function ($args) {
            return html_escape($args);
        });

        // $this->settings = $this->db->get_where('settings', ['id' => 1])->row_array();
        // buat template
        // $this->template->instance()->addData(['settings' => $this->settings]);
    }
}
