<?php
/**
 * Created by PhpStorm.
 * User: TRUNG
 * Date: 10/27/2017
 * Time: 11:15 PM
 */

if (!defined('ABSPATH')) {
	return;
}

/*
 * Get List Manga
 */
if (! function_exists('cc_manga_get_list_manga')) {
	function cc_manga_get_list_manga() {
		$manga_list = get_posts(array(
			'posts_per_page'	=> -1,
			'post_type'		=> 'cc-manga',
			'post_status'   => 'publish',
		));

		return $manga_list;
	}
}

/*
 * Get List Chapter
 */
if (! function_exists('cc_manga_get_list_chapter_all')) {
	function cc_manga_get_list_chapter_all() {
		$manga_list = get_posts(array(
			'posts_per_page'	=> -1,
			'post_type'		=> 'cc-chapter',
			'post_status'   => 'publish',
		));

		return $manga_list;
	}
}

/*
 * Default Option Manga
 */
if (!function_exists('cc_manga_default_manga_option')) {
	function cc_manga_default_manga_option() {
		$default_field = array(
			array(
				'name'		=> esc_html__('Other Name','cc-manga'),
				'slug'		=> 'other-name',
			),

			array(
				'name'		=> esc_html__('Status','cc-manga'),
				'slug'		=> 'status',
			),
		);

		return $default_field;
	}
}

/*
 * Default manga taxonomy
 */
if (!function_exists('cc_manga_default_manga_taxonomy')) {
	function cc_manga_default_manga_taxonomy() {
		$default = array(
			array(
				'title'		=> esc_html__('Category', 'cc-manga'),
				'name'		=> 'cc-category',
				'slug'		=> 'cc-category',
				'type'		=> 'category'
			),

			array(
				'title'		=> esc_html__('Tags','cc-manga'),
				'name'		=> 'cc-tag',
				'slug'		=> 'cc-tag',
				'type'		=> 'tag'
			),
		);

		return $default;
	}
}

/*
 * Get taxomony manga
 */
if (! function_exists('cc_manga_get_manga_taxomony')) {
	function cc_manga_get_manga_taxomony($manga_id, $type) {
		$taxomonys	= wp_get_post_terms($manga_id, $type);

		$html 		= '';
		$numItems 	= count($taxomonys);
		$i 			= 0;

		if (! empty($taxomonys)) {
			foreach ($taxomonys as $taxomony) {
				if (++$i === $numItems) {
					$space = '';
				} else {
					$space = ', ';
				}

				$html .= '<a href="' . get_term_link($taxomony->slug, $type) . '" class="manga-' . $taxomony->slug . '">';
				$html .= $taxomony->name;
				$html .= '</a>';
				$html .= $space;
			}
		}

		return $html;
	}
}