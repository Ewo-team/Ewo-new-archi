<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layout {

    private $CI;
    private $var = array();
    private $theme = 'myApp';
    private $renderers = array();

    public function __construct($params) {
        $this->CI = & get_instance();


        $this->var['output']    = '';
        $this->var['title']     = ucfirst($this->CI->router->fetch_method());
        $this->var['charset']   = $this->CI->config->item('charset');

        $this->var['css']       = array();
        $this->var['js']        = array();
        $this->var['onload']    = array();

        foreach ($params as $param => $value) {
            if ($param == 'theme')
                $this->seTheme($value);
        }
        $this->loadCoreFiles();
        
        log_message('debug', 'Layout init');
    }

    public function view($name, $data = array()) {
        $filename = 'themes/' . $this->theme . '/' . $name;
        if (file_exists($filename . '.php')) {
            $this->var['output'] .= $this->CI->load->view($filename, $data, true);
        }
        else {
            $this->var['output'] .= $this->CI->load->view($name, $data, true);
        }
        $this->CI->load->view('../themes/' . $this->theme . '/default.php', $this->var);
    }

    /**
     * Affiche une page avec le renderer voulu
     * 
     * @param type $content
     * @param type $rendererName 
     */
    public function display($content, $rendererName = 'default') {
        if(array_key_exists($rendererName, $this->renderers))
            $renderer = $this->renderers[$rendererName];
        else
            $renderer = $this->renderers['default'];
        
        if(property_exists($renderer, 'jsLoad')){
            foreach ($renderer->jsLoad as $js){
                $this->addJs($js);
            }
        }
        
        if(property_exists($renderer, 'cssLoad')){
            foreach ($renderer->cssLoad as $css){
                $this->addCss($css);
            }
        }
        
        $this->var['output'] .= $content;
        $this->CI->load->view('../themes/' . $this->theme . '/'.$renderer->name.'.php', $this->var);
        
        log_message('debug', 'Layout display');
    }

    public function seTitle($title) {
        if (is_string($title) AND !empty($title)) {
            $this->var['title'] = $title;
            return true;
        }
        return false;
    }

    public function seCharset($charset) {
        if (is_string($charset) AND !empty($charset)) {
            $this->var['charset'] = $charset;
            return true;
        }
        return false;
    }

    public function addCss($nom) {
        if (is_string($nom) AND !empty($nom) AND file_exists('./assets/css/' . $nom . '.css')) {
            $this->var['css'][] = css_url($nom);
            return true;
        }
        return false;
    }

    public function addJs($nom) {
        if (is_string($nom) AND !empty($nom) AND file_exists('./assets/js/' . $nom . '.js')) {
            $this->var['js'][] = js_url($nom);
            return true;
        }
        return false;
    }
    
    public function addOnLoad($script){
        if (is_string($script) AND !empty($script)) {
            $this->var['onload'][] = $script;
            return true;
        }
        return false;
    }

    public function seTheme($theme) {
        if (is_string($theme) AND !empty($theme) AND file_exists('./application/themes/' . $theme . '/')) {
            $this->theme = $theme;
            $config = './application/themes/' . $theme . '/' . $theme . '.json';
            if (!file_exists($config))
                die('No theme config file');
            $fileArray = file($config);
            $file = '';
            foreach ($fileArray as $line)
                $file .= $line;
            return $this->loadThemeConfig($file);
        }
        return false;
    }

    private function loadThemeConfig($file) {
        $config = json_decode($file);
        
        foreach ($config->renderers as $renderer) {
            if (is_string($renderer)) {
                $this->renderers[$renderer] = (object)array('name' => $renderer);
            }
            else if (is_object($renderer)){
                 $this->renderers[$renderer->name] = $renderer;
            }
        }
    }
    
    /**
     * Charges les fichiers css et js toujours utilisés
     */
    private function loadCoreFiles(){ 
        $this->addJs('jQuery/jquery');
        $this->addJs('jQuery/jquery.inherit');
        $this->addJs('nav');
        $this->addOnLoad('nav_init("'.base_url().'");');
    }

}

/**
 * End of file
 */