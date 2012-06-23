<?php

/**
 * Fait les checks de infos générales
 */
class General extends MY_Controller{
   
    
    public function set_language(){
        
        $this->_loadLang('interface');
        $this->_loadLang('errors');
        $this->_loadLang('install');
        parent::_loadLanguages();
        
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('lang',   '',   'required');
        
        if (!$this->form_validation->run()){
            die('{"error":"missing"}');
        }
        
        $language   = $this->input->post('lang');
        $languages  = $this->language_manager->getAvailableLanguages();
        if(!in_array($language, $languages)){
           show_error(lang('install.error.analyze.lang_error'));
        }
        $this->language_manager->setLanguage($language);
        die('{}');
    }
}