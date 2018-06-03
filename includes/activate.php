<?php
function r_activate_plugin(){
    if(version_compare(get_bloginfo('version'),'4.5','<')){
        wp_die('You must update WordPress to use this plugin','recipe');
    }
}