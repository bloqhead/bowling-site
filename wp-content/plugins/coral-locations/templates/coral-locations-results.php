<?php 
    global $coralLocationsResults; 
    global $coralLocationsRedirectURL;

    $redirect = urlencode($coralLocationsRedirectURL);
?>
<div class="coral-locations-results">
<?php if (count($coralLocationsResults) > 0) : ?>
    <h3>Matches</h3>
    <div class="coral-locations-list">
        <?php foreach ($coralLocationsResults as $location) : ?>
            <article>
                <h3><?= $location->post_title; ?></h3>

                <?php if (isset($location->distance)) : ?>
                    <p><?= number_format($location->distance, 2); ?> miles away</p>
                <?php endif; ?>

                <a href="<?= site_url(); ?>?cl-location=<?= $location->ID; ?>&redirect=<?= $redirect?>">Select this Location</a>
            </article>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <h3>Please Search Above (@todo, display by default?)</h3>
<?php endif; ?>
</div>