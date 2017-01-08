add_action( 'wp_enqueue_scripts', 'wing_enqueue_custom' );
function wing_enqueue_custom() {
		wp_enqueue_script( 'customscript', get_stylesheet_directory_uri() . '/js/customscript.js');