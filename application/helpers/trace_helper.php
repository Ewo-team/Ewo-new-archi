<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('trace_to_string')) {

    function trace_to_string($trace) {
        $ret = '';
        foreach($trace as $line){
            $ret .= '`'.$line['file'].'` function : `'.$line['function'].'` line : `'.$line['line'].'`
                ';
        }
        return $ret;
    }

}
?>
