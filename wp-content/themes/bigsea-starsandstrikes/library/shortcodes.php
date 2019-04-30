<?php

    add_shortcode('icon-chefs-choice', 'renderShortcode_iconChefsChoice');
    function renderShortcode_iconChefsChoice() {
        return '<i class="ss-icon-chefs-choice"></i>';
    }

    add_shortcode('icon-gluten-free', 'renderShortcode_iconGlutenFree');
    function renderShortcode_iconGlutenFree() {
        return '<i class="ss-icon-gluten-free"></i>';
    }

    add_shortcode('icon-health-advisory', 'renderShortcode_iconHealthAdvisory');
    function renderShortcode_iconHealthAdvisory() {
        return '<i class="ss-icon-health-advisory"></i>';
    }

    add_shortcode('icon-healthy-choice', 'renderShortcode_iconHealthyChoice');
    function renderShortcode_iconHealthyChoice() {
        return '<i class="ss-icon-healthy-choice"></i>';
    }
    
    add_shortcode('icon-hot-spicy', 'renderShortcode_iconHotSpicy');
    function renderShortcode_iconHotSpicy() {
        return '<i class="ss-icon-hot-spicy"></i>';
    }

    add_shortcode('phone_number', 'renderShortcode_phoneNumber');
    function renderShortcode_phoneNumber() {
        if (is_admin()) return;

        global $post;

		if ($post->post_type == 'locations') {
			$location = CoralLocationModel::fromWPPost(get_post($post->ID));
		}
		else {
			$location = coralLocation_selectedLocation();
		}

		$phoneNumber = get_field('phone_number', $location->ID);
        $parsedPhoneNumber = phone_href($phoneNumber);
        
        return "<a href=\"tel:{$parsedPhoneNumber}\" title=\"Phone Number for {$location->name}\">{$phoneNumber}</a>";
    }

    add_shortcode('button_cta', 'renderShortcode_buttonCTA');
    function renderShortcode_buttonCTA($atts, $data = null) {
        $link = (isset($atts['link']) ? $atts['link'] : '#');
        $target = (isset($atts['target']) ? $atts['target'] : '_self');
        $classes = (isset($atts['classes']) ? $atts['classes'] : 'btn--secondary');
        $text = ($data ? $data : 'Click Here');

        return '
            <a href="'.$link.'" class="btn '.$classes.'" target="'.$target.'">'.$text.'</a>
        ';
    }

    add_shortcode('hubspot_cta', 'renderShortcode_hubspotCTA');
    function renderShortcode_hubspotCTA($atts) {
        $hubID = (isset($atts['hub']) ? $atts['hub'] : '2812034');
        $formID = (isset($atts['id']) ? $atts['id'] : null);

        if (!$formID) return '';

        return '
            <!--HubSpot Call-to-Action Code -->
            <span class="hs-cta-wrapper" id="hs-cta-wrapper-'.$formID.'">
                <span class="hs-cta-node hs-cta-'.$formID.'" id="hs-cta-'.$formID.'">
                    <!--[if lte IE 8]><div id="hs-cta-ie-element"></div><![endif]-->
                    <a href="https://cta-redirect.hubspot.com/cta/redirect/'.$hubID.'/'.$formID.'"  target="_blank" >
                    <img class="hs-cta-img" id="hs-cta-img-'.$formID.'" style="border-width:0px;" height="180" width="660" src="https://no-cache.hubspot.com/cta/default/'.$hubID.'/'.$formID.'.png"  alt="Printable Birthday Party Invitations Call to Action"/></a>
                </span>
                <script charset="utf-8" src="https://js.hscta.net/cta/current.js"></script>
                <script type="text/javascript">
                    hbspt.cta.load('.$hubID.', "'.$formID.'", {});
                </script>
            </span>
            <!-- end HubSpot Call-to-Action Code -->
        ';
    }