<?php
/**
 * Template Name : Buscador
 * Template to search for files
 */

require_once('wp-load.php');

get_header(); ?>

            <div class="custom-container">
                <form class="custom-form" method="get" action="<?php print site_url(); ?>">
                    <div class="custom-form__header">BUSCA</div>
                    <div class="custom-form__filters-box">
                        <div class="custom-form__filters-header">Filtros:</div>
                        <input value="assuntos" name="filter" id="keywords-radio" type="radio" class="custom-form__filter-radio">
                        <label for="keywords-radio" class="custom-form__filter">Assuntos</label>
                        <input value="fonte" name="filter" id="source-radio" type="radio" class="custom-form__filter-radio">
                        <label for="source-radio" class="custom-form__filter">Fonte</label>
                    </div>
                    <input type="hidden" name="s">
                    <div class="custom-form__input-box">
                        <input class="custom-form__input" type="text" name="search" 
                            placeholder='Insira o termo de busca'
                        >
                        <input class="custom-form__button" type="submit" value="Search">
                    </div>
                    <input type="hidden" value="buscador" name="buscador">
                </form>
            </div>

<?php get_footer(); ?>