

<?php


/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ShUrRe
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">



		

		


		<?php


		// se crea la funcion para ordernar por atributo
	   function build_sorter($clave) {
		    return function ($a, $b) use ($clave) {
		        return strnatcmp($a[$clave], $b[$clave]);
		    };
		}


		$cat=array('platos','ocasiones','regiones');

		
		
		foreach ($cat as $postCategoria) {
			echo'<h3 class="sub-title"> <a href="/Flujos_datos_php/categoria/'.$postCategoria.'">'.$postCategoria.'</a></h3>';
		

			$args = array( 'post_type' => 'receta', 'posts_per_page' => 3,'categoria'=>$postCategoria );
			$loop = new WP_Query( $args );

				echo '<div class="row">';
			while ( $loop->have_posts() ) : $loop->the_post();
			  
			 // $loop->single_post_title(); 

			 ?>
						
							<div class="col s4 4">


								 <?php
								
								//echo " <br/>extrae las categoriass ";
								$etiquetas=array();
								// extrae las categorias personalizadas del post
								$terms = get_the_terms( get_queried_object_id(), 'categoria' );

									if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
									    //echo '<ul>';
									    $conteo=0;
									    foreach ( $terms as $key=>$term ) {
									        $etiquetas[$conteo]=(array("id"=>$term->term_taxonomy_id,"name"=>$term->name,"parent"=>$term->parent));
									        $conteo+=1;
									        
									    }
									    
										// se ordena el arreglo
										usort($etiquetas, build_sorter('parent'));
										$lista=array();
										// se recorre el arreglo 
										foreach ($etiquetas as $item) {
											// si el arreglo no tiene parent es principal.
											if($item['parent']==0){
												$lista[$item['id']]['id']=$item['id'];
												$lista[$item['id']]['name']=$item['name'];
												$lista[$item['id']]['parent']=$item['parent'];
												// se busca los atributo que tengan el parent anterior.
												foreach ($etiquetas as $item2) {
													if($item['id']==$item2['parent']){
														$lista[$item2['id']]['id']=$item2['id'];
														$lista[$item2['id']]['name']=$item2['name'];
														$lista[$item2['id']]['parent']=$item2['parent'];
													}
													
												}
											}

										    
										}
										
									}

								
								
								// extrae los metas personalizados. en el caso la descripcion
								$custom_fields = get_post_custom();
								$my_custom_field = $custom_fields['_descripcion_corta'];
								$descripcion="";
								foreach ( $my_custom_field as $key => $value ) {
								    //echo $key . " => " . $value . "<br />";
								    $descripcion=$value;
								}
								

						
								$thumbID = get_post_thumbnail_id( get_queried_object_id() );
						

								?>
								<img class="mini" src="<?php echo wp_get_attachment_url($thumbID);?>">
								<h4><?php the_title(); ?></h4>
								<p class="justifice">
									<?php 

									echo $descripcion; ?>
									
								</p>
								
								<?php 
								foreach ($lista as $value) {
									echo '<div class="chip">';
									echo '  <i class="material-icons prefix">account_circle</i>';
								    echo $value['name'];
									echo '</div>';
								}
								echo '<h5 class="center"><a href="'.get_permalink().'">Link</a></h5> ';
								
								?>
							
						</div>

					



				<?php


				wp_reset_postdata();
			endwhile;
			echo '</div>'; // fila
			wp_reset_postdata();
		}



		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
