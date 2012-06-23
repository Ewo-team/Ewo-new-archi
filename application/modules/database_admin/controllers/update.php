<?php

/**
 * Update current database
 */
class Update extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    
    function index($steps, $step){
        $data['step']   = $step;
        $data['steps']  = $steps;
        return $this->load->view('progress_div', $data);
    }
}