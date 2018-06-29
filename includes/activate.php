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
}