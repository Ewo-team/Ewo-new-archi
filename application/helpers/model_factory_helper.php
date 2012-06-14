<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
/**
 * custom model class loader 
 */
if(!function_exists('loadModel')){
    function loadModel($type, $params = null){
        $CI = &get_instance();
        $CI->load->model($type, 'ret');
        
        if(isset($params) && is_array($params) && method_exists($CI->ret, 'init'))
            $CI->ret->init($params);
        
        return clone $CI->ret;
    }
 }
