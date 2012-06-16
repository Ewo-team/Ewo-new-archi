<?php

 if ( ! defined('BASEPATH'))
     exit('No direct script access allowed');
/**
 * Entry point for installation
 *  * @author Benjamin Herbomez <benjamin.herbomez@gmail.com>
 */
class Index extends MY_Controller{
    
    /**
     * déf des états
     */
    const STEP_ANALYZE  = 0;
    const STEP_DB       = 1;
    const STEP_RIGHTS   = 2;
    public static $steps       = array(
        self::STEP_ANALYZE    => 'analyze',
        self::STEP_DB         => 'database',
        self::STEP_RIGHTS     => 'rights'
    );
    
    public function __construct() {
        parent::__construct();
        
        $this->log_lvl = MY_Controller::LOG_LVL_OSEF;
        $this->load->helper(array('form'));

        $this->_loadLang('interface');
        $this->_loadLang('errors');
        $this->_loadLang('install');
        
        
        $this->layout->seTitle(lang('install.title'));
    }
    
    public function index(){
        $this->analyze();
    }
    
    public function analyze(){
        $this->_render(self::STEP_ANALYZE);
    }
    
    public function database(){
        $this->_render(self::STEP_DB);
    }
    
    protected function _render($step){
        $pageData = array(
            'progress'      => 100 * ($step / count(self::$steps)),
            'step'          => $step,
            'current_page'  => $this->load->view('install/'.self::$steps[$step],null, true)
        );
        $this->_display($this->load->view('install/index',$pageData, true));
    }
}


/**
 * End of file
 */