<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ShUrRe
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="profile" href="http://gmpg.org/xfn/11">-->
	
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_url'); ?>/css/materialize.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
      <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/materialize.min.js"></script>
	<div class="container">
		 <div class="row">
		 	<div  id="izq"  class="col s3 3">
		      	
				  <div class="section">
				    
					<img class="logo" src="<?php 
					$custom_logo_id = get_theme_mod('custom_logo' );
					$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
					echo $image[0];?>"/>
					

				    <?php
					
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
					$shurre_description = get_bloginfo( 'description', 'display' );
					?>
				    <h5><?php echo $shurre_description; /* WPCS: xss ok. */ ?></h5>
				     <nav>
					    <div class=" input-field col s12 " >
					    	<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
							    <ul class="left hide-on-med-and-down">
								    	<li>
								    		<i class="material-icons prefix">search</i>
								    		<input id="icon_prefix" type="text" value="<?php echo get_search_query() ?>" name="s" class="search validate">
				          					<label for="icon_prefix">Buscar</label>
				          				</li>
							    </ul>
						    	
		          			</form>
		          			<script>
		          				function key(){
		          					$('.search').keypress(function (e) {
								  if (e.which == 13) {
								    $('search-form').submit();
								    return false;    //<---- Add this line
								  }
								});
		          			}
		          			</script>

						   
						
						</div>
					</nav>	
				  </div>
				  <!-- compartir-->
				<div class="divider col s12" ></div>
				  <div class="section col s12">
				  	<?php
				    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
						return;
					}
					?>

					<aside id="secondary" class="widget-area">
						<?php dynamic_sidebar( 'sidebar-1' ); ?>
					</aside><!-- #secondary -->
				  </div>

		      </div>
		      <div id="der" class="col s9 9">
				<!--navegacion-->
				 <nav id="site-navigation" class="main-navigation">
				    <div class="nav-wrapper">
				      
				      <ul class="left hide-on-med-and-down main-menu">
						<?php
				       $list_pages_args = array(
							'container' => '',
							'title_li' 	=> ''
						);
					
						wp_nav_menu( $list_pages_args );
						?>
				      </ul>
				    </div>
				  </nav>
				



<?php /*





<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'shurre' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php
			the_custom_logo();
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$shurre_description = get_bloginfo( 'description', 'display' );
			if ( $shurre_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $shurre_description; /* WPCS: xss ok. *//* ?></p>
			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'shurre' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'menu-1',
				'menu_id'        => 'primary-menu',
			) );
			?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
*/
	?>
	
