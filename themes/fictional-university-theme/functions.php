<?php
function university_files(){
	wp_enqueue_style('custom-google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
	wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

//	wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
/*	
	if(strstr($_SERVER['SERVER_NAME'], 'localhost/wordpress')){
		wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true);
	}else{
		wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundle-assets/vendors.js'), NULL, '1.0', true);
		wp_enqueue_script('main-university-js', get_theme_file_uri('/bundle-assets/scripts.js'), NULL, '1.0', true);
		wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundle-assets/style.css'));
	}
*/	
	wp_enqueue_style('university_main_styles', get_stylesheet_uri());
	wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);

}


add_action('wp_enqueue_scripts','university_files');

function university_features(){
	register_nav_menu('headerMenuLocation','Header Menu Location');
	register_nav_menu('footerMenuLocation1','Footer Location One');
	register_nav_menu('footerMenuLocation2','Footer Location Two');

	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_image_size('professorLandscape', 400, 260, true);
	add_image_size('professorPortrait', 480, 650, true);
}

function university_adjust_queries($query){
	if(!is_admin() && is_post_type_archive('program') && $query->is_main_query()){
		$query->set('orderby', 'title');
		$query->set('order', 'ASC');
		$query->set('posts_per_page', -1);
	}



	if(!is_admin() && is_post_type_archive('event') && $query->is_main_query()){
//		$query->set('posts_per_page', '1');
		$today = date('Ymd');
		$query->set('meta_key', 'event_date');
		$query->set('orderby', 'meta_value_num');
		$query->set('order', 'ASC');
		$query->set('meta_query', array(
			//array(),
			array(
			  'key' => 'event_date',
			  'compare' => '>=',
			  'value' => $today,
			  'type' => 'numeric'
			)
			));
	}
}


add_action('after_setup_theme', 'university_features');

add_action('pre_get_posts', 'university_adjust_queries')
?>