<?php

class User_model extends MY_Model{
    
    public function __construct() {
        parent::__construct();
        $this->tblName = 'users';
        $this->tblFields = array(
            'id'        => LOAD_READ,
            'name'      => LOAD_WREAD,
            'password'  => LOAD_WREAD,
            'mail'      => LOAD_WREAD);
    }
}
?>
