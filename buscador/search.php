<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Astrid
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php

		if($_GET['buscador'] === 'buscador'): ?>
			<div class="search-results-container">
				<?php
					if(!$_GET['filter']):
						?>
							<h1 class="u-margin-bottom-small custom-h1">Nenhum filtro selecionado!</h1>
						<?php
					elseif(!$_GET['search']):
						?>
							<h1 class="u-margin-bottom-small custom-h1">Campo de pesquisa não preenchido!</h1>
						<?php
					else:
						?>
							<h1 class="u-margin-bottom-small custom-h1">Resultados para <?php echo $_GET['filter'];?>: <?php echo $_GET['search'];?> </h1>

						<?php

							$host = "yourhost";
							$user = "youruser";
							$password = "yourpass";
							$database = "yourdb";

							// Create connection
							$portal_data_set = new wpdb($user, $password, $database, $host);

							try{
								$tags = array_values(array_filter(explode(' ', $_GET['search'])));

								$query = "";

								$index = 0;

								$column = "";

								if($_GET["filter"] === "assuntos"):
									$column = "file_keywords";
								elseif($_GET["filter"] === "fonte"): 
									$column = "file_source";
								endif;

								if(sizeof($tags) > 0):
									while($index < sizeof($tags)):
										if($index === 0):
											$query = "SELECT * FROM file_metadata WHERE ".$column." LIKE '%".$tags[$index]."%'";
										else:
											$query.= " OR ".$column." LIKE '%".$tags[$index]."%'";
										endif;

										$index++;
									endwhile;
								endif;

								$results = $portal_data_set->get_results($query);

								$index = 0;

								if($results && sizeof($results) > 0):
									while ($index < sizeof($results)):?>
										<div class="buscador__item-box">
											<div class="buscador__item-primary">
												<?php echo $results[$index]->file_name; ?>
											</div>
											<div class="buscador__item-secondary">
												Data de criação: <?php echo $results[$index]->file_issued; ?>
												/
												Data de modificação: <?php echo $results[$index]->file_modified; ?>
											</div>
											<div class="buscador__item-tertiary">
												<div class="buscador__item-tertiary--label">Link:</div>
												<a class="buscador__item-tertiary--text buscador__link" href="<?php echo $results[$index]->file_url; ?>"><?php echo $results[$index]->file_url; ?></a>
											</div>
											<div class="buscador__item-tertiary">
												<div class="buscador__item-tertiary--label">Fonte:</div>
												<div class="buscador__item-tertiary--text"><?php echo $results[$index]->file_source; ?></div>
											</div>
											<div class="buscador__item-tertiary">
												<div class="buscador__item-tertiary--label">Palavras-chave:</div>
												<div class="buscador__item-tertiary--text"><?php echo $results[$index]->file_keywords; ?></div>
											</div>
										</div>
										<?php
										$index++;
									endwhile;
								else:
									echo 'Nenhum resultado encontrado!';
								endif;
							}catch(Exception $e){
								echo 'Error'.$e->getMessage();
							}
					endif;
				?>
				
			</div>

		<?php
		else: 
			if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'astrid' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header><!-- .page-header -->
	
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
	
					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );
	
				endwhile;
	
				the_posts_navigation();
	
			else :
	
				get_template_part( 'template-parts/content', 'none' );
	
			endif;
		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
