<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LanguageManager_model extends CI_Model {

    protected static $language = 'french';
    
    protected static $session_key = 'model.language';
    
    function LanguageManager_model(){
        parent::__construct();
         if ($this->session->userdata(self::$session_key))
            self::$language = $this->session->userdata(self::$session_key);
    }
    
    function getLanguage(){
        log_message('debug', 'get language : '.self::$language);
        return self::$language;
    }
    
    function setLanguage($language){
        self::$language = $language;
        $this->session->set_userdata(self::$session_key, self::$language);
        log_message('debug', 'change language : '.self::$language);
    }
    
    function getAvailableLanguages(){
        $ret = array();
        
        $languageDirectory = opendir("application/language");
        while($entryName = readdir($languageDirectory)) {
            if($entryName != '.' && $entryName != '..')
                $ret[] = $entryName;
        }
        return $ret;
    }
}
?>
