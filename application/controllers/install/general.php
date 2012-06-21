<?php

/**
 * Fait les checks de infos générales
 */
class General extends MY_Controller{
    
    
    public function check_language($language){
        $languages = $this->language_manager->getAvailableLanguages();
        if(in_array($language, $languages)){
            die('{"error":"not exist", "message":"'.lang('install.error.analyze.lang_error').'"}');
        }
        die('{}');
    }
}