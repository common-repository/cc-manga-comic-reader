<?php
/**
 * Created by PhpStorm.
 * User: TRUNG
 * Date: 10/27/2017
 * Time: 9:53 PM
 */

if (!defined('ABSPATH')) {
	return;
}

$settings	= array(
	'menu_title'		=> esc_html__('Settings', 'cc-manga'),
	'menu_type'			=> 'submenu',
	'menu_parent'		=> 'edit.php?post_type=cc-manga',
	'menu_slug'			=> 'cc_manga_setting',
	'framework_title'	=> esc_html__('CC Manga Setting', 'cc-manga'),
	'ajax_save'			=> false,
	'show_reset_all'	=> false,
);

$options	= array();

$options[]	= array(
	'name'		=> 'manga',
	'title'		=> esc_html__('Manga', 'cc-manga'),
	'fields'	=> array(
		array(
			'id'				=> 'custom_taxonomy',
			'type'				=> 'group',
			'title'				=> esc_html__('Custom Taxonomy', 'cc-manga'),
			'button_title'		=> esc_html__('Add New Taxonomy', 'cc-manga'),
			'accordion'			=> true,
			'accordion_title'	=> esc_html__('New Taxonomy', 'cc-manga'),
			'fields'			=> array(
				array(
					'id'			=> 'name',
					'type'			=> 'text',
					'title'			=> esc_html__('Name', 'cc-manga'),
					'desc'			=> esc_html__('This is best if you use english', 'cc-manga')
				),

				array(
					'id'			=> 'title',
					'type'			=> 'text',
					'title'			=> esc_html__('Title', 'cc-manga'),
				),

				array(
					'id'			=> 'slug',
					'type'			=> 'text',
					'title'			=> esc_html__('Slug', 'cc-manga'),
					'desc'			=> esc_html__('This is best if you use english', 'cc-manga')
				),

				array(
					'id'			=> 'type',
					'type'			=> 'select',
					'class'			=> 'chosen',
					'title'			=> esc_html__('Type', 'cc-manga'),
					'options'		=> array(
						'category'	=> esc_html__('Category', 'cc-manga'),
						'tag'		=> esc_html__('Tags', 'cc-manga'),
					),
				)
			),
			'default'			=> array(
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
			),
		),

		array(
			'id'		=> 'custom_fields',
			'type'				=> 'group',
			'title'				=> esc_html__('Custom Fields', 'cc-manga'),
			'button_title'		=> esc_html__('Add New Field', 'cc-manga'),
			'accordion'			=> true,
			'accordion_title'	=> esc_html__('New Field', 'cc-manga'),
			'fields'			=> array(
				array(
					'id'		=> 'name',
					'type'		=> 'text',
					'title'		=> esc_html__('Name', 'cc-manga')
				),

				array(
					'id'		=> 'slug',
					'type'		=> 'text',
					'title'		=> esc_html__('Slug', 'cc-manga'),
					'desc'		=> esc_html__('This is best if you use english', 'cc-manga')
				),
			),
			'default'			=> array(
				array(
					'name'		=> esc_html__('Other Name','cc-manga'),
					'slug'		=> 'other-name',
				),

				array(
					'name'		=> esc_html__('Status','cc-manga'),
					'slug'		=> 'status',
				),
			)
		)
	)
);

$options[]	= array(
	'name'		=> 'taxonomy',
	'title'		=> esc_html__('Taxonomy', 'cc-manga'),
	'fields'	=> array(
		array(
			'id'			=> 'taxonomy_layout',
			'type'			=> 'select',
			'class'			=> 'chosen',
			'title'			=> esc_html__('Layout', 'cc-manga'),
			'options'		=> array(
				'list'		=> esc_html__('List', 'cc-manga'),
				'grid'		=> esc_html__('Grid', 'cc-manga'),
			),
		),

		array(
			'id'			=> 'taxonomy_columns',
			'type'			=> 'select',
			'class'			=> 'chosen',
			'title'			=> esc_html__('Columns', 'cc-manga'),
			'options'		=> array(
				'2'		=> esc_html__('2 Columns', 'cc-manga'),
				'3'		=> esc_html__('2 Columns', 'cc-manga'),
				'4'		=> esc_html__('4 Columns', 'cc-manga'),
				'6'		=> esc_html__('6 Columns', 'cc-manga'),
			),
			'default'	=> '4',
			'dependency'	=> array('taxonomy_layout', '==', 'grid')
		),

		array(
			'id'			=> 'taxonomy_post_per_page',
			'type'			=> 'text',
			'title'			=> esc_html__('Number Manga', 'cc-manga'),
			'default'		=> '8'
		),
	)
);

CSFramework::instance($settings, $options);