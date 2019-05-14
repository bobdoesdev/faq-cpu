<?php

namespace DEI_FAQs_Post_Type;

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
    exit;
}


//register ost type: codex.wordpress.org/Function_Reference/register_post_type
add_action('init', __NAMESPACE__.'\create_post_type');
function create_post_type() {
	$labels = array(
		'name'               => _x( 'FAQs', 'post type general name', 'dei' ),
		'singular_name'      => _x( 'FAQ', 'post type singular name', 'dei' ),
		'menu_name'          => _x( 'FAQs', 'admin menu', 'dei' ),
		'name_admin_bar'     => _x( 'FAQ', 'add new on admin bar', 'dei' ),
		'add_new'            => _x( 'Add New', 'FAQ', 'dei' ),
		'add_new_item'       => __( 'Add New FAQ', 'dei' ),
		'new_item'           => __( 'New FAQ', 'dei' ),
		'edit_item'          => __( 'Edit FAQ', 'dei' ),
		'view_item'          => __( 'View FAQ', 'dei' ),
		'all_items'          => __( 'All FAQs', 'dei' ),
		'search_items'       => __( 'Search FAQs', 'dei' ),
		'parent_item_colon'  => __( 'Parent FAQs:', 'dei' ),
		'not_found'          => __( 'No FAQs found.', 'dei' ),
		'not_found_in_trash' => __( 'No FAQs found in Trash.', 'dei' )
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'exclude_from_search' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_nav_menus'  => false,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'faq' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 12,
		'menu_icon'			 => 'dashicons-images-alt2',
		'show_in_rest'       => true,
		'rest_base'          => 'faqs-api',
		// 'rest_controller_class' => 'Slick_FAQs_Post_REST_Controller',
		'supports'           => array( 'page-attributes')
	);

	register_post_type( 'faq', $args );
}


// Add new taxonomy, make it hierarchical (like categories)
add_action('init', __NAMESPACE__.'\create_post_taxonomies');
function create_post_taxonomies() {
	$labels = array(
		'name'              => _x( 'FAQ Category', 'taxonomy general name' ),
		'singular_name'     => _x( 'FAQ Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search FAQ Categories' ),
		'all_items'         => __( 'All FAQ Categories' ),
		'parent_item'       => __( 'Parent FAQ Category' ),
		'parent_item_colon' => __( 'Parent FAQ Category:' ),
		'edit_item'         => __( 'Edit FAQ Category' ),
		'update_item'       => __( 'Update FAQ Category' ),
		'add_new_item'      => __( 'Add New FAQ Category' ),
		'new_item_name'     => __( 'New FAQ Category' ),
		'menu_name'         => __( 'FAQ Categories' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => false,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'faq-category' ),
		'show_in_rest'       => true,
	  	'rest_base'          => 'faq-category',
	  	'rest_controller_class' => 'WP_REST_Terms_Controller',
	);

	register_taxonomy( 'faq-category', array( 'faq' ), $args );
}



add_filter('manage_faq_posts_columns', __NAMESPACE__.'\add_columns' );
function add_columns($columns) {
    unset($columns['author']);
    unset($columns['date']);
    unset($columns['title']);
    $n_col = array();

    foreach($columns as $key => $value) {
       if ($key === 'taxonomy-faq-category'){
         $n_columns['question'] = 'Question';
       }
       $n_columns[$key] = $value;
     }

    return $n_columns;
}


add_action('manage_faq_posts_custom_column', __NAMESPACE__.'\custom_column_content' );
function custom_column_content( $column_name ) {
  global $post;
  if ( $column_name == 'question' ) {
		echo '<a class="row-title" href="'.get_edit_post_link($post->ID).'">'.get_post_meta( $post->ID, 'question', true ).'</a>';
	}
}

