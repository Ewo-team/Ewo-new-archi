<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Benjamin Herbomez <benjamin.herbomez@esial.com>
 */
class Index extends MY_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->log_lvl = MY_Controller::LOG_LVL_OSEF;
        $this->load->helper(array('form'));
    }
    
    public function index(){
        
        $this->display($this->load->view('index',null, true));
    }
}

?>
