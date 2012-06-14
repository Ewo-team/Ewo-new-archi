<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class User_model extends MY_Model{
    
   
    protected function config(){
        $this->tblName      = 'users';
        $this->tblFields    = array(
            'id'        => self::LOAD_READ,
            'name'      => self::LOAD_WREAD,
            'password'  => self::LOAD_WREAD,
            'mail'      => self::LOAD_WREAD,
            'dummy'  => self::LOAD_WREAD);
        $this->tblKey       = array('id');
    }
    
}

/**
 * End of file
 */