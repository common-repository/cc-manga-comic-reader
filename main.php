<?php
/*
Plugin Name: 		CC Manga Comic Reader
Plugin URI: 		http://chuyencode.com/cc-manga
Description: 		Plugin for build manga, comic site
Version: 			1.0.0
Author: 			cuongma111
Author URI: 		http://chuyencode.com
*/

if (!defined('ABSPATH')) {
	return;
}

// define constant.
define('CC_MANGA_COMIC_HELPER_PATH', plugin_dir_path(__FILE__));
define('CC_MANGA_COMIC_HELPER_URL', plugin_dir_url(__FILE__));

//load library
require_once CC_MANGA_COMIC_HELPER_PATH . '/lib/codestar-framework/cs-framework.php';
require_once CC_MANGA_COMIC_HELPER_PATH . '/helpers/framework.php';
require_once CC_MANGA_COMIC_HELPER_PATH . '/lib/template/class-gamajo-template-loader.php';

//register post type
require_once CC_MANGA_COMIC_HELPER_PATH . '/helpers/manga.php';

//load helper
require_once CC_MANGA_COMIC_HELPER_PATH . '/helpers/helper.php';
require_once CC_MANGA_COMIC_HELPER_PATH . '/helpers/filter.php';
require_once CC_MANGA_COMIC_HELPER_PATH . '/helpers/hook.php';

//load template
require_once CC_MANGA_COMIC_HELPER_PATH . '/helpers/template.php';

//load assets
require_once CC_MANGA_COMIC_HELPER_PATH . '/helpers/assets.php';