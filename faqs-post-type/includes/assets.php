<?php   

namespace DEI_FAQ_CPU_Assets;

//check if the plugin is active
if( in_array( 'faqs-post-type/faqs-post-type.php', apply_filters( 'active_plugins', get_option('active_plugins') ) ) ){
    add_action('wp_enqueue_scripts', __NAMESPACE__.'\styles_and_scripts');
} 

function styles_and_scripts()  {
    wp_enqueue_style( 'faq.css', plugin_dir_url(__DIR__)  . 'assets/css/main.min.css', array(), '1', 'all' );
    wp_enqueue_script('masonry-js', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', array( 'jquery' ),'4.2.2', true);
    wp_enqueue_script( 'faq.js', plugin_dir_url(__DIR__)  . 'assets/js/faq.js', array('jquery', 'masonry-js'), '1', 'all', true );
}


