<?php

function r_admin_enqueue(){
	global $typenow;

	if($typenow != 'recipe' && (!isset($_GET['page']) || $_GET['page'])!= "r_plugin_opts") {
		return;
	}
	wp_register_style(
		'ju_bootstrap',
		plugins_url('/assets/styles/bootstrap.css',RECIPE_PLUGIN_URL)
	);

	wp_enqueue_style('ju_bootstrap');

	wp_register_script(
		'r_admin_options',
		plugins_url('/assets/scripts/options.js',RECIPE_PLUGIN_URL),
		array('jquery'),
	'1.0.0',
		true);
}