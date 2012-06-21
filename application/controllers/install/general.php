<?php

/**
 * Fait les checks de infos générales
 */
class General extends MY_Controller{
    
    
    public function check_language(){
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('lang',   '',   'required');
        
        if (!$this->form_validation->run()){
            die('{"error":"missing"}');
        }
        
        $language   = $this->input->post('lang');
        $languages  = $this->language_manager->getAvailableLanguages();
        if(!in_array($language, $languages)){
            die('{"error":"not exist", "message":"'.lang('install.error.analyze.lang_error').'"}');
        }
        die('{}');
    }
}