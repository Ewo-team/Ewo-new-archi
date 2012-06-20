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
    const STEP_INIT     = 0;
    const STEP_ANALYZE  = 1;
    const STEP_DB       = 2;
    const STEP_RIGHTS   = 3;
    public static $steps       = array(
        self::STEP_INIT       => 'init',
        self::STEP_ANALYZE    => 'analyze',
        self::STEP_DB         => 'database',
        self::STEP_RIGHTS     => 'rights'
    );
    
    public function __construct() {
        parent::__construct();
        
        $this->log_lvl = MY_Controller::LOG_LVL_OSEF;
        $this->load->helper(array('form'));

        $this->load->module('progress');
        $this->load->module('language_selector');
        
        $this->_loadLang('interface');
        $this->_loadLang('errors');
        $this->_loadLang('install');
        
        
        $this->layout->seTitle(lang('install.title'));
        
    }
    
    public function index(){
        $this->init();
    }
    
    public function init(){
        $this->_render(self::STEP_INIT);
    }
    
    public function analyze($lang = null){
        if($lang != null)
            $this->language_manager->setLanguage($lang);
        $this->_render(self::STEP_ANALYZE, array('nbStep' => 6));
    }
    
    public function database(){
        $this->_render(self::STEP_DB);
    }
    
    protected function _render($step, $dataContent = array()){
        parent::_render();
        $dataContent['steps'] = self::$steps;
        $progress = 100 * ($step / count(self::$steps));
        $content  = $this->load->view('install/'.self::$steps[$step],$dataContent, true);
        
        $entry_point = $this->_is_entry_point('admin');
        
        $pageData = array(
            'progress'      => $progress,
            'step'          => $step,
            'content'       => $content
        );
        if($this->ajax && !$entry_point){
            $this->_display($pageData, 'admin');
        }
        else{
            $this->_display($this->load->view('install/index',$pageData, true), 'admin');
        }
    }

}


/**
 * End of file
 */