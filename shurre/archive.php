<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ShUrRe
 */
		function build_sorter($clave) {
		    return function ($a, $b) use ($clave) {
		        return strnatcmp($a[$clave], $b[$clave]);
		    };
		}

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			$conteo=0;
			while ( have_posts() ) :
				
				if($conteo==2){
					echo '</div>';
					echo '<div class="row">';
				}elseif ($conteo==0) {
					echo '<div class="row">';
				}
				else{
					$conteo=0;
				}
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content - Personalizado', get_post_type() );
				$conteo+=1;

			endwhile;
				echo '</div>';

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
