<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Benjamin Herbomez <benjamin.herbomez@esial.com>
 */
class Index extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //$this->output->enable_profiler(true);
        $this->log_lvl = MY_Controller::LOG_LVL_OSEF;
        $this->load->helper(array('form'));
        
        $this->load->library('model_factory');
        
        $this->loadLang('interface');
        $this->loadLang('errors');
    }
    
    public function index(){
        $this->display($this->load->view('index',null, true));
        
        //var_dump($this->news->getNews());
        
        $user   = $this->model_factory->load('user_model',array('id' => 1));
        $user2  = $this->model_factory->load('user_model',array('id' => 2));
        //$user->synchronize();
        //$user2->synchronize();
       
        echo $user->name, ' / ', $user2->name,'<br />';
        echo 'dummy : ',$user->dummy,'<br />';
        $user->dummy='test';
        echo 'dummy : ',$user->dummy;
        
    }
}

/**
 * End of file
 */