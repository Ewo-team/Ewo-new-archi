<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Users_model extends MY_model{
    
    protected $bd_multiple = true;
    
    
    protected function config(){
        $this->tblName = 'users';
        $this->tblFields = array(
            'id'        => self::LOAD_READ,
            'name'      => self::LOAD_WREAD,
            'password'  => self::LOAD_WREAD);
    }
    
}
?>
