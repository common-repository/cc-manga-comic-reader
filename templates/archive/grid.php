<?php
/**
 * Created by PhpStorm.
 * User: TRUNG
 * Date: 11/1/2017
 * Time: 9:48 PM
 */

if (!defined('ABSPATH')) {
	return;
}

global $post;

$manga_info = get_post_meta($post->ID, '_manga_details');
$details 	= (!empty($manga_info)) ? $manga_info[0] : '';

$default_field	= cc_manga_default_manga_option();
$custom_field 	= cs_get_option('custom_fields', $default_field);
$fields			= array();

$default_taxonomy	= cc_manga_default_manga_taxonomy();
$custom_taxonomy 	= cs_get_option('custom_taxonomy', $default);

$columns	= cs_get_option('taxonomy_columns', '4');

$classes	= array('post');

$classes[]	= 'col-md-' . 12/$columns;
?>

<div <?php post_class(count($classes) ? implode(' ', $classes) : ''); ?>>
	<div class="entry-image">
		<?php the_post_thumbnail($post->ID); ?>
	</div>
	<div class="manga-content">
		<?php the_title('<h2 class="entry-title p-name" itemprop="name headline"><a href="" rel="bookmark" class="u-url url" itemprop="url">', '</a></h2>'); ?>
	</div>
</div>
