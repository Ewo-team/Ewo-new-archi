<?php

class SynchronizationException extends Exception{
    static $msg = null;
    
    function __construct(){
        if(Synchronization_error::$msg == null)
            $this->loadErrorMsg();
        parent::__construct(Synchronization_error::$msg);
    }
    
    private function loadErrorMsg(){
        $CI =& get_instance();
        $CI->load->model('LanguageManager_model', 'languageManager');
        var_dump($this);
        $CI->lang->load($file, $this->languageManager->getLanguage());
    }
}

/**
 * End of file
 */