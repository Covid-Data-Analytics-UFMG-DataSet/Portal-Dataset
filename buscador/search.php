<?php
	include 'connection.php';

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

		$filter = $_GET['filter'];
		$serch = $_GET['search'];

		$select = null;

		if($filter === 'tipo'):
			$select = $_GET['tipo'];
		elseif($filter === 'fonte'):
			$select = $_GET['fonte'];
		elseif($filter === 'tema'):
			$select = $_GET['tema'];
		endif;

		if($_GET['buscador'] === 'buscador'): ?>
			<div class="search-results-container">
				<?php
					if((!$filter || !$select) && !$search):
						?>
							<h1 class="u-margin-bottom-small custom-h1">Nenhum campo preenchido!</h1>
						<?php
					else:
						?>
							<h1>Resultados</h1>
						<?php

						try{
							$tags = array_values(array_filter(explode(' ', $search)));

							$query = "SELECT * FROM file_metadata WHERE ";

							$index = 0;

							$column = "";

							if($_GET["filter"] === "tipo"):
								$column = "file_type";
							elseif($_GET["filter"] === "fonte"): 
								$column = "file_source";
							elseif($_GET["filter"] === "tema"): 
								$column = "file_theme";
							endif;

							if(sizeof($tags) > 0):
								while($index < sizeof($tags)):
									if($index === 0):
										if(sizeof($tags) === 1):
											$query .= "(file_keywords LIKE '%".$tags[$index]."%' OR file_name LIKE '%".$tags[$index]."%')";
										else:
											$query .= "(file_keywords LIKE '%".$tags[$index]."%' OR file_name LIKE '%".$tags[$index]."%'";
										endif;
									elseif($index === sizeof($tags) - 1):
										$query.= " OR file_keywords LIKE '%".$tags[$index]."%' OR file_name LIKE '%".$tags[$index]."%')";
									else:
										$query.= " OR file_keywords LIKE '%".$tags[$index]."%' OR file_name LIKE '%".$tags[$index]."%'";
									endif;

									$index++;
								endwhile;

								if($filter && $select):
									$query .= " AND ".$column." = '".$select."'";
								endif;
							else:
								if($filter && $select):
									$query .= "".$column." = '".$select."'";
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
											<div class="buscador__item-tertiary">
												<div class="buscador__item-tertiary--label">Descrição:</div>
												<div class="buscador__item-tertiary--text"><?php echo $results[$index]->file_description; ?></div>
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
