(function($) {
    $featureButtons = $('.location-features__feature-buttons');

    if (typeof $featureButtons.coralFilter == 'function') {
        $('.location-features__feature-buttons').coralFilter();
    }
})(jQuery);