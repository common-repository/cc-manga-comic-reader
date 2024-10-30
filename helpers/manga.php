<?php
/**
 * Created by PhpStorm.
 * User: TRUNG
 * Date: 10/27/2017
 * Time: 9:20 PM
 */

if (!defined('ABSPATH')) {
	return;
}

// register manga post type.
if (!function_exists('cc_manga_create_post_type_manga')) {
	function cc_manga_create_post_type_manga() {
		$args	= array(
			'labels'				=> array(
				'name' 					=> esc_html__('Manga', 'cc-manga'),
				'singular_name' 		=> esc_html__('Manga', 'cc-manga'),
				'search_items' 			=> esc_html__('Search Manga', 'cc-manga'),
				'all_items' 			=> esc_html__('All Manga', 'cc-manga'),
				'edit_item' 			=> esc_html__('Edit Manga', 'cc-manga'),
				'update_item' 			=> esc_html__('Update Manga', 'cc-manga'),
				'add_new_item' 			=> esc_html__('Add New Manga', 'cc-manga'),
			),
			'public'				=> true,
			'has_archive'			=> false,
			'publicly_queryable'	=> true,
			'exclude_from_search'	=> false,
			'supports'				=> array('title', 'editor', 'thumbnail'),
			'rewrite'				=> array(
				'slug'					=> 'manga',
				'with_front'			=> true,
				'feeds'					=> true,
				'pages'					=> true
			)
		);

		register_post_type('cc-manga', $args);
	}

	add_action('init', 'cc_manga_create_post_type_manga', 12);
}

// register chapper post type.
if (!function_exists('cc_manga_create_post_type_chapter')) {
	function cc_manga_create_post_type_chapter() {
		$args	= array(
			'labels'				=> array(
				'name' 					=> esc_html__('Chapter', 'cc-manga'),
				'singular_name' 		=> esc_html__('Chapter', 'cc-manga'),
				'search_items' 			=> esc_html__('Search Chapter', 'cc-manga'),
				'all_items' 			=> esc_html__('All Chapter', 'cc-manga'),
				'edit_item' 			=> esc_html__('Edit Chapter', 'cc-manga'),
				'update_item' 			=> esc_html__('Update Chapter', 'cc-manga'),
				'add_new_item' 			=> esc_html__('Add New Chapter', 'cc-manga'),
			),
			'public'				=> true,
			'has_archive'			=> false,
			'publicly_queryable'	=> true,
			'exclude_from_search'	=> false,
			'supports'				=> array('title'),
			'rewrite'				=> array(
				'slug'					=> 'chapter',
				'with_front'			=> true,
				'feeds'					=> true,
				'pages'					=> true
			)
		);

		register_post_type('cc-chapter', $args);
	}

	add_action('init', 'cc_manga_create_post_type_chapter', 12);
}

//register taxonomy
if (!function_exists('cc_manga_create_taxonomy')) {
	function cc_manga_create_taxonomy() {
		$default			= cc_manga_default_manga_taxonomy();
		$custom_taxonomy 	= cs_get_option('custom_taxonomy', $default);
		if (!empty($custom_taxonomy)) {
			foreach ($custom_taxonomy as $taxonomy) {
				$slug 	= isset($taxonomy['slug']) ? $taxonomy['slug'] : sanitize_title($taxonomy['name']);

				$taxonomy_rewire = array(
					'slug'                  => $slug,
					'with_front'            => true,
					'hierarchical'          => true,
				);

				$labels = array(
					'name' 				=> $taxonomy['title'],
					'singular_name' 	=> $taxonomy['title'],
					'search_items' 		=> esc_html__('Search ', 'cc-manga') . $taxonomy['title'],
					'all_items' 		=> esc_html__('All ', 'cc-manga') . $taxonomy['title'],
					'edit_item' 		=> esc_html__('Edit ', 'cc-manga') . $taxonomy['title'],
					'update_item' 		=> esc_html__('Update ', 'cc-manga') . $taxonomy['title'],
					'add_new_item' 		=> esc_html__('Add ', 'cc-manga') . $taxonomy['title'],
					'new_item_name' 	=> esc_html__('New ', 'cc-manga') . $taxonomy['title'],
					'menu_name' 		=> $taxonomy['title'],
				);

				if ($taxonomy['type'] == 'category') {
					$hierarchical = true;
				} elseif ($taxonomy['type'] == 'tag') {
					$hierarchical = false;
				} else {
					$hierarchical = false;
				}

				register_taxonomy(sanitize_title($taxonomy['name']), array('cc-manga'), array(
					'hierarchical' 		=> $hierarchical,
					'labels' 			=> $labels,
					'show_ui' 			=> true,
					'show_admin_column' => true,
					'query_var' 		=> true,
					'rewrite' 			=> $taxonomy_rewire,
				));
			}
		}
	}

	add_action('init', 'cc_manga_create_taxonomy', 12);
}