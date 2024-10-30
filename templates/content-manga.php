<?php
/**
 * Created by PhpStorm.
 * User: TRUNG
 * Date: 10/28/2017
 * Time: 7:46 PM
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

<div class="m-top">
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
									<label><?php echo esc_html__($field['name']); ?> :</label>
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
<div class="m-mid">
	<div class="entry-content">
		<h3 class="m-title"><?php echo esc_html__('Description', 'cc-manga'); ?></h3>
		<?php the_content(esc_html__('Read More', 'cc-manga')); ?>
	</div>
</div>
<div class="m-bottom">
	<div class="chapter-list">
		<h3 class="m-title"><?php echo esc_html__('Chapter List', 'cc-manga'); ?></h3>
		<?php if (!empty($details['chapter_list'])) : ?>
			<ul>
				<?php foreach ($details['chapter_list'] as $chapter) : ?>
					<?php $chapter_id = $chapter['select_chapter']; ?>
					<li>
						<a href="<?php echo get_post_permalink($chapter_id); ?>">
							<?php echo get_the_title($chapter_id); ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
</div>

