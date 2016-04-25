<?php
/**
 * Theme: Spot
 * 
 * Functions file to make changes to the parent theme's functions. 
 *
 * @package spot
 */
 
/**
 * SET THEME OPTIONS HERE
 *
 * Theme options can be overriden here. These are all set the same defaults as in the 
 * parent theme except for the navbar_classes. You can change whatever you want.
 * 
 * Parameters:
 * background_color - Hex code for default background color without the #. eg) ffffff
 *
 * content_width - Only for determining "full width" image. Actual width in Bootstrap.css.
 * 		1170 for screens over 1200px resolution, otherwise 970.
 *
 * embed_video_width - Sets the width of videos that use the <embed> tag. This defaults
 * 		to the smallest width of content with a sidebar before the sidebar collapses.
 *		The height is automatically set at a 16:9 ratio unless overridden.
 *
 * embed_video_height - Leave empty to automatically set at a 16:9 ratio to the width
 *
 * post_formats - WordPress extra post formats. i.e. 'aside', 'image', 'video', 'quote',
 * 		'link'
 *
 * touch_support - Whether to load touch support for carousels (sliders)
 *
 * fontawesome - Whether to load font-awesome font set or not
 *
 * bootstrap_gradients - Whether to load Bootstrap "theme" CSS for gradients
 *
 * navbar_classes - One or more of navbar-default, navbar-inverse, navbar-fixed-top, etc.
 *
 * custom_header_location - If 'header', displays the custom header above the navbar. If
 * 		'content-header', displays it below the navbar in place of the colored content-
 *		header section.
 *
 * image_keyboard_nav - Whether to load javascript for using the keyboard to navigate
 		image attachment pages
 *
 * sample_widgets - Whether to display sample widgets in the footer and page-bottom widet
 		areas.
 *
 * sample_footer_menu - Whether to display sample footer menu with Top and Home links
 * 
 * testimonials - Whether to activate testimonials custom post type if Jetpack plugin is 
 * 		active
 *
 * NOTE: THIS VARIABLE HAS BEEN RENAMED FROM $THEME_OPTIONS. PLEASE UPDATE YOUR CHILD THEMES.
 */
$xsbf_theme_options = array(
	//'background_color' 		=> 'f2f2f2',
	//'content_width' 			=> 1170,
	//'embed_video_width' 		=> 1170,
	//'embed_video_height' 		=> null, // i.e. calculate it automatically
	//'post_formats' 			=> '',
	//'touch_support' 			=> true,
	//'fontawesome' 			=> true,
	//'bootstrap_gradients' 	=> false,
	'navbar_classes'			=> 'navbar-inverse navbar-fixed-top', // Different than parent
	'custom_header_location' 	=> 'content-header',
	//'image_keyboard_nav' 		=> true,
	//'sample_widgets' 			=> true,
	//'sample_footer_menu'		=> true,
	//'testimonials'			=> true // requires Jetpack
);

/**
 * Force the site title to display in the navbar and add our custom header images
 */
add_action( 'after_setup_theme', 'xsbf_spot_after_setup_theme' ); 
function xsbf_spot_after_setup_theme() {

	// These args will override the ones in the parent theme
	$args = array(
		'header-text' => false, // doesn't allow user to turn off header text
		'default-text-color'     => 'fff',
		'default-image' => get_stylesheet_directory_uri() . '/images/headers/notepad-blue.jpg',
		'width' => 1600,
		'height' => 900
	);
	add_theme_support( 'custom-header', $args );

	//The %2$s references the child theme directory (ie the stylesheet directory), use 
	// %s to reference the parent directory.
	register_default_headers( array(
		'abstract' => array(
			'url'           => '%2$s/images/headers/abstract-blue.jpg',
			'thumbnail_url' => '%2$s/images/headers/abstract-blue-thumbnail.jpg',
			'description'   => __( 'Abstract', 'flat-bootstrap' )
		),
		'book' => array(
			'url'           => '%2$s/images/headers/book-blue.jpg',
			'thumbnail_url' => '%2$s/images/headers/book-blue-thumbnail.jpg',
			'description'   => __( 'Book', 'flat-bootstrap' )
		),
		'briefcase' => array(
			'url'           => '%2$s/images/headers/briefcase-blue.jpg',
			'thumbnail_url' => '%2$s/images/headers/briefcase-blue-thumbnail.jpg',
			'description'   => __( 'Briefcase', 'flat-bootstrap' )
		),
	) );
}

