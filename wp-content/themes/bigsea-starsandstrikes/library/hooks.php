<?php

if (!is_admin()) {
    // setup scripts and styles
    add_action('wp_enqueue_scripts', 'bsdchild_enqueue');
    add_action('pre_get_posts', 'bsdchild_location_showAll');
} else {
    // Any Admin-specific hooks
}

function bsdchild_location_showAll($query) {
    if (!$query->is_main_query()) return;
    if (!$query->is_archive()) return;
    if (!$query->is_post_type_archive('locations')) return;

    $query->set('posts_per_page', -1);
    $query->set('orderby', 'post_title');
    $query->set('order', 'ASC');
}

// setup widgets
add_action( 'widgets_init', 'bsdchild_widgets_init', 9999 );
function bsdchild_widgets_init() {
    register_nav_menu( 'footer_buttons', 'Footer Buttons' );

	// events *
	register_sidebar( array(
		'name' => esc_html__( 'Events Page Sidebar', 'big-sea' ),
		'id' => 'events-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'big-sea' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
    ));

    // locations *
	register_sidebar( array(
		'name' => esc_html__( 'Locations Page Sidebar', 'big-sea' ),
		'id' => 'locations-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'big-sea' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
    ));

    // play *
	register_sidebar( array(
		'name' => esc_html__( 'Play Page Sidebar', 'big-sea' ),
		'id' => 'play-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'big-sea' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
    ));

    // promotions & specials *
	register_sidebar( array(
		'name' => esc_html__( 'Specials & Promotions Sidebar', 'big-sea' ),
		'id' => 'promotions-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'big-sea' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
    ));

    // adult birthdays *
	// register_sidebar( array(
	// 	'name' => esc_html__( 'Adult Birthday Page Sidebar', 'big-sea' ),
	// 	'id' => 'adult-birthdays-sidebar',
	// 	'description'   => esc_html__( 'Add widgets here.', 'big-sea' ),
	// 	'before_widget' => '<section id="%1$s" class="widget %2$s">',
	// 	'after_widget'  => '</section>',
	// 	'before_title'  => '<h3 class="widget-title">',
	// 	'after_title'   => '</h3>',
	// ));
}

add_filter('render_icons', 'do_shortcode');

add_action( 'after_setup_theme', 'bsdchild_image_sizes' );
function bsdchild_image_sizes() {

    // used in global page mastheads
    add_image_size( 'page-masthead', 2880, 800, true );

    // used in all of the small cards that contain images (see homepage)
    add_image_size( 'card-image', 348, 261, true );
    add_image_size( 'card-image-2x', 695, 522, true );

    // used as hero background images (general heroes that are used globally)
    add_image_size( 'hero-image', 1100, 427, true );
    add_image_size( 'hero-image-2x', 2200, 854, true );

    // used in cards that act as CTAs and contain a title, summary and link (see Location)
    add_image_size( 'card-cta-image', 532, 279, true );
    add_image_size( 'card-cta-image-2x', 1064, 558, true );

    // location feature bar images (see the long horizontal cards on Location)
    add_image_size( 'feature-bar-image', 345, 215, true );
    add_image_size( 'feature-bar-image-2x', 690, 430, true );

    // basic square images
    add_image_size( 'basic-square', 400, 400, true );
    add_image_size( 'basic-square-2x', 800, 800, true );

    add_image_size( 'basic-post-image', 174, 249 );
    add_image_size( 'basic-post-image-2x', 348, 498 );

    // Restaurant Logo
    add_image_size( 'thumbnail-nocrop', 250, 250, false);
}

function bsdchild_enqueue() {
    if (!is_admin()) {
        wp_enqueue_script('jquery');
    }
    // Google Fonts
    wp_enqueue_style( 'big-sea-child-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700|Zilla+Slab:400,700', array(), 'all' );

    // styles
    wp_enqueue_style( 'big-sea-child-style', get_stylesheet_directory_uri() . '/style.css', array('big-sea-style'), 'all' );

    // scripts
	wp_enqueue_script( 'big-sea-child-js', get_stylesheet_directory_uri() . '/assets/js/build.js', array( 'jquery' ), '', true );

    if (is_front_page()) {
        wp_enqueue_script('attraction-filters', get_stylesheet_directory_uri() . '/assets/js/front-page.js', array('big-sea-child-js'), '1.0', true);
    }
}

