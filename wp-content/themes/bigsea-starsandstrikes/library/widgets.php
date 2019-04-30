<?php

require_once(__DIR__ . '/widgets/attractions.php');
require_once(__DIR__ . '/widgets/buttons.php');
require_once(__DIR__ . '/widgets/button-call.php');
require_once(__DIR__ . '/widgets/button-facebook.php');
require_once(__DIR__ . '/widgets/button-tripadvisor.php');
require_once(__DIR__ . '/widgets/location-notice.php');

add_action( 'widgets_init', 'bsdChild_registerWidgets' );
function bsdChild_registerWidgets() {
	register_widget( 'AttractionsWidget' );
	register_widget( 'ButtonsWidget' );
	register_widget( 'CallUsButtonWidget' );
	register_widget( 'FacebookButtonWidget' );
	register_widget( 'TripAdvisorButtonWidget' );
	register_widget( 'LocationNoticeWidget' );
}