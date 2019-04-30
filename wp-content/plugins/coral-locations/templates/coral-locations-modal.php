<?php
  /*
    'lity-hide' is required and is how the modal is recognized
    'coral__selector-modal' is also required

    Include a button with the class 'coral__confirm-location' to have a confirmation AJAX sent.
  */

  $locationDetails = coralLocation_selectedLocation();
  $locationSelectionPage = coralLocation_pageLink();
?>
<div id="coral-location-modal" class="card card--modal coral__selector-modal lity-hide">
  <div class="card__inner">
    <header class="card__header card__header--alt">
      <h3 class="card__title">Welcome to <?php bloginfo('site_name'); ?></h3>
    </header>
    <div class="card__content">

      <div class="coral__selector-modal-content">
        <p><?php echo apply_filters('coralLocations__selector-modal__message', "Your location is set to <strong>{$locationDetails->name}</strong>", $locationDetails); ?></p>
      </div>

      <footer class="coral__selector-modal-footer">
        <button class="coral__selector-close coral__confirm-location btn"><?php echo apply_filters('coralLocations__selector-modal__yes', "That's right!"); ?></button>
        <a class="btn btn--secondary" href="<?php echo $locationSelectionPage; ?>"><?php echo apply_filters('coralLocations__selector-modal__yes', "Nope, change my location!"); ?></a>
      </footer>

    </div>
  </div>
</div>
