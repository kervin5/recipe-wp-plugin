<?php
function r_filter_recipe_content($content){
	if(!is_singular('recipe')){
		return $content;
	}

	global $post;

	$recipe_html = file_get_contents('recipe-template.php',true);
	$recipe_data = get_post_meta($post->ID,'recipe_data',true);
	$recipe_html = str_replace('INGREDIENTS_PH',$recipe_data['ingredients'],$recipe_html);
	$recipe_html = str_replace('COOKING_TIME_PH',$recipe_data['time'],$recipe_html);
	$recipe_html = str_replace('UTENSILS_PH',$recipe_data['utensils'],$recipe_html);
	$recipe_html = str_replace('LEVEL_PH',$recipe_data['level'],$recipe_html);
	$recipe_html = str_replace('TYPE_PH',$recipe_data['meal_type'],$recipe_html);

	$recipe_html = str_replace('INGREDIENTS_I18N',__("Ingredients","recipe"),$recipe_html);
	$recipe_html = str_replace('COOKING_TIME_I18N',__("Cooking Time","recipe"),$recipe_html);
	$recipe_html = str_replace('UTENSILS_I18N',__("Utensils","recipe"),$recipe_html);
	$recipe_html = str_replace('LEVEL_I18N',__("Level","recipe"),$recipe_html);
	$recipe_html = str_replace('TYPE_I18N',__("Meal Type","recipe"),$recipe_html);
	$recipe_html = str_replace('RATE_I18N',__('Rating','recipe'),$recipe_html);
	$recipe_html = str_replace('RECIPE_ID',$post->ID,$recipe_html);

	return $recipe_html.$content;
}