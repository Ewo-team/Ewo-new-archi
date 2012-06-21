<?php


class Database extends MY_Controller{
    
    
    public function check_database_connection(){
        $this->load->library('form_validation');
        
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
        
        die('{"return", "ok"}');
    }
}