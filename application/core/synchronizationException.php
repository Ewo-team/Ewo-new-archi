<?php

class SynchronizationException extends Exception{
    static $msg = null;
    private $errorFields;
    
    function __construct($errorFields){
        //Load error message on the first call
        if(Synchronization_error::$msg == null)
            $this->loadErrorMsg();
        parent::__construct(Synchronization_error::$msg);
        $this->errorFields = $errorFields;
    }
    
    private function loadErrorMsg(){
        $CI =& get_instance();
        $CI->load->model('LanguageManager_model', 'languageManager');
        var_dump($this);
        $CI->lang->load($file, $this->languageManager->getLanguage());
    }
    
    /**
     * Return synchro error fields
     * 
     * @return array(field => array('old' => value, 'new' => value)) 
     */
    public function getErrorFields(){
        return $this->errorFields;
    }
}

/**
 * End of file
 */