/**
 * ADD A THIRD MENU FOR SOCIAL MEDIA ICONS TO BE ADDED TO THE OFFCANVAS MENU
 * NOTE: THIS IS FROM JUSTIN TADLOCK
 */
/*
add_action( 'init', 'xsbf_spot_register_menus' );
function xsbf_spot_register_menus() {
	register_nav_menus(
		array(
			'social' 	=> __( 'Social Menu', 'flat-bootstrap' ),
		)
	);
}
*/

/****** Remove WP Generator ********/
remove_action('wp_head', 'feed_links_extra', 3); 
remove_action('wp_head', 'feed_links', 2); 
remove_action('template_redirect', 'wp_shortlink_header', 11 );
remove_action('wp_head', 'wp_generator'); 
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');

function remove_woo_version() {
    remove_action('wp_head', 'woo_version');
}
add_action( 'after_setup_theme', 'remove_woo_version' );

/*
 * Set the CSS for the Appearance > Header admin panel 
 */
 function xsbf_admin_header_style() {
	$header_image = get_header_image();
?>
	<style type="text/css" id="xsbf-admin-header-css">

	.appearance_page_custom-header #headimg {
		border: none;
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		<?php
		if ( ! empty( $header_image ) ) {
			echo 'background: url(' . esc_url( $header_image ) . ') no-repeat scroll center center; background-size: 1600px auto; background-position: center center;';
			echo 'height: 480px;';
		} else {
			echo 'height: 200px;';
		}
		?>
		padding: 0 40px;
	}
	#headimg .home-link {
		-webkit-box-sizing: border-box;
		-moz-box-sizing:    border-box;
		box-sizing:         border-box;
		margin: 0 auto;
		max-width: 1040px;
		<?php
		if ( ! empty( $header_image ) ) {
			echo 'height: 480px;';
		} else {
			echo 'height: 200px;';
		}
		?>
		width: 100%;
	}

	#headimg h1 {
		font: 700 41px/45px Raleway, Arial, 'Helvetica Neue', sans-serif;
		<?php
		if ( ! empty( $header_image ) ) {
			echo 'margin: 200px 0 11px;';
		} else {
			echo 'margin: 50px 0 11px;';
		}
		?>
		text-align: center;
	}
	#headimg h2 {
		font: 300 24px/26px Raleway, Arial, 'Helvetica Neue', sans-serif;
		margin: 10px 0 25px;
		text-align: center;
		/*text-shadow: none;*/
	}

	<?php // If text color not overriden, use white (assume dark background) ?>
	<?php if ( HEADER_TEXTCOLOR == get_header_textcolor() OR HEADER_TEXTCOLOR == 'blank') : ?>
	#headimg h1, #headimg h2 {
		color: white !important;
	}

	<?php // Otherwise, set the text color to what the user selected ?>
	<?php else : ?>
	#headimg h1, #headimg h2 {
		color: <?php get_header_textcolor(); ?> !important;
	}	
	<?php endif; ?>

	</style>
<?php
}

/* 
 * Display the header image in the Appearance > Header and Appearance > Customize
 */
function xsbf_admin_header_image() {
	?>
	<div id="headimg" style="background: #34495e url(<?php header_image(); ?>) no-repeat scroll top; background-size: 1600px auto; background-position: center center;">
	<div class="section-image-overlay">
		<?php $style = ' style="color:#' . get_header_textcolor() . ';"'; ?>
		<div class="home-link">
			<h1 class="displaying-header-text" <?php echo $style; ?>><?php bloginfo('name'); ?></h1>
			<h2 id="desc" class="displaying-header-text"<?php echo $style; ?>><?php bloginfo('description'); ?></h2>
		</div>
	</div>
	</div>
<?php 
} 

/*
 * Hook into navbar HTML to shift the menu items to the right and just for fun replace any "O"
 * found in the site name with a red dot.
 */
