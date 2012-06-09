<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LanguageManager_model extends CI_Model {

    protected $language = 'french';
    
    function LanguageManager_model(){
        parent::__construct();
    }
    
    function getLanguage(){
        return $this->language;
    }
}
?>
