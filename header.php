<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package muzka
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]--><html <?php language_attributes(); ?>>
<head>
	<style>
      html, body, #map-canvas {
        height: 400px;
        margin: 0px;
        padding: 0px
      }
    </style>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<meta name="author" content="www.zerotheme.com">

	<!--[if lt IE 8]>
       <div style=' clear: both; text-align:center; position: relative;'>
         <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
           <img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
      </div>
    <![endif]-->
    <!--[if lt IE 9]>
		<script src="js/html5.js"></script>
		<script src="js/css3-mediaqueries.js"></script>
	<![endif]-->
	<link href='<?php echo get_template_directory_uri(); ?>/images/favicon.ico' rel='icon' type='image/x-icon'/>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<header>
	<div class="wrap-header zerogrid">
		<div id="logo"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png"/></a></div>
		
		<div id="search">
			<div class="button-search" onclick="submit_search();"></div>
			
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label>
				<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'muzka' ); ?></span>
				<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'muzka' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" onfocus="if (this.value == &#39;Search...&#39;) {this.value = &#39;&#39;;}" onblur="if (this.value == &#39;&#39;) {this.value = &#39;Search...&#39;;}">
			</label>

		</form>
		<script>
			function submit_search(){
				jQuery('#search form').submit();
			}
	</script>
		</div>


	</div>
</header>

<nav>
	<div class="wrap-nav zerogrid">

	<?php    /**
		* Displays a navigation menu
		* @param array $args Arguments
		*/
		$args = array(
			'theme_location' => 'primary_menu',
			'menu' => '',
			'container' => 'div',
			'container_class' => 'menu-{menu-slug}-container',
			'container_id' => '',
			'menu_class' => 'menu',
			'menu_id' => '',
			'echo' => true,
			'fallback_cb' => 'wp_page_menu',
			'before' => '',
			'after' => '',
			'link_before' => '',
			'link_after' => '',
			'items_wrap' => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
			'depth' => 0,
			'walker' => ''
		);
	
		echo wp_nav_menu( $args ); ?>
	
	</div>
</nav>

