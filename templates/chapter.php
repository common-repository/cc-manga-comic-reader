<?php
/**
 * Created by PhpStorm.
 * User: TRUNG
 * Date: 10/27/2017
 * Time: 9:53 PM
 */

get_header();

global $post;

$chapter_details 	= get_post_meta($post->ID, '_chapter_details');
$details			= !empty($chapter_details) ? $chapter_details[0] : '';

?>

<div class="cc-manga">
	<div class="single-chapter">
		<div class="container">
			<?php the_title('<h2 class="entry-title p-name" itemprop="name headline"><a href="" rel="bookmark" class="u-url url" itemprop="url">', '</a></h2>'); ?>
			<div class="image-list">
				<?php if (!empty($details['list_image'])) : ?>
					<?php foreach($details['list_image'] as $image) : ?>
						<div class="cc-image">
							<img src="<?php echo esc_url($image['link']); ?>" />
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
			<div class="post-navigation" role="navigation">
				<div class="nav-previous">
					<?php previous_post_link('%link', '<span class="post-near">%title</span>'); ?>
				</div>
				<div class="nav-next">
					<?php next_post_link('%link', '<span class="post-near">%title</span>'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();