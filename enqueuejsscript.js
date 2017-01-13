add_action( 'wp_enqueue_scripts', 'wing_enqueue_scripts' );
function wing_enqueue_scripts() {
	wp_enqueue_script( 
	//script name// 
	'customscript',  
	//location//  
	get_stylesheet_directory_uri() . '/js/customscript.js', 
	//define dependency file// 
	array(''), 
	//vers//
	'1.0', 
	//boolean for loading js script at footer//
	true);
}

//enqueue plugin file 
plugin_dir_path( string $file ) 
//* $file (string) (Required) The filename of the plugin (__FILE__). 

//*e.g. 
function plugin_dir_path( $file ) {
    return trailingslashit( dirname( $file ) );
} 

