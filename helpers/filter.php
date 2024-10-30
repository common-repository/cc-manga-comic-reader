<?php
/**
 * Created by PhpStorm.
 * User: TRUNG
 * Date: 10/27/2017
 * Time: 11:17 PM
 */

if (!defined('ABSPATH')) {
	return;
}

if (!function_exists('cc_manga_custom_save_chapter')) {
	function cc_manga_custom_save_chapter($request) {
		global $post;

		//import chapter to manga
		if (isset($request['select_manga']) && $request['select_manga'] != '') {
			$manga_id 		= $request['select_manga'];
			$manga_details 	= get_post_meta($manga_id, '_manga_details', true);

			if (get_post_meta($post->ID, '_manga_id', false)) {
				update_post_meta($post->ID, '_manga_id', $manga_id);
			} else {
				add_post_meta($post->ID, '_manga_id', $manga_id);
			}

			if (!empty($manga_details)) {
				$chapter_list = isset($manga_details['chapter_list']) ? $manga_details['chapter_list'] : array();

				if (!empty($chapter_list)) {
					$chapter_arr = array();

					foreach ($chapter_list as $chapter) {
						$chapter_arr[] = $chapter['select_chapter'];
					}

					if (!in_array($post->ID, $chapter_arr)) {
						$chapter_list[]['select_chapter'] = $post->ID;
					}

					$manga_details['chapter_list'] = $chapter_list;
				} else {
					$manga_details['chapter_list'][]['select_chapter'] = $post->ID;
				}

				update_post_meta($manga_id, '_manga_details', $manga_details);
			} else {
				$manga_details = array();
				$manga_details['chapter_list'][]['select_chapter'] = $post->ID;

				add_post_meta($manga_id, '_manga_details', $manga_details);
			}
		}

		return $request;
	}

	add_filter('cs_save_post', 'cc_manga_custom_save_chapter');
}

//Build next/prev chapter
if (!function_exists('cc_manga_get_adjacent_past_events_join')) {
	function cc_manga_get_adjacent_past_events_join($join) {
		if (is_singular('cc-chapter')) {
			global $wpdb;

			$new_join = $join . "INNER JOIN $wpdb->postmeta AS m ON p.ID = m.post_id ";

			return $new_join;
		}

		return $join;
	}

	add_filter('get_previous_post_join', 'cc_manga_get_adjacent_past_events_join');
	add_filter('get_next_post_join', 'cc_manga_get_adjacent_past_events_join');
}

//Next chapter
if (!function_exists('cc_manga_get_next_past_events_where')) {
	function cc_manga_get_next_past_events_where($where) {
		if (is_singular('cc-chapter')) {
			global $wpdb, $post;

			$manga_id = get_post_meta($post->ID, '_manga_id');
			$manga_id = !empty($manga_id) ? $manga_id[0] : '';

			$new_where = "WHERE p.post_type = 'cc-chapter' AND p.post_status = 'publish' AND m.meta_key = '_manga_id' AND m.meta_value = " . $manga_id . " AND p.id > " . $post->ID;

			return $new_where;
		}

		return $where;
	}

	add_filter('get_next_post_where', 'cc_manga_get_next_past_events_where');
}

//Prev chapter
if (!function_exists('cc_manga_get_pre_past_events_where')) {
	function cc_manga_get_pre_past_events_where($where) {
		if (is_singular('cc-chapter')) {
			global $wpdb, $post;

			$manga_id = get_post_meta($post->ID, '_manga_id');
			$manga_id = !empty($manga_id) ? $manga_id[0] : '';

			$new_where = "WHERE p.post_type = 'cc-chapter' AND p.post_status = 'publish' AND m.meta_key = '_manga_id' AND m.meta_value = " . $manga_id . " AND p.id < " . $post->ID;

			return $new_where;
		}

		return $where;
	}

	add_filter('get_previous_post_where', 'cc_manga_get_pre_past_events_where');
}