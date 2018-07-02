<?php
function r_activate_plugin(){
    if(version_compare(get_bloginfo('version'),'4.5','<')){
        wp_die('You must update WordPress to use this plugin','recipe');
    }

    recipe_init();
    //IMPORTANT FOR CUSTOM POST TYPES REWRITE RULES
    flush_rewrite_rules();

    global $wpdb;

    $createSQL = '
	CREATE TABLE `'.$wpdb->prefix.'recipe_ratings` (
		`ID` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		`recipe_id` BIGINT(20) UNSIGNED NOT NULL,
		`rating` FLOAT(3,2) UNSIGNED NOT NULL,
		`user_ip` VARCHAR(32) NOT NULL,
		PRIMARY KEY (`ID`)
	) ENGINE=InnoDB '.$wpdb->get_charset_collate().' AUTO_INCREMENT=1;';

    require_once(ABSPATH.'/wp-admin/includes/upgrade.php');

    dbDelta($createSQL);

    //Cronjob
    wp_schedule_event(
    	time(),
	    'daily',
	    'r_daily_recipe_hook'
    );

    $recipe_opts = get_option('r_opts');

    if(!$recipe_opts){
    	$opts = [
    		'rating_login_required' =>1,
		    "recipe_submission_login_required" => 1 ];

    	add_option('r_opts',$opts);
    }

    global $wp_roles;
    add_role(
    	'recipe_author',
	    __('Recipe Author','recipe'),
	    [
	    	'edit_posts' => true,
		    'read' => true,
		    'upload_files' => true]
    );
}