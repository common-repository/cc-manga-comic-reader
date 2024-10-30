<?php
/**
 * Created by PhpStorm.
 * User: TRUNG
 * Date: 10/27/2017
 * Time: 9:42 PM
 */

if (!defined('ABSPATH')) {
	return;
}

$options	= array();

// -----------------------------------------------------------------------------------------------
// MANGA
// -----------------------------------------------------------------------------------------------
//custom field manga
$default_field	= cc_manga_default_manga_option();
$custom_field 	= cs_get_option('custom_fields', $default_field);
$fields			= array();

if (!empty($custom_field)) {
	foreach ($custom_field as $field) {
		$new_arr = array();

		$new_arr['id'] 		= isset($field['slug']) ? $field['slug'] : '';
		$new_arr['type'] 	= 'text';
		$new_arr['title'] 	= isset($field['name']) ? $field['name'] : '';

		$fields[] = $new_arr;
	}
}

//select chapter for manga
$chapter_all_opts 	= array();
$chapter_all_list	= cc_manga_get_list_chapter_all();

if (!empty($chapter_all_list)) {
	foreach ($chapter_all_list as $chapter) {
		$chapter_all_opts[$chapter->ID] = $chapter->post_title;
	}
}

$list_chapter_in_manga = array(
	'id'				=> 'chapter_list',
	'type'				=> 'group',
	'title'				=> esc_html__('Chapter', 'cc-manga'),
	'button_title'		=> esc_html__('Add New Chapter', 'cc-manga'),
	'accordion'			=> true,
	'accordion_title'	=> esc_html__('New Chapter', 'cc-manga'),
	'fields'			=> array(
		array(
			'id' => 'select_chapter',
			'type' => 'select',
			'title' => esc_html__('Chapter', 'cc-manga'),
			'options' => $chapter_all_opts,
		),
	),
);

$fields[] = $list_chapter_in_manga;

$options[]	= array(
	'id'		=> '_manga_details',
	'title'		=> esc_html__('Details', 'cc-manga'),
	'post_type'	=> array('cc-manga'),
	'context'	=> 'normal',
	'priority'	=> 'low',
	'sections'	=> array(
		array(
			'name'			=> 'manga_detail',
			'fields'		=> $fields
		),
	),
);

// -----------------------------------------------------------------------------------------------
// CHAPTER
// -----------------------------------------------------------------------------------------------
$manga_opts 	= array();
$manga_list	= cc_manga_get_list_manga();

if (!empty($manga_list)) {
	foreach ($manga_list as $manga) {
		$manga_opts[$manga->ID] = $manga->post_title;
	}
}

$options[]	= array(
	'id'		=> '_chapter_details',
	'title'		=> esc_html__('Details', 'cc-manga'),
	'post_type'	=> array('cc-chapter'),
	'context'	=> 'normal',
	'priority'	=> 'low',
	'sections'	=> array(
		array(
			'name'			=> 'chapter_detail',
			'fields'		=> array(
				array(
					'id' => 'select_manga',
					'type' => 'select',
					'title' => esc_html__('Select Manga', 'cc-manga'),
					'options' => $manga_opts,
				),

				array(
					'id'				=> 'list_image',
					'type'				=> 'group',
					'title'				=> esc_html__('List image', 'cc-manga'),
					'button_title'		=> esc_html__('Add New Image', 'cc-manga'),
					'accordion'			=> true,
					'accordion_title'	=> esc_html__('New Image', 'cc-manga'),
					'fields'			=> array(
						array(
							'id'			=> 'link',
							'type'			=> 'text',
							'title'			=> esc_html__('Link', 'cc-manga'),
						),
					),
				),
			)
		),
	),
);

CSFramework_Metabox::instance($options);