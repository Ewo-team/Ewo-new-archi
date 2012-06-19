<?php
class Progress extends MX_Controller {
    function __construct(){
        parent::__construct();
    }
    
    function index($steps, $step){
        $data['step']   = $step;
        $data['steps']  = $steps;
        return $this->load->view('progress_div', $data);
    }
}