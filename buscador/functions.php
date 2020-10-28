function my_scripts() {
	wp_enqueue_script('my-custom-scripts', get_template_directory_uri() . '/js/custom-scripts.js', array('jquery'), false, false);
}

add_action('wp_enqueue_scripts', 'my_scripts');