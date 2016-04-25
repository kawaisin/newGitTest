<?php
/**
 * Theme: Spot
 * 
 * The "sidebar" for the widgetized footer area. If no widgets added AND just preivewing
 * the theme, then display some widgets as samples. Once the theme is actually in use,
 * it will be empty until the user adds some actual widgets.
 *
 * @package spot
 */
?>

<?php 
/* If footer "sidebar" has widgets, then retreive them */
//$sidebar_footer = get_dynamic_sidebar( 'Footer' );
$sidebar_footer = get_dynamic_sidebar( 'sidebar-2' );

/* If not, then display sample widgets, unless turned off in theme options */
/*global $theme_options;*/
if ( $theme_options['sample_widgets'] != false AND ! $sidebar_footer ) {
	$sidebar_footer = '<aside id="social-text" class="widget col-sm-12 clearfix widget_text">'
		.'<div class="textwidget">'
		.'<center>'
		.'<a href="https://twitter.com/"><span class="fa fa-twitter fa-2x fa-fw"></span></a> &nbsp;  &nbsp; '
		.'<a href="https://facebook.com/"><span class="fa fa-facebook fa-2x fa-fw"></span></a> &nbsp;  &nbsp; '
		.'<a href="https://linkedin.com/"><span class="fa fa-linkedin fa-2x fa-fw"></span></a>'
		.'</center>'
		.'</div><!-- textwidget -->'
		.'</aside>';
}

/* Apply filters and display the footer widgets */
if ( $sidebar_footer ) :
?>
	<div class="sidebar-footer clearfix">
	<div class="container">
		<div class="row">
		<?php echo apply_filters( 'xsbf_footer', $sidebar_footer ); ?>
		</div><!-- .row -->
	</div><!-- .container -->
	</div><!-- .sidebar-footer -->

<?php endif;?>