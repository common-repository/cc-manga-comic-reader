<?php
/**
 * Created by PhpStorm.
 * User: TRUNG
 * Date: 10/27/2017
 * Time: 9:12 PM
 */

if (!defined('ABSPATH')) {
	return;
}

if (!function_exists('cc_manga_action_enqueue_scripts')) {
	function cc_manga_action_enqueue_scripts() {
		//boostrap
		wp_enqueue_style('bootstrap',CC_MANGA_COMIC_HELPER_URL . 'assets/css/bootstrap.min.css', array(), '4.0.0');
		wp_enqueue_script('bootstrap',CC_MANGA_COMIC_HELPER_URL . 'assets/js/bootstrap.min.js', array('jquery'), '4.0.0', true);

		wp_enqueue_style('cc-manga', CC_MANGA_COMIC_HELPER_URL . 'assets/css/cc-manga.css', array(), '1.0.0');
	}

	if (!is_admin()) {
		add_action('wp_enqueue_scripts', 'cc_manga_action_enqueue_scripts');
	}
}