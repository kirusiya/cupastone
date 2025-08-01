<?php
/**
 * Bloque Post a 2 estilos
 *
 * @package materialwp
 */

?>

<div class="bloque bloque-posts-2-estilos">
	<div class="container-custom">
		<div class="container-posts-2-estilos">

			<!-- Bloque principal de todos los artículos -->
			<div class="grupo-1">
				<div class="inner">					
					<div class="sup">						
						<h2 class="titulo-cat">
							<?php echo esc_html__( 'Últimas noticias', 'materialwp' ); ?>
						</h2>
						<div class="mas-cat fake-a">
							<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ); ?>">
								<?php echo esc_html__( 'Ver todo', 'materialwp' ); ?>
							</a>
						</div>
					</div>
					<div class="inf grupo-impar">
						<div class="container-posts">

							<?php
							$my_posts = new WP_Query(
								array(
									'post_type'      => 'post',
									'post_status'    => 'publish',
									'posts_per_page' => 3,
									'orderby'        => 'date',
									'order'          => 'DESC',
								)
							);

							if ( $my_posts->have_posts() ) :
								$n = 1;
								while ( $my_posts->have_posts() ) :
									$my_posts->the_post();
									$enlace_post     = get_permalink( get_the_ID() );
									$imagen_post     = get_the_post_thumbnail_url( get_the_ID(), 'full' );
									$fecha_post      = strtoupper( get_the_date( 'd M Y', get_the_ID() ) );
									$categorias_post = '';
									$cats            = get_the_terms( get_the_ID(), 'category' );

									if ( $cats ) {
										foreach ( $cats as $_cat ) {
											$categorias_post .= '<a href="' . get_category_link( $_cat ) . '">' . $_cat->name . '</a>, ';
										}
									}
									$categorias_post = substr( $categorias_post, 0, -2 );
									$titulo_post     = get_the_title();

									if ( 1 === $n ) {
										echo '<div class="row">';
										echo '	<div class="col-md-8">';
									} elseif ( 2 === $n ) {
										echo '	<div class="col-md-4">';
									}
									?>

									<div class="mypost-<?php echo esc_html( $n ); ?> fake-a-last">
										<div class="image-container" style="background-image:url(<?php echo esc_url( $imagen_post ); ?>);">
											<div class="card-info">									
												<div class="fecha">
													<?php echo esc_html( $fecha_post ); ?>
												</div>									
												<div class="categorias">
													<?php echo $categorias_post; //phpcs:ignore ?>
												</div>									
												<div class="titulo">
													<a href="<?php echo esc_url( $enlace_post ); ?>">
														<?php echo esc_html( $titulo_post ); ?>
													</a>
												</div>
											</div>
										</div>								
									</div>

									<?php
									if ( 1 === $n ) {
										echo '	</div> <!-- .col-md-8 -->';
									} elseif ( 3 === $n ) {
										echo '	</div> <!-- .col-md-4 -->';
										echo '</div> <!-- .row -->';
									}
									$n++;
								endwhile;
								wp_reset_postdata();
							endif;
							?>

						</div>
					</div>
				</div>
			</div>

			<?php
			// Bloques de categorías.
			$categories = get_field( 'categoria_post' );
			$ncurrent   = 2;
			foreach ( $categories as $id_cat ) :
				$category_link = get_category_link( $id_cat );
				$category_name = get_cat_name( $id_cat );
				$class_group   = ( 0 === $ncurrent % 2 ) ? 'grupo-par' : 'grupo-impar';
				?>

				<div class="grupo-<?php echo esc_html( $ncurrent ); ?>">
					<div class="inner">					
						<div class="sup">						
							<h2 class="titulo-cat">
								<?php echo esc_html( $category_name ); ?>
							</h2>
							<div class="mas-cat fake-a">
								<a href="<?php echo esc_url( $category_link ); ?>">
									<?php echo esc_html__( 'Ver todo', 'materialwp' ); ?>
								</a>
							</div>
						</div>
						<div class="inf <?php echo esc_html( $class_group ); ?>">
							<div class="container-posts">

								<?php
								$my_posts = new WP_Query(
									array(
										'post_type'      => 'post',
										'post_status'    => 'publish',
										'posts_per_page' => 3,
										'cat'            => $id_cat,
										'orderby'        => 'date',
										'order'          => 'DESC',
									)
								);

								if ( $my_posts->have_posts() ) :
									$n = 1;
									while ( $my_posts->have_posts() ) :
										$my_posts->the_post();
										$enlace_post     = get_permalink( get_the_ID() );
										$imagen_post     = get_the_post_thumbnail_url( get_the_ID(), 'full' );
										$fecha_post      = strtoupper( get_the_date( 'd M Y', get_the_ID() ) );
										$categorias_post = '';
										$cats            = get_the_terms( get_the_ID(), 'category' );

										if ( $cats ) {
											foreach ( $cats as $_cat ) {
												$categorias_post .= '<a href="' . get_category_link( $_cat ) . '">' . $_cat->name . '</a>, ';
											}
										}
										$categorias_post = substr( $categorias_post, 0, -2 );
										$titulo_post     = get_the_title();

										if ( 'grupo-impar' === $class_group && 1 === $n ) {
											echo '<div class="row">';
											echo '	<div class="col-md-8">';
										} elseif ( 'grupo-impar' === $class_group && 2 === $n ) {
											echo '	<div class="col-md-4">';
										}
										?>

										<div class="mypost-<?php echo esc_html( $n ); ?> fake-a-last">
											<div class="image-container" style="background-image:url(<?php echo esc_url( $imagen_post ); ?>);">
												<div class="card-info">									
													<div class="fecha">
														<?php echo esc_html( $fecha_post ); ?>
													</div>									
													<div class="categorias">
														<?php echo $categorias_post; //phpcs:ignore ?>
													</div>									
													<div class="titulo">
														<a href="<?php echo esc_url( $enlace_post ); ?>">
															<?php echo esc_html( $titulo_post ); ?>
														</a>
													</div>
												</div>
											</div>								
										</div>

										<?php
										if ( 'grupo-impar' === $class_group && 1 === $n ) {
											echo '	</div> <!-- .col-md-8 -->';
										} elseif ( 'grupo-impar' === $class_group && 3 === $n ) {
											echo '	</div> <!-- .col-md-4 -->';
											echo '</div> <!-- .row -->';
										}
										$n++;
									endwhile;
									wp_reset_postdata();
								endif;
								?>

							</div>
						</div>
					</div>
				</div>

				<?php
				$ncurrent++;
			endforeach;
			?>

		</div>
	</div>	
</div>
