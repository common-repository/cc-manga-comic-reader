<?php
/**
 * Created by PhpStorm.
 * User: TRUNG
 * Date: 10/27/2017
 * Time: 9:39 PM
 */

if (!defined('ABSPATH')) {
	return;
}

define('CS_ACTIVE_CUSTOMIZE', false);
define('CS_ACTIVE_SHORTCODE', false);

if (!function_exists('cc_manga_framework_override_patch')) {
	function cc_manga_framework_override_patch() {
		return 'cc-manga/inc';
	}

	add_filter('cs_framework_override', 'cc_manga_framework_override_patch');
}