add_filter( 'xsbf_navbar', 'xsbf_spot_navbar' );
function xsbf_spot_navbar ( $navbar ) {
	$navbar = str_ireplace( 'navbar-collapse collapse', 'navbar-collapse collapse navbar-right', $navbar ); 
	//$navbar = str_ireplace( 'O', '<i class="fa fa-circle"></i>', $navbar ); 
	$navbar = str_ireplace ( 'rel="home">' . get_bloginfo('name') . '</a>', 'rel="home">' . xsbf_spot_replace_oh_with_dot ( get_bloginfo('name') ) . '</a>', $navbar ); 
	return $navbar;
}

/*
add_filter( 'wp_nav_menu_args', 'xsbf_modify_nav_menu_args' );
function xsbf_modify_nav_menu_args( $args )
{
	if( 'primary' == $args['theme_location'] )
	{
		//$args['depth'] = -1;
		//$args['container_id'] = 'my_primary_menu';
		$args['container_class'] .= 'navbar-right';
	}
	return $args;
}
*/

// enqueue scripts and stylesheets to wordpress
function custom_enqueue_scripts() {
    
	wp_deregister_style ('flat-bootstrap');
    // enqueue our theme's style.css
    
    
     // enqueue our custom scripts
    wp_register_script( 'bxslider', 'https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.5/jquery.bxslider.min.js', array('jquery'), NULL, true  );
    wp_enqueue_script( 'bxslider' );
    // enqueue our custom scripts
    wp_register_script( 'custom-scripts', get_stylesheet_directory_uri() . '/js/global.js', array('jquery'), NULL, true  );
    wp_enqueue_script( 'custom-scripts' );
    // enqueue Google fonts Open Sans and Neucha
    //wp_register_style( 'lato-fonts', 'https://fonts.googleapis.com/css?family=Lato:400,700', false, NULL, 'all' );
    // wp_enqueue_style( 'lato-fonts');
    wp_register_script('fonts_com_script', 'http://fast.fonts.net/jsapi/cc84b25d-016d-4d1c-8f50-b129bf958001.js',NULL, true);
    wp_enqueue_script('fonts_com_script');

}
add_action( 'wp_enqueue_scripts', 'custom_enqueue_scripts' );





/****** Add Fonts/.net *******/

//function fonts_adding_scripts() {
//wp_register_script('fonts_com_script', 'http://fast.fonts.net/jsapi/cc84b25d-016d-4d1c-8f50-b129bf958001.js',NULL, true);
//wp_enqueue_script('fonts_com_script');
//}

add_action( 'wp_enqueue_scripts', 'fonts_adding_scripts' );

/*
 * Just for fun, helper function to replace "O" with a red dot. Used by header.php.
 */
//add_filter('option_blogname','xsbf_spot_replace_oh_with_dot');
function xsbf_spot_replace_oh_with_dot ( $text ) {
	//print_r ( $text ); //TEST
	$text = str_ireplace( 'O', '<i class="fa fa-circle color-red"></i>', $text ); 
	return $text;
}

/** div shortcode **/
function div_text_shortcode( $atts , $content = null ) {

	// Attributes
	extract( shortcode_atts(
		array(
			'class' => '',
	 		'id' => '',
		), $atts )
	);

	// Code
return '<div id="'.$id.'" class="'.$class.'">' . do_shortcode($content) . '</div>';

}
add_shortcode( 'div', 'div_text_shortcode' );




// Register New Menu


function register_additional_menu() {  
register_nav_menu( 'third-menu' ,__( 'Footer Menu 2' ));
}
add_action( 'init', 'register_additional_menu' );
add_action( 'after_footer', 'add_third_nav_genesis' ); 

function add_third_nav_genesis() {
wp_nav_menu( array( 'theme_location' => 'third-menu', 'container_class' => 'genesis-nav-menu' ) );
}


// Remove jetpack comments

function tweakjp_rm_comments_att( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
        return false;
    }
    return $open;
}
add_filter( 'comments_open', 'tweakjp_rm_comments_att', 10 , 2 );


// load lightweight popup script

function load_popupscript() {

 		wp_enqueue_script('featherlight-popup-script', '//cdn.rawgit.com/noelboss/featherlight/1.3.5/release/featherlight.min.js', array('jquery'), '', true );
 		 wp_register_style( 'featherlight-css', '//cdn.rawgit.com/noelboss/featherlight/1.3.5/release/featherlight.min.css', false, NULL, 'all' );
    wp_enqueue_style( 'featherlight-css');
}
add_action('get_header', 'load_popupscript' );

