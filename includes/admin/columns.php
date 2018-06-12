<?php

function r_add_new_recipe_columns($columns)
{
	$new_colums = array();
	$new_colums['cb'] = '<input type="checkbox" />';
	$new_colums['title'] = __('Title','recipe');
	$new_colums['author'] = __('Author','recipe');
	$new_colums['categories'] = __('Categories','recipe');
	$new_colums['count'] = __('Ratings Count','recipe');
	$new_colums['rating'] = __('Average Rating','recipe');
	$new_colums['date'] = __('Date','recipe');

	return $new_colums;
}

function r_manage_recipe_columns($column, $post_id)
{
	switch ($column){
		case 'count':
			$recipe_data    = get_post_meta($post_id,'recipe_data',true);
			echo $recipe_data['rating_count'];
			break;
		case 'rating':
			$recipe_data    = get_post_meta($post_id,'recipe_data',true);
			echo $recipe_data['rating'];
			break;
		default:
			break;
	}
}