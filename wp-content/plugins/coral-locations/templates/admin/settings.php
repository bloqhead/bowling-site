<?php
    $instance = coralLocations();
?>
<div class="wrap">
    <h1>Coral Locations</h1>

    <form method="post" action="options.php">
        <?php 
            settings_fields( $instance::PLUGIN_PREFIX );
            do_settings_sections( $instance::PLUGIN_PREFIX ); 
        
            $selectedLocation = $instance::getPageID();
            $selectedLocationKey = $instance::getPageOptionKey();
        ?>

        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row"><label for="<?= $selectedLocationKey; ?>">Page for Location Selector</label></th>
                    <td>
                        <select name="<?= $selectedLocationKey; ?>" id="<?= $selectedLocationKey; ?>">
                            <?php
                                $args = [
                                    'posts_per_page' => -1,
                                    'post_type' => 'page',
                                    'orderby'   => 'post_title',
                                    'order'     => 'ASC',
                                ];
                                $pages = new WP_Query($args);
                                if ($pages->have_posts()) : while ($pages->have_posts()) : $pages->the_post();
                                $selected = "";
                                if (get_the_ID() == $selectedLocation) {
                                    $selected = "selected";
                                }
                            ?>
                                <option value="<?php the_ID(); ?>" <?= $selected; ?>><?php the_title(); ?></option>
                            <?php endwhile; endif; ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" ><?php submit_button() ?></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>