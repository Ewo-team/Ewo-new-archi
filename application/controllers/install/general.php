<?php

/**
 * Fait les checks de infos générales
 */
class General extends MY_Controller{
  
    const INDEX_FILE = 'index.php';
    
    public function set_env(){
        
        $this->_loadLang('interface');
        $this->_loadLang('errors');
        $this->_loadLang('install');
        parent::_loadLanguages();
        
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('env',   '',   'required');
        
        if (!$this->form_validation->run()){
            die('{"error":"missing"}');
        }
        $env = $this->input->post('env');
        if($env != 'development' && $env != 'testing' && $env != 'production'){
           show_error(lang('install.error.analyze.env_error'));
        }
        $this->_save_env($env);
        die('{}');
    }
    
    protected function _save_env($env){
        $fileArray = file(self::INDEX_FILE);
        $file = '';
        foreach ($fileArray as $line)
            $file .= $line;
        
        $regex = '#define\(\'ENVIRONMENT\', \'(.*)\'\)\;#i';
        $file = preg_replace($regex, 'define(\'ENVIRONMENT\', \''.$env.'\');', $file);
  
        //Write file
        $fp = fopen(self::INDEX_FILE, 'w');
        fwrite($fp, $file);
        fclose($fp);
    }
}