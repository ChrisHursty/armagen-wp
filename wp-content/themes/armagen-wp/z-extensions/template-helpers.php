<?php
/**
 * @package ArmaGen
 */

/**
 * Outputs author information
 *
 * @return void
 */
if ( ! function_exists( 'armagen_postby_meta' ) ):
function armagen_postby_meta() {

	printf( __( '<span class="meta-prep meta-prep-author">Posted </span><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s" pubdate>%3$s</time></a> <span class="meta-sep"> by </span> <span class="author vcard"><a class="url fn n" href="%4$s" title="%5$s">%6$s</a></span>', 'armagen' ),
        esc_url( get_permalink() ),
        esc_html( get_the_date( 'c' ) ),
        esc_html( get_the_date() ),
        esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
        esc_attr( sprintf( __( 'View all posts by %s', 'armagen' ), get_the_author() ) ),
        esc_html( get_the_author() )
    );

}
endif;

/**
 * Displays footer text
 *
 * @param object post
 * @return void
 */
if ( ! function_exists( 'armagen_footer_meta' ) ):
function armagen_footer_meta( $post ) {

	$post_type = $post->post_type;
	if ( !in_array( $post_type, array( 'post', 'portfolio' ) ) )
		return;
	?>

	<footer class="entry-meta">

	<?php if ( 'portfolio' == $post_type ) {

		$format = 'image';
		$cat_list = get_the_term_list( $post->ID, 'portfolio_category', '', ', ', '' );
		$tag_list = get_the_term_list( $post->ID, 'portfolio_tag', '', ', ', '' );
		$format_link = get_post_type_archive_link( $post_type );

	} else {

		$format = get_post_format( $post );
		if ( false === $format ) {
			$format = 'standard';
		}
		$format_link = get_post_format_link( $format);
		$cat_list = get_the_term_list( $post->ID, 'category', '', ', ', '' );
		$tag_list = get_the_term_list( $post->ID, 'post_tag', '', ', ', '' );
	} ?>

	<a href="<?php echo $format_link; ?>">
		<span class="entry-meta-icon icon-format-<?php echo esc_attr( $format ); ?>"></span>
	</a>

	<?php if ( $cat_list ) : ?>
	<span class="cat-links"><span class="entry-utility-prep entry-utility-prep-cat-links"><?php _e( 'Posted in: ', 'armagen' ); ?></span><?php echo $cat_list; ?></span>
	<?php endif; ?>

	<?php if ( $cat_list && $tag_list ) : ?>
		<span class="meta-sep"> | </span>
	<?php endif; ?>

	<?php if ( $tag_list ) : ?>
	<span class="tag-links"><span class="entry-utility-prep entry-utility-prep-tag-links"><?php _e( 'Tagged: ', 'armagen' ); ?></span><?php echo $tag_list; ?></span>
	<?php endif; ?>

	<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
	<span class="meta-sep"> | </span>
	<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'armagen' ), __( '1 Comment', 'armagen' ), __( '% Comments', 'armagen' ) ); ?></span>
	<?php endif; ?>

	<?php edit_post_link( __( 'Edit', 'armagen' ), '<span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-meta -->

<?php }
endif;

if ( ! function_exists( 'armagen_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @param object query
 * @return void
 */
function armagen_paging_nav( $query = false ) {
	global $wp_query;
	if ( $query ) {
		$temp_query = $wp_query;
		$wp_query = $query;
	}
	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	if (function_exists('wp_pagenavi') ) {
		wp_pagenavi();
	} else {
	?>
	<nav id="nav-below" class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'armagen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'armagen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'armagen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
	}
	if ( isset( $temp_query ) ) {
		$wp_query = $temp_query;
	}
}
endif;

if ( ! function_exists( 'armagen_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function armagen_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav id="nav-below" class="navigation post-navigation clearfix" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'armagen' ); ?></h1>
		<div class="nav-links">
			<?php
			if ( 'portfolio' ==  get_post_type() ) {
				// Links reversed for portfolio posts
				previous_post_link( '<div class="nav-next">%link</div>', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'armagen' ) );
				next_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'armagen' ) );
			} elseif ( is_attachment() ) { ?>
				<div class="nav-previous"><?php previous_image_link( false, __( '&larr; Previous', 'armagen' ) ); ?></div>
				<div class="nav-next"><?php next_image_link( false, __( 'Next &rarr;', 'armagen' ) ); ?></div><?php
			} else {
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'armagen' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'armagen' ) );
			} ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;