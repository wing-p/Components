<?php 

add_action( 'genesis_entry_header', 'gwc_page_header');

if (has_post_thumbnail()){
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
  
	function gwc_page_header(){
		echo '<div class="post-banner">';
		the_post_thumbnail();
		echo '<div class="post-info">';
		genesis_do_post_title();
		genesis_post_meta();
		echo '</div>';
		echo '</div>';
		}
}

genesis();