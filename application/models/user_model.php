<?php

class User_model extends MY_Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    protected function config(){
        $this->tblName = 'users';
        $this->tblFields = array(
            'id'        => self::LOAD_READ,
            'name'      => self::LOAD_WREAD,
            'password'  => self::LOAD_WREAD,
            'mail'      => self::LOAD_WREAD);
    }
    
}
?>
