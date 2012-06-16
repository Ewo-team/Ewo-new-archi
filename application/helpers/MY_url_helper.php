<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('anchor_intern')) {

    /**
     * Format l'url comme il faut
     * 
     * @param type $uri
     * @param type $title
     * @param type $target selector jQuery de la div à changer
     * @param type $attributes
     * @return type 
     */
    function anchor_intern($uri, $title = '',  $target = '#content', $attributes = '') {
        $title = (string) $title;

        if (!is_array($uri)) {
            $site_url = (!preg_match('!^\w+://! i', $uri)) ? site_url($uri) : $uri;
        }
        else {
            $site_url = site_url($uri);
        }

        if ($title == '') {
            $title = $site_url;
        }

        if ($attributes != '') {
            $attributes = _parse_attributes($attributes);
        }

        return
                '<a href="' . $site_url . '" onclick="anchor_intern(\'' . $site_url . '\', \'' . $target . '\');return false;" ' . $attributes . '>' . $title . '</a>';
    }

}

/**
 * End of file
 */