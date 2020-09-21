<?php
/**
 * Template Name : Buscador
 * Template to search for files
 */

require_once('wp-load.php');

get_header(); ?>

        <div class="form-container">
            <h1 class="u-margin-bottom-samll" >Buscador</h1>
            <form class="custom-form" method="get" action="<?php print site_url(); ?>">
                <input type="hidden" name="s">
                <input type="text" name="tags" placeholder='Palavras-chave'>
                <input type="text" name="fonte" placeholder='Fonte'>
                <input type="hidden" value="buscador" name="buscador">
                <input type="submit" value="Search">
            </form>
        </div>

<?php get_footer(); ?>