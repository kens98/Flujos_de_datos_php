<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ShUrRe
 */
?>

<article id="post-">
	

	
		


								 <?php
								
								//echo " <br/>extrae las categoriass ";
								 
								$id=get_the_ID();
								 $terms = get_the_terms( $id, 'categoria' );
								 echo '<div class="col s4 4">';
								$etiquetas=array();
								// extrae las categorias personalizadas del post
								

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
								

						
								$thumbID = get_post_thumbnail_id( $id );
						

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


								echo '</div>';
?>
										
							
						

	

	
</article><!-- #post-<?php the_ID(); ?> -->
