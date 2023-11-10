<?php

class template {

     public $template; 
     private $ci;

    public function __construct() {
        $this->template = new League\Plates\Engine(VIEWPATH.'');
        $this->ci =& get_instance();

        $this->template->loadExtension(new League\Plates\Extension\URI(base_url()));

		
    }

    public function instance() {
        return $this->template;
    }

    public function registerFunction($folder, $cb) {
        if(!is_callable($cb)) {
            throw $cb.' is not callable';
        }
        
        return $this->template->registerFunction($folder, $cb);
    }

    public function render($template='', $data=[], $folder=NULL) {
		$f = empty($folder) ? $this->ci->router->class : $folder;
        $this->template->loadExtension(new \League\Plates\Extension\Asset(getcwd().'/', FALSE));
        $this->template->addFolder($f, VIEWPATH.$f, TRUE);
        $this->template->addFolder('layouts', VIEWPATH.'layouts', TRUE);
		
		$a = $this->ci->db->where('parent_category', 0)->get('categories')->row_array();
		$b = $this->ci->db->where('parent_category', $a['id'])->get('categories')->result_array();

		$i = 0;
		foreach ($b as $key => $val) {
			$c = $this->ci->db->where('parent_category', $val['id'])->get('categories')->result_array();
			$b[$i]['child'] = $c;
			$i++;
		}

		$this->template->addData(['categories' => $b]);
       
        return $this->template->render($f.'::'.$template, $data);
    }
}
