<?php
/**
 * Created by PhpStorm.
 * User: TRUNG
 * Date: 10/27/2017
 * Time: 8:00 PM
 */

if (!defined('ABSPATH')) {
	return;
}

get_header();

$taxonomy		= isset($params['taxonomy']) ? $params['taxonomy'] : '';
$queried_object = get_queried_object();
$term_id 		= $queried_object->term_id;
$term 			= get_term($term_id, $taxonomy);

global $wp_query;

$args = array(
	'post_type'	=> 'cc-manga',
	'tax_query'	=> array(
		array(
			'taxonomy'	=> $term->taxonomy,
			'field'		=> 'term_id',
			'terms'		=> $term_id,
		)
	),
	'posts_per_page'	=> cs_get_option('taxonomy_post_per_page', 8)
);

$template 	= new CC_Manga_Template();
$layout		= cs_get_option('taxonomy_layout', 'list');
$columns	= cs_get_option('taxonomy_columns', '4');
?>
<div class="cc-manga">
	<div class="single-taxonomy">
		<div class="container">
			<h1>
				<?php echo esc_attr($term->name); ?>
			</h1>
			<div class="single-manga wrap-manga manga-<?php echo esc_attr($layout); ?>">
				<div class="row">
					<?php
						$wp_query = new WP_Query($args);

						if (have_posts()) {
							while (have_posts()) {
								the_post();

								$template->get_template_part('archive/' . $layout);
							}
						}

						wp_reset_query();
					?>
				</div>
			</div>
		</div>
	</div>
</div>


<?php

get_footer();
