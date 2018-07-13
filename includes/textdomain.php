<?php
//Remember to use poedit to generate PO and MO files
function r_load_text_domain (){
	$plugin_dir = 'recipe/lang';
	load_plugin_textdomain(
		'recipe',
		false,
		$plugin_dir
	);
}