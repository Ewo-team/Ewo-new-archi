<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Custom model with auto bdd synchro
 * 
 * @author benjamin herbomez <benjamin.herbomez@gmail.com>
 * @example :   extends this class and in your constructor use : 
 *   public function __construct() {
 *       parent::__construct();
 *       $this->tblName = 'users';
 *       $this->tblFields = array(
 *           'id'        => LOAD_READ,
 *           'name'      => LOAD_WREAD,
 *           'password'  => LOAD_WREAD,
 *           'mail'      => LOAD_WREAD);
 *   }
 */
class MY_Model extends CI_Model{
    
    /**
     * database field access :
     */
    const LOAD_READ     = 0;    /* read only        */
    const LOAD_WRITE    = 1;    /* write only       */
    const LOAD_WREAD    = 2;    /* read and write   */
    
    protected $tblName      = 'dummy';
    protected $tblFields    = array();
    protected $fields       = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    function __destruct() {
    }
    
    public function __get($name){
        
    }
    
    public function __set($name, $value){
        
    }
    
}
?>
