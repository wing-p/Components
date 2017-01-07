/*** Add to function.php
***/ 
<?php 
//Unregister primary/secondary navigation menus
remove_theme_support( 'genesis-menus' );
//Default Menus: registers menus
add_theme_support ( 'genesis-menus' , array ( 
	'primary' => 'Primary Navigation Menu' , 
	'secondary' => 'Secondary Navigation Menu' ,
	'customnavbar' => 'Third Navigation Menu' 
	) 
);
// Add new navbar
add_action('genesis_before_header', 'customnavone');
function customnavone() {
require(CHILD_DIR.'/customnavbar.php');
?>

/***Create customnavbar.php
***
<?php 
	echo '<div class="third-menu animated"> 
	<div class="navTrns">';  
	wp_nav_menu( array( 
		'sort_column' => 'menu_order', 
		'container_id' => 'customnavbar' , 
		'menu_class' => 'menu customnavbar superfish sf-js-enabled', 
		'theme_location' => 'customnavbar') ); 
	echo '</div></div>'; 
?>	