<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    protected $data;
    protected $settings;

    public function __construct()
    {
        parent::__construct();

        // if (!isset($_SESSION['user']))
        //     redirect(base_url('login'));

        $this->template->registerFunction('base_url', function () {
            return base_url();
        });
        $this->template->registerFunction('html_escape', function ($args) {
            return html_escape($args);
        });

        // $this->settings = $this->db->get_where('settings', ['id' => 1])->row_array();
        // buat template
        $this->template->instance()->addData(['categories' => $this->setCategories()]);
        $this->template->instance()->addData(['uri1' => $this->uri->segment(1)]);
    }


    private function setCategories() {
        $a = $this->db->where('parent_category', 0)->get('categories')->row_array() ?? [''];
		$b = $this->db->where('parent_category', $a['id'])->get('categories')->result_array();

		$i = 0;
		foreach ($b as $key => $val) {
			$c = $this->db->where('parent_category', $val['id'])->get('categories')->result_array();
			$b[$i]['child'] = $c;
			$i++;
		}

        return $b ?? [];
    }
}
