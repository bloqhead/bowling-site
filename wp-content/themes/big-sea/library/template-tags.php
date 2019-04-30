<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Big_Sea
 */


/**
 *	Returns HTML friendly phone number for 'tel:'
 */
if ( ! function_exists( 'html_friendly_phone' ) ) :
function html_friendly_phone ($number = '') {
	return 'tel:' . preg_replace("/[^0-9,]/", "", $number);
}
endif;

/**
 * Expects an array, and checks to make sure a key exists before returning. Good for twig.
 */
if ( ! function_exists( 'bsd_get' ) ) :
function bsd_get(array $table, $field, $default = '')
{
	if (isset($table[$field])) {
		return $table[$field];
	}

	return $default;
}
endif;

if ( ! function_exists( 'bsd_getImage' ) ) :
function bsd_getImage($image, $size = 'medium', $default = null)
{
	if (!$default) {
        $defaultObject = new TimberImage(get_field('masthead', 'options'));
        $default = $defaultObject;
    }

    if (!$image) {
        return $default->src($size);
	}
	
    if (!is_a($image, 'TimberImage')) {
        $image = new TimberImage($image);
	}

    return $image->src($size);
}
endif;

if ( ! function_exists( 'bsd_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
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

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'big-sea' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( $author_link ) . '">' . esc_html( $author_name ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

if ( ! function_exists( 'bsd_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function bsd_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'big-sea' ) );
		if ( $categories_list && bsd_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'big-sea' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'big-sea' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'big-sea' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'big-sea' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'big-sea' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function bsd_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'bsd_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'bsd_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so bsd_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so bsd_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in bsd_categorized_blog.
 */
function bsd_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'bsd_categories' );
}
add_action( 'edit_category', 'bsd_category_transient_flusher' );
add_action( 'save_post',     'bsd_category_transient_flusher' );
