<?php
 if ( ! defined('BASEPATH'))
     exit('No direct script access allowed');

class Database extends Nav_controller{
    
    public function __construct(){
        parent::__construct();    
        $this->load->library('form_validation');
    }
    
    /**
     * Check si les paramètres de connection donnés sont correctes
     */
    public function set_database_connection(){
        
        $this->form_validation->set_rules('host',   '',   'required');
        $this->form_validation->set_rules('user',   '',   'required');
        $this->form_validation->set_rules('pswd',   '',   '');
        $this->form_validation->set_rules('base',   '',   'required');
        
        if (!$this->form_validation->run()){
            die('{"error":"missing"}');
        }
        
        $db_config['hostname'] = $this->input->post('host');
        $db_config['username'] = $this->input->post('user');
        $db_config['password'] = $this->input->post('pswd');
        $db_config['database'] = $this->input->post('base');
        $db_config['dbdriver'] = "mysql";
        $db_config['dbprefix'] = "";
        $db_config['pconnect'] = FALSE;
        $db_config['db_debug'] = TRUE;
        $db_config['cache_on'] = FALSE;
        $db_config['autoinit'] = TRUE;
        $db_config['cachedir'] = "";
        $db_config['char_set'] = "utf8";
        $db_config['dbcollat'] = "utf8_general_ci";
        
        
        $database = $this->load->database($db_config, TRUE);
        
        $this->load->model('install/database_model', 'database');
        $this->database->setConfig(
                $this->input->post('host'), $this->input->post('user'),
                $this->input->post('pswd'), $this->input->post('base'));
        
        die('{}');
    }

    public function get_tables(){
        $this->load->model('install/database_model', 'database');
        $jsonReturn = $this->database->get_table_list();
        if($jsonReturn){
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($jsonReturn));
        }
        else
        $this->output
            ->set_content_type('application/json')
            ->set_output('{"error":"missing","message":"'.  Database_model::INSTALL_JSON.' is missing"}');
    }
    
    /**
     * 
     */
    public function create_table(){
        $this->form_validation->set_rules('table',   '',   'required');
        
        if (!$this->form_validation->run()){
            die('{"error":"missing"}');
        }
        $table_name = $this->input->post('table');
        
        $this->load->model('install/database_model', 'database');
        $this->database->create_table($table_name);
    }
    
}