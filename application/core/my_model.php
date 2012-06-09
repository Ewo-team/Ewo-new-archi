<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Custom model with auto bdd synchro
 * 
 * @author benjamin herbomez <benjamin.herbomez@gmail.com>
 * @example :   extends this class and redefine config function : 
 *   protected function config() {
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
    protected $fields       = null;
    protected $changed      = false;
    
    public function __construct(){
        parent::__construct();
        $this->config();
    }
    
    function __destruct() {
        if($this->changed){
            log_message('info', 'object changed, save it');
            $this->save();
        }
    }
    
    /**
     * Redefine this function if you want to link database fields
     */
    protected function config(){
        
    }
    
    public function init($fields){
        
    }
    
    public function __get($name){
        $methodName = 'get'.ucfirst($name);
        //check if custom method exists
        if(method_exists($this, $methodName)){
            return $this->$methodName();
        }
        //check if bdd field mapped
        if(isset($this->tblFields[$name]) &&
                ($this->tblFields[$name] == self::LOAD_READ || $this->tblFields[$name] == self::LOAD_WREAD)){
            if($this->fields == null)
                $this->load();
            return $this->fields[$name];
        }
       
        log_message('debug', 'getter access error. Try to access to attribute `'.$name.'` in class `'.get_class($this).'`
            Trace:
                '.trace_to_string(debug_backtrace(),true));
        //TODO : raise exception
        return null;
    }
    
    public function __set($name, $value){
        $methodName = 'set'+ucfirst($name);
        //check if custom method exists
        if(method_exists($this, $methodName)){
            return $this->$methodName($value);
        }
        //check if bdd field mapped
        if(isset($this->tblFields[$name]) &&
                ($this->tblFields[$name] == self::LOAD_WRITE || $this->tblFields[$name] == self::LOAD_WREAD)){
            if($this->fields == null)
                $this->load();
            
            $this->fields[$name]    = $value;
            $this->changed          = true;
        }
        log_message('debug', 'setter access error. Try to access to attribute `'.$name.'` in class `'.get_class($this).'`
            Trace:
                '.trace_to_string(debug_backtrace(),true));
        //TODO : raise exception
        return null;
    }
    
    protected function load(){
        
    }
    
    protected function save(){
        
    }
}
?>
