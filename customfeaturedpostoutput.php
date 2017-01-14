<?php
/**
 * Plugin Name
 *
 * @package           Custom_Featured_Post_Widget
 * @author            Gary Jones
 * @license           GPL-2.0+
 * @link              http://gamajo.com/
 * @copyright         2013 Gary Jones, Gamajo Tech
 */
/**
 * Custom Featured Post widget class.
 *
 * @package Custom_Featured_Post_Widget
 * @author  Gary Jones
 */
class Custom_Featured_Post extends Genesis_Featured_Post {
	
	function widget( $args, $instance ) {
		global $wp_query, $_genesis_displayed_ids;
		//* Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		echo $args['before_widget'];
		//* Set up the author bio
		if ( ! empty( $instance['title'] ) )
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $args['after_title'];
		$query_args = array(
			'post_type'           => 'post',
			'cat'                 => $instance['posts_cat'],
			'showposts'           => $instance['posts_num'],
			'offset'              => $instance['posts_offset'],
			'orderby'             => $instance['orderby'],
			'order'               => $instance['order'],
			'ignore_sticky_posts' => $instance['exclude_sticky'],
		);
		//* Exclude displayed IDs from this loop?
		if ( $instance['exclude_displayed'] )
			$query_args['post__not_in'] = (array) $_genesis_displayed_ids;
		$wp_query = new WP_Query( $query_args );
		if ( have_posts() ) : while ( have_posts() ) : the_post();
		$_genesis_displayed_ids[] = get_the_ID();
		genesis_markup( array(
		'html5'   => '<article %s>',
		'xhtml'   => sprintf( '<div class="%s">', implode( ' ', get_post_class() ) ),
		'context' => 'entry',
		) );
			if ( $instance['show_title'] )
			echo genesis_html5() ? '<header class="entry-header come-in">' : '';
			echo '<div class="RightSlide">'; 
				
				if ( ! empty( $instance['show_content'] ) ) {
				echo genesis_html5() ? '<div class="entry-content">' : '';				
				
					if ( ! empty( $instance['show_title'] ) ) {
					$title = get_the_title() ? get_the_title() : __( '(no title)', 'genesis' );
					$title = apply_filters( 'genesis_featured_post_title', $title, $instance, $args );
					$heading = genesis_a11y( 'headings' ) ? 'h4' : 'h2';
					if ( genesis_html5() )
						printf( '<%s class="entry-title hmarcv-tle"><a href="%s">%s</a></%s>', $heading, get_permalink(), $title, $heading );
					else
						printf( '<div class="%s hmarcv-tle"><a href="%s ">%s</a></div>', $heading, get_permalink(), $title, $heading );
					}
				
					if ( ! empty( $instance['show_byline'] ) && ! empty( $instance['post_info'] ) )
					printf( genesis_html5() ? '<p class="entry-meta">%s</p>' : '<p class="byline post-info">%s</p>', do_shortcode( $instance['post_info'] ) );	
			
					if ( 'excerpt' == $instance['show_content'] ) {
					the_excerpt();
					}
					elseif ( 'content-limit' == $instance['show_content'] ) {
					the_content_limit((int) $instance['content_limit'], genesis_a11y_more_link( esc_html( $instance['more_text'] ) ) );
					}
					else {
					global $more;
					$orig_more = $more;
					$more = 0;
					the_content( genesis_a11y_more_link( esc_html( $instance['more_text'] ) ) );
					$more = $orig_more;
					}		
				
				echo genesis_html5() ? '</div>' : '';
				}
			
				$image = genesis_get_image( array(
				'format'  => 'html',
				'size'    => $instance['image_size'],
				'context' => 'featured-post-widget',
				'attr'    => genesis_parse_attr( 'entry-image-widget', array ( 'alt' => get_the_title() ) ),
				) );			
				if ( $instance['show_image'] && $image ) {
				$role = empty( $instance['show_title'] ) ? '' : 'aria-hidden="true"';
				printf( '<a href="%s" class="%s hmarcv-img" %s>%s</a>', get_permalink(), esc_attr( $instance['image_alignment'] ), $role, $image );
				}
				if ( ! empty( $instance['show_gravatar'] ) ) {
				echo '<span class="' . esc_attr( $instance['gravatar_alignment'] ) . '">';
				echo get_avatar( get_the_author_meta( 'ID' ), $instance['gravatar_size'] );
				echo '</span>';
				}
			echo '</div>'; 
			if ( $instance['show_title'] )
			echo genesis_html5() ? '</header>' : ''; 
			
		genesis_markup( array(
		'html5' => '</article>',
		'xhtml' => '</div>',
		) );
		endwhile; endif;
		//* Restore original query
		wp_reset_query();
		//* The EXTRA Posts (list)
		if ( ! empty( $instance['extra_num'] ) ) {
			if ( ! empty( $instance['extra_title'] ) )
				echo $args['before_title'] . esc_html( $instance['extra_title'] ) . $args['after_title'];
			$offset = intval( $instance['posts_num'] ) + intval( $instance['posts_offset'] );
			$query_args = array(
				'cat'       => $instance['posts_cat'],
				'showposts' => $instance['extra_num'],
				'offset'    => $offset,
			);
			$wp_query = new WP_Query( $query_args );
			$listitems = '';
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					$_genesis_displayed_ids[] = get_the_ID();
					$listitems .= sprintf( '<li><a href="%s">%s</a></li>', get_permalink(), get_the_title() );
				}
				if ( mb_strlen( $listitems ) > 0 )
					printf( '<ul>%s</ul>', $listitems );
			}
			//* Restore original query
			wp_reset_query();
		}
		if ( ! empty( $instance['more_from_category'] ) && ! empty( $instance['posts_cat'] ) )
			printf(
				'<p class="more-from-category"><a href="%1$s" title="%2$s">%3$s</a></p>',
				esc_url( get_category_link( $instance['posts_cat'] ) ),
				esc_attr( get_cat_name( $instance['posts_cat'] ) ),
				esc_html( $instance['more_from_category_text'] )
			);
		echo $args['after_widget'];
	}
}