<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('css_url'))
{
	function css_url($nom, $base_path = 'assets/')
	{
		return base_url() . $base_path . 'css/' . $nom . '.css';
	}
}

if ( ! function_exists('js_url'))
{
	function js_url($nom, $base_path = 'assets/')
	{
		return base_url() . $base_path .'js/' . $nom . '.js';
	}
}

if ( ! function_exists('img_url'))
{
	function img_url($nom, $base_path = 'assets/')
	{
		return base_url() . $base_path . 'images/' . $nom;
	}
}

if ( ! function_exists('img'))
{
	function img($nom, $alt = '', $base_path = 'assets/')
	{
		return '<img src="' . img_url($nom, $base_path) . '" alt="' . $alt . '" />';
	}
}

/**
 * End of file
 */