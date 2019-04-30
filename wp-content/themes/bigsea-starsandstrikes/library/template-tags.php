<?php

function bsd_posted_on($post = null) {
    // If $post not sent, we are assuming it is in the loop
    if ($post) {
        $publish_date = new DateTime($post->post_date);
        $modified_date = new DateTime($post->post_modified);
        $permalink = $post->link;
        $author_link = get_author_posts_url($post->post_author);
        $author_name = get_the_author_meta('display_name', $post->post_author);
    }
    else {
        $publish_date = new DateTime(get_the_date());
        $modified_date = new DateTime(get_the_modified_date());
        $permalink = get_permalink();
        $author_link = get_author_posts_url(get_the_author_meta( 'ID'));
        $author_name = get_the_author_meta('display_name');
    }

    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    $time_string = sprintf( $time_string,
        esc_attr($publish_date->format('c')),
        esc_html($publish_date->format('F j, Y')),
        esc_attr($modified_date->format('c')),
        esc_html($modified_date->format('F j, Y'))
    );

    $posted_on = sprintf(
        esc_html_x( 'Posted on %s', 'post date', 'big-sea' ),
        '<a href="' . esc_url( $permalink ) . '" rel="bookmark">' . $time_string . '</a>'
    );

    // $byline = sprintf(
    //     esc_html_x( 'by %s', 'post author', 'big-sea' ),
    //     '<span class="author vcard"><a class="url fn n" href="' . esc_url( $author_link ) . '">' . esc_html( $author_name ) . '</a></span>'
    // );

    // echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
    echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

}

function getImage($imageObject, $size='thumbnail')
{
    if (isset($imageObject['sizes'][$size])) {
        return $imageObject['sizes'][$size];
    }

    return $imageObject['sizes']['full'];
}

add_filter('phone_href', 'phone_href');
function phone_href($phone)
{
    return preg_replace("/[^\d]*/", "", $phone);
}

add_filter('post_slugs_json', 'postsToSlugsJSON');
function postsToSlugsJSON($postsArray)
{
    $response = [];

    if (is_array($postsArray)) {
        foreach ($postsArray as $post) {
            if (get_field('icon', $post->ID)) {
                $response[] = trim(get_field('icon', $post->ID));
            }
        }
    }

    return json_encode($response);
}

function googleMapsLink($addresses)
{
    if (!is_array($addresses)) return;

    $base = "https://www.google.com/maps/place/";
    foreach ($addresses as $address) {
        $parsedAddress = "Stars & Strikes, {$address['street']}, {$address['city']}, {$address['state']} {$address['zip_code']}";

        return $base . urlencode($parsedAddress);
    }
}

function bsdchild_getAllLocations()
{
    return Timber::get_posts(coralLocation_allLocations());
}

function bsdchild_getAllAttractions()
{
    return Timber::get_posts(array(
        'posts_per_page' => -1,
        'post_type' => 'attractions',
        'orderby' => 'menu_order, title',
        'order' => 'ASC',
    ));
}

function setPageFullWidth()
{
    add_filter( 'big-sea-body_class-has-sidebar', '__return_false');
    add_filter( 'body_class', 'bsdchild_fullWidthClass' );
}
function bsdchild_fullWidthClass( $classes )
{
    $classes[] = 'page-template-page-full';

    return $classes;
}

function getDayFromInt($day)
{
    switch ($day) {
        case 0:
            return "Sunday";
            break;
        case 1:
            return "Monday";
            break;
        case 2:
            return "Tuesday";
            break;
        case 3:
            return "Wednesday";
            break;
        case 4:
            return "Thursday";
            break;
        case 5:
            return "Friday";
            break;
        case 6:
            return "Saturday";
            break;
    }

    return 'All Week';
}