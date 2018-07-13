<?php

function r_submit_user_recipe()
{
	$output = ['status' => 1];


	if( empty($_POST['ingredients']) || empty($_POST['time']) ||
		empty($_POST['utensils']) || empty($_POST['level']) ||
		empty($_POST['meal_type']) ){
		wp_send_json($output);
	}

	$title = sanitize_text_field($_POST['title']);
	$content = wp_kses_post($_POST['content']);
	$recipe_data = [];
	$recipe_data['ingredients'] = wp_trim_words(sanitize_text_field($_POST['ingredients']),20,'');
	$recipe_data['time'] = sanitize_text_field($_POST['time']);
	$recipe_data['utensils'] = sanitize_text_field($_POST['utensils']);
	$recipe_data['level'] = sanitize_text_field($_POST['level']);
	$recipe_data['meal_type'] = sanitize_text_field($_POST['meal_type']);
	$recipe_data['video_url'] = esc_url_raw($_POST['video_url']);
	$recipe_data['rating'] = 0;
	$recipe_data['rating_count'] = 0;

	$post_id = wp_insert_post([
		'post_content'=>$content,
		'post_name' =>$title,
		'post_title'=>$title,
		'post_status'=>'pending',
		'post_type' =>'recipe'
	]);

	update_post_meta($post_id,'recipe_data',$recipe_data);

	if(isset($_POST['attachment_id']) && !empty($_POST['attachment_id'])){
		include_once(ABSPATH.'/wp-admin/includes/image.php');
		set_post_thumbnail($post_id,absint($_POST['attachment_id']));
	}

	do_action('recipe_rated',array(
		'post_id'   =>$post_id,
		'rating'    => $rating,
		'user_ip'   =>$user_ip
	));
	$output['status'] = 2;
	wp_send_json($output);
}