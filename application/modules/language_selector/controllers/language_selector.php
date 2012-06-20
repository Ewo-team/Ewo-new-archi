<?php

class Language_selector extends MX_Controller{
    
    function __construct(){
        parent::__construct();
    }
    
    public function display($data){
        
        $data   = self::_set_default($data, 'id'     , uniqid());
        $data   = self::_set_default($data, 'name'   , '');
        
        $data['list']       = $data['model']->getAvailableLanguages();
        $data['selected']   = $data['model']->getLanguage();
        unset($data['model']);
        
        return $this->load->view('view', $data);
    }
    
    static protected function _set_default($data, $entry, $default){
        if(!array_key_exists($entry, $data))
            $data[$entry]     = uniqid();
        return $data;
    }
}
