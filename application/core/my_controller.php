<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Class de controller customisée
 */
class MY_Controller extends CI_Controller {
    const LOG_LVL_OSEF      = 0;
    const LOG_LVL_NONE      = 1;
    const LOG_LVL_REQUIRE   = 2;

    protected $log_lvl  = self::LOG_LVL_OSEF;
    protected $ajax     = false;
    protected $theme    = 'myApp';
    protected $langue   = null;
    
    function __construct(){
        parent::__construct();
         //detect ajax
        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
            $this->ajax = true;
        if($this->agent->is_mobile()){
            $this->theme    = 'mobileMyApp';
        }
        $this->load->library('layout', array('theme' => $this->theme));
        $this->load->helper('model_factory');
        $this->load->model('LanguageManager_model', 'languageManager');

        //config
        $this->layout->addCss('bootstrap.min');
        $this->layout->addJs('bootstrap.min');
        
        
        log_message('debug', "MY_Controller Class Initialized");
        
    }
    
    protected function _loadLang($file){
        $this->lang->load($file, $this->languageManager->getLanguage());
    }
    
    /**
     * Fonction interne à codeigniter. Ici elle permet de gèrer les les appels ajax quand c'est utile.
     * @param type $method
     * @param type $params
     */
    public function _remap($method, $params = array()){
        call_user_func_array(array($this, $method), $params);
    }
    
    
    /**
     * Affichage d'une page type avec au centre le contenu de la variable $content
     * @param type $content 
     */
    protected function _display($content){
        if($this->ajax)
            $this->layout->display($content, 'ajax');
        else
            
            $this->layout->display($content);
    }
    
}

/**
 * End of file
 */