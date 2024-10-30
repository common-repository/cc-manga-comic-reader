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

?>

<div <?php post_class(); ?>>
	<div class="row">
		<div class="col-md-3">
			<?php the_post_thumbnail($post->ID); ?>
		</div>
		<div class="col-md-9">
			<?php the_title('<h2 class="entry-title p-name" itemprop="name headline"><a href="" rel="bookmark" class="u-url url" itemprop="url">', '</a></h2>'); ?>

			<?php if (!empty($details)) : ?>
				<ul class="manga-info">
					<?php if (!empty($custom_field)) : ?>
						<?php foreach ($custom_field as $field) : ?>
							<?php if ($details[$field['slug']] != '') : ?>
								<li>
									<label><?php echo esc_attr($field['name']); ?> :</label>
									<span><?php echo esc_attr($details[$field['slug']]); ?></span>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
					<?php if (!empty($custom_taxonomy)) : ?>
						<?php foreach ($custom_taxonomy as $taxonomy) : ?>
							<li>
								<label><?php echo esc_attr($taxonomy['title']); ?> :</label>
								<span><?php echo cc_manga_get_manga_taxomony($post->ID, sanitize_title($taxonomy['name'])); ?></span>
							</li>
						<?php endforeach; ?>
					<?php endif; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</div>
