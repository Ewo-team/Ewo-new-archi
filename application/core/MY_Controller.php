<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Class de controller customisée
 */
class MY_Controller extends MX_Controller {
    const LOG_LVL_OSEF      = 0;
    const LOG_LVL_NONE      = 1;
    const LOG_LVL_REQUIRE   = 2;

    protected $log_lvl      = self::LOG_LVL_OSEF;
    protected $ajax         = FALSE;
    protected $theme        = 'myApp';
    protected $langue       = null;
    protected $lastRenderer = null;
    
    function __construct(){
        parent::__construct();
         //detect ajax
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            $this->ajax = TRUE;
        if ($this->agent->is_mobile()) {
            $this->theme    = 'mobileMyApp';
        }
        $this->load->library('layout', array('theme' => $this->theme));
        $this->load->helper('model_factory');
        $this->load->model('LanguageManager_model', 'languageManager');
        
        if ($this->session->userdata('controller.lastRenderer'))
            $this->lastRenderer = $this->session->userdata('controller.lastRenderer');
        
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
        $this->output->set_header("Pragma: no-cache");
        
        log_message('debug', "MY_Controller Class Initialized");
        
    }
    
    protected function _loadLang($file){
        $this->lang->load($file, $this->languageManager->getLanguage());
    }
    
    /**
     * Affichage d'une page type avec au centre le contenu de la variable $content
     * @param type $content 
     * @param type $renderer 
     */
    protected function _display($content, $renderer = 'default'){
        if ($this->ajax) {
            if ($this->lastRenderer != null && $renderer != $this->lastRenderer)
                $content['loadLibs'] = true;
            else
                $content['loadLibs'] = false;
            $this->layout->display($content, 'ajax');
        }
        else {
            $this->layout->display($content, $renderer);
        }
        $this->session->set_userdata('controller.lastRenderer', $renderer);
    }
    
    protected function  _is_entry_point($renderer){
        log_message('debug','entry point compare : '.$renderer.' and '.$this->lastRenderer);
        
        return $renderer != $this->lastRenderer;
    }
}

/**
 * End of file
 */