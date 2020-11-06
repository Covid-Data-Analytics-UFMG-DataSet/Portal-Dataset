<?php
/**
 * Template Name : Buscador
 * Template to search for files
 */

require_once('wp-load.php');

include './wp-content/themes/astrid/connection.php';

get_header(); ?>

            <div class="custom-container">
                <form class="custom-form" method="get" action="<?php print site_url(); ?>">
                    <div class="custom-form__header">BUSCA</div>
                    <div class="custom-form__filters-box">
                        <div class="custom-form__filters-header">Filtros:</div>
                        <input autocomplete='off' value="tipo" id="type-radio" type="checkbox" class="custom-form__filter-radio">
                        <label for="type-radio" class="custom-form__filter">Tipo</label>
                        <input autocomplete='off' value="fonte" id="source-radio" type="checkbox" class="custom-form__filter-radio">
                        <label for="source-radio" class="custom-form__filter">Fonte</label>
                        <input autocomplete='off' value="tema" id="theme-radio" type="checkbox" class="custom-form__filter-radio">
                        <label for="theme-radio" class="custom-form__filter">Tema</label>
                        <input id="custom-form__filter-value" type="hidden" name="filter">
                    </div>
                    <input type="hidden" name="s">
                    <div class="custom-form__input-box">
                        <input class="custom-form__input" type="text" name="search" 
                            placeholder='Insira o termo de busca'
                        >
                        <select class="custom-form__select" name="tipo" id="custom-select-type">
                            <option class="custom-form__select-disabled" value="" selected>Tipo</option>
                            <?php

                                $query = "SELECT DISTINCT file_type FROM file_metadata";

                                $results = $portal_data_set->get_results($query);

                                $index = 0;

                                while ($index < sizeof($results)):?>
                                    <option value="<?php echo $results[$index]->file_type; ?>">
                                        <?php echo $results[$index]->file_type; ?>
                                    </option>
                                    <?php
                                    $index++;
                                endwhile;
                            ?>
                        </select>
                        <select class="custom-form__select" name="fonte" id="custom-select-source">
                            <option class="custom-form__select-disabled" value="" selected>Fonte</option>
                            <?php

                                $query = "SELECT DISTINCT file_source FROM file_metadata";

                                $results = $portal_data_set->get_results($query);

                                $index = 0;

                                while ($index < sizeof($results)):?>
                                    <option value="<?php echo $results[$index]->file_source; ?>">
                                        <?php echo $results[$index]->file_source; ?>
                                    </option>
                                    <?php
                                    $index++;
                                endwhile;
                            ?>
                        </select>
                        <select class="custom-form__select" name="tema" id="custom-select-theme">
                            <option class="custom-form__select-disabled" value="" selected>Tema</option>
                            <?php

                                $query = "SELECT DISTINCT file_theme FROM file_metadata";

                                $results = $portal_data_set->get_results($query);

                                $index = 0;

                                while ($index < sizeof($results)):?>
                                    <option value="<?php echo $results[$index]->file_theme; ?>">
                                        <?php echo $results[$index]->file_theme; ?>
                                    </option>
                                    <?php
                                    $index++;
                                endwhile;
                            ?>
                        </select>
                        <input class="custom-form__button" type="submit" value="Search">
                    </div>
                    <input type="hidden" value="buscador" name="buscador">
                </form>
            </div>

<?php get_footer(); ?>