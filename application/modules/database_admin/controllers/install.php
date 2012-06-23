<?php

/**
 * Install database
 */
class Install extends CI_Controller{
   
    
    function __construct(){
        parent::__construct();
    }
    
    function index($database){
        $data = array(
            'database'  => $database->get_table_list(),
            'type'      => 'install'
        );
        return $this->load->view('view', $data);
    }
}