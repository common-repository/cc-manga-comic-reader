<?php
/**
 * Created by PhpStorm.
 * User: TRUNG
 * Date: 10/27/2017
 * Time: 8:53 PM
 */

if (!defined('ABSPATH')) {
	return;
}

get_header();

global $post;

$template = new CC_Manga_Template();
?>

<div class="cc-manga">
	<div class="single-manga">
		<div class="container">
			<?php
				if (have_posts()) :
					while (have_posts()) {
						the_post();

						$template->get_template_part('content-manga');
					}
				endif;

				wp_reset_query();
			?>
		</div>
	</div>
</div>

<?php
get_footer();