<?php
add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'auto_update_theme', '__return_true' );
function enqueue_scripts_styles(){
	wp_enqueue_script('script', get_stylesheet_directory_uri() . '/script.js', array('jquery'), '1.0.1', true);//script.js
	wp_enqueue_style('fontawesome-5', 'https://use.fontawesome.com/releases/v5.10.0/css/all.css');//fontawesome 5
	wp_enqueue_style('slick-css', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css');//slick css
	wp_enqueue_script( 'Slick', 'https://cdn.jsdelivr.net/jquery.slick/1.5.9/slick.min.js', null, null, true );
}
add_action('wp_enqueue_scripts','enqueue_scripts_styles');

//custom login logo
function site_login_logo() {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $custom_logo_id , 'medium' );

?>
<style type="text/css">
	#login h1 a, .login h1 a {
		background-image: url(<?php echo $image[0]; ?>);
		height:<?php echo $image[2]; ?>px;
		width:<?php echo $image[1]; ?>px;
		max-height: 150px;
		background-size: contain;
		background-repeat: no-repeat;
		margin: 0 auto 10px;
	}
</style>
<?php }
add_action( 'login_enqueue_scripts', 'site_login_logo' );

// change the alt text on the logo to show site name
function my_login_title() {
	return get_option('blogname');
}
add_filter('login_headertitle', 'my_login_title');

//logo link to home page
function site_login_logo_url() {
	return home_url();
}
add_filter( 'login_headerurl', 'site_login_logo_url' );

//site logo in slideout menu
add_action('generate_inside_slideout_navigation', 'add_slide_menu_logo');
function add_slide_menu_logo() {
	echo the_custom_logo();
}

//underline shortcode
function generate_underline( $atts ) {
	$a = shortcode_atts( array(
		'width' => '200px',
		'height' => '2px',
		'color' => '#eeeeee',
		'position' => 'center',
		'margin-bottom' => '10px'
	), $atts );
	ob_start();
?>
<p style="margin-bottom:<?php echo $a['margin-bottom']; ?>;text-align:<?php echo $a['position']; ?>">
	<span style="display:inline-block; width:<?php echo $a['width']; ?>; height:<?php echo $a['height']; ?>; background-color:<?php echo $a['color']; ?>;"><!--undeline--></span>
</p>
<?php
	return ob_get_clean();
}
add_shortcode( 'underline', 'generate_underline' );

//&nbsp shortcode
function nbsp_shortcode( $atts, $content = null ) {
	$content = '&nbsp';
	return $content;
}
add_shortcode( 'nbsp', 'nbsp_shortcode' );

//font awesome shortcode
function fa_shortcode( $atts ) {
	$a = shortcode_atts( array(
		'class' => '',
		'color' => ''), $atts);
	ob_start(); ?>
<i class="<?php echo $a['class']; ?>" style="<?php echo $a['color'] ? 'color:' . $a['color']: ''; ?>"></i>
<?php
	return ob_get_clean();
}
add_shortcode( 'fa', 'fa_shortcode' );

//Add Options Page
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Site Settings',
		'menu_title'	=> 'Site Settings',
		'menu_slug' 	=> 'site-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

// Change mobile breakpoint
add_filter( 'generate_mobile_menu_media_query', function() {
	return '(max-width: 1100px)';
} );

// Add Header Items 
add_filter('wp_nav_menu_items', 'add_header_items', 10, 2);
function add_header_items($items, $args){
	if( $args->theme_location == 'primary' ){
		$url = '/contact';
		$telurl = 'tel:'.get_field('phone', 'option');
		$items .= '<li class="callNow"><a title="Contact" href="'. esc_url( $telurl ) .'">' . __( '<span>Call our showroom</span><p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 22.621l-3.521-6.795c-.008.004-1.974.97-2.064 1.011-2.24 1.086-6.799-7.82-4.609-8.994l2.083-1.026-3.493-6.817-2.106 1.039c-7.202 3.755 4.233 25.982 11.6 22.615.121-.055 2.102-1.029 2.11-1.033z"/></svg>'.get_field('phone', 'option') ) . '</p></a></li><li class="bookNow"><a title="Book" href="'. esc_url( $url ) .'">' . __( 'Book an Appointment' ) . '</a></li>';
	}
	elseif ($args->theme_location == 'slideout') {
		$url = '/contact';
		$telurl = 'tel:'.get_field('phone', 'option');
		$items .= '<div class="addedItems"><li class="callNow"><a title="Contact" href="'. esc_url( $telurl ) .'">' . __( '<p><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M20 22.621l-3.521-6.795c-.008.004-1.974.97-2.064 1.011-2.24 1.086-6.799-7.82-4.609-8.994l2.083-1.026-3.493-6.817-2.106 1.039c-7.202 3.755 4.233 25.982 11.6 22.615.121-.055 2.102-1.029 2.11-1.033z"/></svg>'.get_field('phone', 'option') ) . '</p></a></li><li class="bookNow"><a title="Book" href="'. esc_url( $url ) .'">' . __( 'Book an Appointment' ) . '</a></li></div>';
	}
	return $items;
}

function cw_post_type_kitchens() {
	$supports = array(
		'title', 
		'editor', 
		'author',
		'thumbnail', 
		'excerpt', 
		'custom-fields', 
		'comments', 
		'revisions', 
		'post-formats',
	);
	$labels = array(
		'name' => _x('kitchens', 'plural'),
		'singular_name' => _x('kitchens', 'singular'),
		'menu_name' => _x('Kitchens', 'admin menu'),
		'name_admin_bar' => _x('kitchens', 'admin bar'),
		'add_new' => _x('Add New', 'add new'),
		'add_new_item' => __('Add New news'),
		'new_item' => __('New news'),
		'edit_item' => __('Edit kitchens'),
		'view_item' => __('View kitchens'),
		'all_items' => __('All kitchens'),
		'search_items' => __('Search kitchens'),
		'not_found' => __('No kitchens found.'),
	);
	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'kitchens'),
		'has_archive' => true,
		'hierarchical' => false,
	);
	register_post_type('kitchens', $args);
}
add_action('init', 'cw_post_type_kitchens');

flush_rewrite_rules( false );
