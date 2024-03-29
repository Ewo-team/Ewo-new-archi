<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Benjamin Herbomez <benjamin.herbomez@gmail.com>
 */
class Index extends Nav_controller {

    public function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(true);
        $this->log_lvl = Nav_controller::LOG_LVL_OSEF;
        $this->load->helper(array('form'));
        
        $this->_loadLang('interface');
        $this->_loadLang('errors');
        
    }
    
    public function index(){
        $this->_display($this->load->view('index',null, true));
    }
}

/**
 * End of file
 */