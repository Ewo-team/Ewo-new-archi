<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Custom model with auto bdd synchro
 * 
 *
 *  * If your model is as a cardinality of 1, extends this class and redefine config function (see example)
 *  * Or juste define the attribute $tblName (as a string), declare your mapping with config function
 *    and declare attribute $bd_multiple = true;
 *    Now you can call functions findAll and findAllBy{x} where {x} is the property you want to use to
 *    filter results.
 *    You can define $resultType attribute. With this options you can se the class type of each entries 
 *
 * @author benjamin herbomez <benjamin.herbomez@gmail.com>
 * @example :
 *      protected function config() {
 *          $this->tblName = array('users u');
 *          $this->tblFields = array(
 *              'u.id'        => LOAD_READ,
 *              'u.name'      => LOAD_WREAD,
 *              'u.password'  => LOAD_WREAD,
 *              'u.mail'      => LOAD_WREAD,
 *              'objects'     => array(
 *                  'access'        => LOAD_READ,
 *                  'resultType'    => 'SomeSubClass'
 *                  'tblName'       => array(),
 *                  'tblFields'     => array() 
 *              ));
 *      }
 */
class MY_model extends CI_Model{
    
    /**
     * database field access :
     */
    const LOAD_READ     = 0;    /* read only        */
    const LOAD_WRITE    = 1;    /* write only       */
    const LOAD_WREAD    = 2;    /* read and write   */
    
    protected $tblName      = null;     /* name of the table                */
    protected $tblFields    = null;     /* fields to extract from the bdd   */
    protected $tblKey       = null;     /* unique key                       */
    private   $fields       = null;     /* current values, internal use     */
    protected $changed      = array();  /* Use know changed values          */
    
    public function __construct(){
        parent::__construct();
        $this->config();
        //Handle dynamic model creation
        if(func_num_args() == 3){
            $this->tblName      = func_get_arg(0);
            $this->tblFields    = func_get_arg(1);
            $this->init(func_get_arg(2));
        }
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
        foreach ($fields as $field => $value){
            $this->fields[$field] = $value;
        }
        $this->load();
    }
    
    /**
     * This function will synchronize your model with database
     * If your model is out of date, an exception will be raised
     */
    public function synchronize(){
        $newValues  = $this->load(true);
        $errorFields = array();
        foreach ($newValues as $key => $value){
            // if no comflict and updatable value
            if (!array_key_exists($key, $this->fields) ||
                    array_key_exists($key, $this->changed) && !$this->changed[$key]){
                $this->fields[$key] = $value;
             }
            else if ($value != $this->fields[$key])
                $errorFields[] = $key;
        }
        if(count($errorFields)){
            throw new SynchronizationException();
        }
    }
    
    public function __get($name){
        
        //Check lib call
        $CI =& get_instance();
        //If method already exists
        if (property_exists($CI, $name)){
            return $CI->$name;
        }

        $methodName = 'get'.ucfirst($name);
        //check if custom method exists
        if (method_exists($this, $methodName)){
            return $this->$methodName();
        }
        //check if bdd field mapped
        if (isset($this->tblFields[$name]) &&
                ($this->tblFields[$name] == self::LOAD_READ || $this->tblFields[$name] == self::LOAD_WREAD)){
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
        if (method_exists($this, $methodName)){
            return $this->$methodName($value);
        }
        //check if bdd field mapped
        if (isset($this->tblFields[$name]) &&
                ($this->tblFields[$name] == self::LOAD_WRITE || $this->tblFields[$name] == self::LOAD_WREAD)){
            if($this->fields == null)
                $this->load();
            
            $this->fields[$name]    = $value;
            $this->changed[$name]   = true;
        }
        log_message('debug', 'setter access error. Try to access to attribute `'.$name.'` in class `'.get_class($this).'`
            Trace:
                '.trace_to_string(debug_backtrace(),true));
        //TODO : raise exception
        return null;
    }
    
    /**
     * Magic method, handle call to findAll(By{x})
     * 
     * @param type $name
     * @param type $args
     * @return type 
     */
    function __call($name, $args){
        if(!is_string($this->tblName) || !isset($this->bd_multiple) || $this->bd_multiple == false) //don't want complexe db access
            return null;
        
        $argc = count($args);
        
        if ($name == 'findAll'){
            if ($argc == 1) //where exists
                return $this->_findAll(null, $args[0]);
            return $this->_findAll(null, null);
        }
        else if (substr($name,0,9) == 'findAllBy'){
            $field = substr($name, 9);
            $field[0] = strtolower($field[0]);//reduce first letter
            if ($argc == 2) //fields list exists
                return $this->_findAll(array($field => $args[0]), $args[1]);
            if ($argc == 1)
                return $this->_findAll(array($field => $args[0]), null);
            return null;
        }
    }
    
    private function _findAll($where, $fields){
        if (isset($where) && is_array($where)){
            $rq = $this->db;
            if(isset($fields) && is_array($fields)){
                $rq     = $rq->select(implode(',', $fields));
            }
            $result = $rq->from($this->tblName)->where($where)->get()->result();
            
            $ret = array();
            foreach($result as $key => $entry){
                $ret[$key] = $this->bdResult2Model($entry);
            }
            return $ret;
        }
        else{
            $ret = array();
            foreach($this->db->get($this->tblName)->result() as $key => $entry){
                $ret[$key] = $this->bdResult2Model($entry);
            }
            return $ret;
        }
    }
    
    private function bdResult2Model($dbResult){
        $fields     = get_object_vars($dbResult);
        $initValues = array();
        
        foreach ($fields as $field => $value){
            if ($this->tblFields == null || array_key_exists($field, $this->tblFields)){
                $fields[$field]        = $this->tblFields[$field];
                $initValues[$field]    = $value;
            }
            else{
                unset($fields[$field]);
            }
        }
        $ret = new MY_Model($this->tblName, $fields, $initValues);
        return $ret;
    }
    
    protected function load(){
        $newValues = $this->loadToObject();
        if (func_num_args() == 1 && is_bool(func_get_arg(0)) && func_get_arg(0) == true){//need return
            return $newValues;
        }
        
        foreach ($newValues as $key => $value){
            $this->fields[$key] = $value;
        }
    }
    
    /**
     * load data from database en return array
     * @return type 
     */
    private function loadToObject(){
        $dbObj = $this->db->from($this->tblName);
        foreach ($this->tblKey as $value)
            $dbObj = $dbObj->where($value, $this->fields[$value]);
        
        $ret = $dbObj->limit(1)->get()->result();
        return $ret[0];
    }
    
    /**
     * Save data into db
     * @return type 
     */
    protected function save(){
        //check if there is modif
        if (count($this->changed) == 0)
            return;
        
        $dbObj = $this->db;
        //set where
        foreach ($this->tblKey as $value)
            $dbObj = $dbObj->where($value, $this->fields[$value]);
        $newValues = array();
        foreach ($this->changed as $fieldName => $fieldChanged){
            if($fieldChanged)
                $newValues[$fieldName] = $this->fields[$fieldName];
        }
        $dbObj->update($this->tblName, $newValues);
    }
}

/**
 * End of file
 */