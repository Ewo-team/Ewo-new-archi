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
        $this->load->model('LanguageManager_model', 'languageManager');

        $this->lang->load('interface', $this->languageManager->getLanguage());
        $this->lang->load('errors', $this->languageManager->getLanguage());
        //config
        $this->layout->addCss('bootstrap.min');
        $this->layout->addJs('bootstrap.min');
    }
    
    /**
     * Fonction interne à codeigniter. Ici elle permet de gèrer les les appels ajax quand c'est utile.
     * @param type $method
     * @param type $params
     */
    public function _remap($method, $params = array()){
        if($this->ajax)
            echo call_user_func_array(array($this, $method.'_intern'), $params);
        else
            call_user_func_array(array($this, $method), $params);
    }
    
    
    /**
     * Affichage d'une page type avec au centre le contenu de la variable $content
     * @param type $content 
     */
    protected function display($content){
        /*$data = $this->appliModel->get_info();
        
        $views = array();
        $views['toolBox'] = $this->toolBoxLog();
        $views['body'] = $content;
        $data['views'] = (object)$views;
        $data['log'] = true;
        $data['utilisateur_id'] = $this->session->userdata('utilisateur.id');
        $this->load->view('main_view',$data);*/
        $this->layout->display($content);
    }
    
    /**
     * Gènére la boite en haut en fonction du log ou non
     * @return type 
     */
    protected function toolBoxLog(){
        //Si connecté
        if($this->session->isLogged())
            return  $this->load->view('toolBox/connected_view',array(), true);
        //Sinon
        $this->load->model('forms/LogModel', 'logModel');
        return $this->load->view('toolBox/non_connected_view',$this->logModel->get_info(), true);
    }
}

?>