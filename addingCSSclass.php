/*** For a whole list of attributes, refer to 
wpbeaches.com/adding-attribute-html-section-genesis/ 
***/ 

add_filter( 'genesis_attr_entry-content', 'gwc_add_blgfade_attr' );
function gwc_add_blgfade_attr( $attributes ) {
	// add original plus extra CSS classes
	$attributes['class'] .= ' fadeInBlock';
	// return the attributes
	return $attributes;
}