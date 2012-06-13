<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Benjamin Herbomez <benjamin.herbomez@esial.com>
 */
class Index extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->output->enable_profiler(true);
        $this->log_lvl = MY_Controller::LOG_LVL_OSEF;
        $this->load->helper(array('form'));
        
        
        $this->load->model('user_model', 'user', TRUE);
        $this->load->model('users_model', 'users', TRUE);
        $this->load->model('news_model', 'news');
        
        $this->loadLang('interface');
        $this->loadLang('errors');
    }
    
    public function index(){
        $this->display($this->load->view('index',null, true));
        
        //var_dump($this->news->getNews());
        echo '<pre>';
        var_dump($this->users->findAllByName('Kamule'));
        echo '</pre>';
    }
}

?>
