<?php
/**
 * Created by PhpStorm.
 * User: TRUNG
 * Date: 10/27/2017
 * Time: 9:50 PM
 */

if (!defined('ABSPATH')) {
	return;
}

// define template
class CC_Manga_Template extends Gamajo_Template_Loader {
	/**
	 * Prefix for filter names.
	 *
	 * @since 1.0.0
	 * @type string
	 */
	protected $filter_prefix = 'cc-manga';

	/**
	 * Directory name where custom templates for this plugin should be found in the theme.
	 *
	 * @since 1.0.0
	 * @type string
	 */
	protected $theme_template_directory = 'cc-manga';

	/**
	 * Reference to the root directory path of this plugin.
	 *
	 * @since 1.0.0
	 * @type string
	 */
	protected $plugin_directory = CC_MANGA_COMIC_HELPER_PATH;
}

// set template for post type
if (!function_exists('cc_manga_single_post_type_template')) {
	function cc_manga_single_post_type_template($template) {
		global $post;

		if ($post->post_type == 'cc-manga') {
			$tmpl		= new CC_Manga_Template();
			$template	= $tmpl->get_template_part('manga', null, false);
		}

		if ($post->post_type == 'cc-chapter') {
			$tmpl		= new CC_Manga_Template();
			$template	= $tmpl->get_template_part('chapter', null, false);
		}

		return $template;
	}

	add_filter('single_template', 'cc_manga_single_post_type_template');
}

// set template for taxonomy
if (!function_exists('cc_manga_single_taxonomy_template')) {
	function cc_manga_single_taxonomy_template($template) {
		$default			= cc_manga_default_manga_taxonomy();
		$custom_taxonomy 	= cs_get_option('custom_taxonomy', $default);
		$params				= array();

		if (!empty($custom_taxonomy)) {
			foreach ($custom_taxonomy as $taxonomy) {
				if (is_tax($taxonomy)) {
					$params['taxonomy'] = $taxonomy;

					$tmpl = new CC_Manga_Template();
					set_query_var('params', $params);
					$template = $tmpl->get_template_part('taxonomy', null, false);
				}
			}
		}

		return $template;
	}

	add_filter('template_include', 'cc_manga_single_taxonomy_template');
}