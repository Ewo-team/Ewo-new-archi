<?php
/**
 * Affiche un input avec une liste d'auto comple
 */
class Selector extends MX_Controller{
    
    function __construct(){
        parent::__construct();
    }
    
    /**
     * Affiche le composant
     * @param type $data array comprenant :
     *          * list : list des valeures
     *          * selected : valeur selectionnée
     *          * id : id html
     *          * name : name html
     * @return html 
     */
    public function display($data){
        
        $data   = self::_set_default($data, 'id'     , uniqid());
        $data   = self::_set_default($data, 'name'   , '');
        
        return $this->load->view('view', $data);
    }
    
    static protected function _set_default($data, $entry, $default){
        if(!array_key_exists($entry, $data))
            $data[$entry]     = uniqid();
        return $data;
    }
}
