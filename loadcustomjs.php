<?php 

/** Load the scripts at the bottom of the page to increase performance and user experience 
This is Genesis specific and may vary depending on WordPress theming framework*/
add_action('genesis_after_footer', 'load_custom_js');

function load_custom_js() {
//Only load the scripts on non-admin pages
if (!is_admin()){
	//Load jquery core from Jquery.com directly
	wp_enqueue_script('my_jquery','http://code.jquery.com/jquery-1.10.1.min.js',array( 'jquery' ));		
	//Load custom jquery or js script from child theme folder 
	wp_enqueue_script('my_custom_js',get_stylesheet_directory_uri().'/js/customjs.js',array( 'jquery' ));
	}
}