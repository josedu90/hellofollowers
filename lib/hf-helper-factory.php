<?php

if (!function_exists('hellofollowers_manager')) {
	function hellofollowers_manager() {
		return HelloFollowers::getInstance();
	}	
}

if (!function_exists('hellofollowers_options_value')) {
	function hellofollowers_options_value($param, $default = '') {
		return hellofollowers_manager()->options_value($param, $default);
	}
}

if (!function_exists('hellofollowers_options_bool_value')) {
	function hellofollowers_options_bool_value($param) {
		return hellofollowers_manager()->options_bool_value($param);
	}
}

if (!function_exists('hellofollowers_options')) {
	function hellofollowers_options() {
		return hellofollowers_manager()->options();
	}
}

if (!function_exists('hellofollowers_followers')) {
	function hellofollowers_followers(){
		return hellofollowers_manager()->followers();
	}
}