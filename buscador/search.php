<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package NOME_DO_SEU_TEMA
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php

		if($_GET['buscador'] === 'buscador'): ?>
			<div class="search-results-container">
				<h1 class="u-margin-bottom-small custom-h1">Resultados para palavras-chave: <?php echo $_GET['tags'];?> e fonte: <?php echo $_GET['fonte'];?></h1>
				
				<?php 

					$host = "yourhost";
					$user = "youruser";
					$password = "yourpass";
					$database = "yourdb";

					// Create connection
					$portal_data_set = new wpdb($user, $password, $database, $host);

					if($_GET['fonte'] || $_GET['tags']):
						try{
							$tags = array_values(array_filter(explode(' ', $_GET['tags'])));

							$query = "";

							if($_GET['fonte']):
								$query = "SELECT * FROM file_metadata WHERE
								file_source LIKE '%".$_GET['fonte']."%'";
							endif;

							$index = 0;

							if(sizeof($tags) > 0):
								if(sizeof($tags) > 1):
									while($index < sizeof($tags)):
										if($index === 0 || $index === sizeof($tags)-1):
											if($index === 0):
												if($query):
													$query.= " AND (file_keywords LIKE '%".$tags[$index]."%'";
												else:
													$query = "SELECT * FROM file_metadata WHERE
													(file_keywords LIKE '%".$tags[$index]."%'";
												endif;
											endif;
			
											if($index === sizeof($tags)-1):
												$query.= " OR file_keywords LIKE '%".$tags[$index]."%')";
											endif;
										else :
											$query.= " OR file_keywords LIKE '%".$tags[$index]."%'";
										endif;
		
										$index++;
									endwhile;
								else:
									if($query):
										$query.= " AND file_keywords LIKE '%".$tags[$index]."%'";
									else:
										$query = "SELECT * FROM file_metadata WHERE
										file_keywords LIKE '%".$tags[$index]."%'";
									endif;
								endif;
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
											File created at: <?php echo $results[$index]->file_issued; ?>
											/
											File updated at: <?php echo $results[$index]->file_modified; ?>
										</div>
										<div class="buscador__item-tertiary">
											Link:&nbsp;<a href=<?php echo $results[$index]->file_url; ?>><?php echo $results[$index]->file_url; ?></a>
										</div>
										<div class="buscador__item-tertiary">
											Fonte:&nbsp;<?php echo $results[$index]->file_source; ?>
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
					else :
						echo "Nenhum campo preenchido!";
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
