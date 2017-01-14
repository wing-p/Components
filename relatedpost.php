add_action( 'genesis_after_entry_content', 'gwc_related_posts' );
/**
 * Outputs related posts with thumbnail
 * 
 * @author Nick the Geek
 * @url http://designsbynickthegeek.com/tutorials/related-posts-genesis
 * @global object $post 
 */
function gwc_related_posts() {
     
    if ( is_single ( ) ) {
         
        global $post; 
        $count = 0;
        $postIDs = array( $post->ID );
        $related = '';
        $tags = wp_get_post_tags( $post->ID );
        $cats = wp_get_post_categories( $post->ID );
         
        if ( $tags ) {             
            foreach ( $tags as $tag ) {     
                $tagID[] = $tag->term_id;                 
            }
             
            $args = array(
                'tag__in'               => $tagID,
                'post__not_in'          => $postIDs,
                'showposts'             => 5,
                'ignore_sticky_posts'   => 1,
                'tax_query'             => array(
                    array(
                                        'taxonomy'  => 'post_format',
                                        'field'     => 'slug',
                                        'terms'     => array( 
                                            'post-format-link', 
                                            'post-format-status', 
                                            'post-format-aside', 
                                            'post-format-quote'
                                            ),
                                        'operator'  => 'NOT IN'
                    )
                )
            );
 
            $tag_query = new WP_Query( $args );
             
            if ( $tag_query->have_posts() ) {                 
                while ( $tag_query->have_posts() ) {                     
                    $tag_query->the_post(); 
                    $img = genesis_get_image() ? genesis_get_image( array( 'size' => 'related' ) ) : '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/related.png" alt="' . get_the_title() . '" />'; 
                    $related .= '<li><a href="' . get_permalink() . '" rel="bookmark" title="Permanent Link to' . get_the_title() . '">' . $img . get_the_title() . '</a></li>';                     
                    $postIDs[] = $post->ID; 
                    $count++;
                }
            }
        }
 
        if ( $count <= 4 ) {             
            $catIDs = array( ); 
            foreach ( $cats as $cat ) {                 
                if ( 3 == $cat )
                    continue;
                $catIDs[] = $cat;                 
            }
             
            $showposts = 5 - $count; 
            $args = array(
                'category__in'          => $catIDs,
                'post__not_in'          => $postIDs,
                'showposts'             => $showposts,
                'ignore_sticky_posts'   => 1,
                'orderby'               => 'rand',
                'tax_query'             => array(
                                    array(
                                        'taxonomy'  => 'post_format',
                                        'field'     => 'slug',
                                        'terms'     => array( 
                                            'post-format-link', 
                                            'post-format-status', 
                                            'post-format-aside', 
                                            'post-format-quote' ),
                                        'operator' => 'NOT IN'
                                    )
                )
            );
 
            $cat_query = new WP_Query( $args );             
            if ( $cat_query->have_posts() ) {                 
                while ( $cat_query->have_posts() ) {                     
                    $cat_query->the_post(); 
                    $img = genesis_get_image() ? genesis_get_image( array( 'size' => 'related' ) ) : '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/images/related.png" alt="' . get_the_title() . '" />'; 
                    $related .= '<li><a href="' . get_permalink() . '" rel="bookmark" title="Permanent Link to' . get_the_title() . '">' . $img . get_the_title() . '</a></li>';
                }
            }
        }
 
        if ( $related ) {             
            printf( '<div class="related-posts"><h3 class="related-title">Related Posts</h3><ul class="related-list">%s</ul></div>', $related );
         
        }
         
        wp_reset_query();
         
    }
}