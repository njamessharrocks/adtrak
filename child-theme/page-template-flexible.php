<?php
/**
 * Template Name: Flexible Content
 *
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package paramount
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main>
			<div class="container-fluid">

			<?php if( have_rows('layout') ): 
			while (have_rows('layout')) : the_row();

				$layout = get_row_layout();
					$template_path = get_stylesheet_directory() . '/layouts/' . str_replace('_', '-', $layout) . '.php';

					if (file_exists($template_path)) {

						include $template_path;
					}
				endwhile;
			endif; ?>
				
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();