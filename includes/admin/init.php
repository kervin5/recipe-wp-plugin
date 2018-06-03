<?php
function recipe_admin_init(){
    include('create_metaboxes.php');
    include('recipe-options.php');
    add_action('add_meta_boxes_recipe','r_create_metaboxes');
}