add_filter('timber_context', 'bsdchild_timberContext', 20, 1);
function bsdchild_timberContext($context)
{
    if (!function_exists('coralLocations')) return $context;

    $selectedLocation = coralLocation_selectedLocation();
    if (!$selectedLocation) return null;

    $context['footer_buttons'] = new TimberMenu( 'footer_buttons' );

    $context['link_facebook'] = get_field('link_facebook', 'options');
    $context['link_twitter'] = get_field('link_twitter', 'options');
    $context['link_instagram'] = get_field('link_instagram', 'options');

    // Global Notices
    $context['notice_blackouts'] = get_field('notice_blackouts', 'options');

    $context['defaultMasthead'] = new TimberImage(get_field('masthead', 'options'));

    $context['selectedLocation'] = new TimberPost($selectedLocation->object);
    $context['locationSelectorPage'] = coralLocation_pageLink();
    $context['selectedLocation_method'] = coralLocation_selectionMethod();

    $context['defaultPhone'] = get_field('phone_number', $selectedLocation->ID);

    $context['birthdayPackageAnchor'] = get_permalink(6) . '#birthday-package-container-anchor';

    $context['locations'] = bsdchild_getAllLocations();

    return $context;
}

/*
 * Favicons and app icons
 */
add_action( 'wp_head', 'bsd_icons' );
function bsd_icons() {
    $iconPath = get_stylesheet_directory_uri() . "/assets/img/favicons";
    $msColor = "#2692C9";
    ?>
    <!-- Apple touch icons -->
    <link rel="apple-touch-icon" sizes="57x57" href="<?= $iconPath ?>/app-icon@57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= $iconPath ?>/app-icon@60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= $iconPath ?>/app-icon@72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= $iconPath ?>/app-icon@76x76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= $iconPath ?>/app-icon@120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= $iconPath ?>/app-icon@152x152.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= $iconPath ?>/app-icon@167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $iconPath ?>/app-icon@180x180.png">
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="<?= $iconPath ?>/favicon.png">
    <!-- MS application icon and theme color -->
    <meta name="msapplication-TileColor" content="<?= $msColor ?>">
    <meta name="msapplication-TileImage" content="<?= $iconPath ?>/ms-icon-144x144.png">
    <meta name="theme-color" content="<?= $msColor ?>">
<?php }

/**
 * Filters the next, previous and submit buttons.
 * Replaces the forms <input> buttons with <button> while maintaining attributes from original <input>.
 *
 * @param string $button Contains the <input> tag to be filtered.
 * @param object $form Contains all the properties of the current form.
 *
 * @return string The filtered button.
 */
add_filter( 'gform_next_button', 'input_to_button', 10, 2 );
add_filter( 'gform_previous_button', 'input_to_button', 10, 2 );
add_filter( 'gform_submit_button', 'input_to_button', 10, 2 );
function input_to_button( $button, $form ) {
    $dom = new DOMDocument();
    $dom->loadHTML( $button );
    $input = $dom->getElementsByTagName( 'input' )->item(0);
    $new_button = $dom->createElement( 'button' );
    $new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
    $input->removeAttribute( 'value' );
    foreach( $input->attributes as $attribute ) {
        $new_button->setAttribute( $attribute->name, $attribute->value );
    }
    $input->parentNode->replaceChild( $new_button, $input );

    return $dom->saveHtml( $new_button );
}


/**
 * Related Posts
 *
 * This relies on the Coral Related Posts plugin
 */
function big_sea_related_posts() {
    
    /** bootstrapping... */
    wp_reset_query();

    /** prepare the data */
    global $post;
    $cats = get_the_category( $post->ID );
    $args = array(
        'posts_per_page' => 3,
        'post_type' => get_post_type( $post->ID ),
        'cat' => $cats[0]->term_id,
        'taxonomy' => 'category',
        'post__not_in' => array( $post->ID )
    );
    $relatedPosts = new WP_Query( $args );

    if ( $relatedPosts->have_posts() ) : ?>
    <section class="media related-posts">
        <div class="media__inner">
            <div class="media__content">

                <header class="media__header media__header--fancy">
                    <h2>You may also like these posts</h2>
                </header> <!-- .media__header -->

                <div class="grid">
                <?php while ( $relatedPosts->have_posts() ) : $relatedPosts->the_post() ?>
                <?php
                /** setup the thumbnail */
                $featuredImage = bsd_getImage( $post->_thumbnail_id, 'basic-square-2x' );
                ?>
                    <div class="grid__col-4">
                        <div class="card card--media">
                            <div class="card__inner">
                                <div class="card__content">
                                    <div class="card__faux-image" style="background-image:url('<?php echo $featuredImage; ?>');">
                                        <img src="<?php echo $featuredImage; ?>">
                                    </div>
                                </div>
                                <footer class="card__footer">
                                    <h3 class="card__title"><?php the_title(); ?></h3>
                                        <a href="<?php the_permalink(); ?>">
                                            Learn More <i class="fas fa-arrow-right"></i>
                                        </a>
                                </footer>
                            </div>
                        </div>
                    </div> <!-- .grid__col-4 -->
                <?php endwhile; ?>
            </div> <!-- .grid -->
        </div> <!-- .media__content -->
    </div>
    </section>
    <?php endif;
}