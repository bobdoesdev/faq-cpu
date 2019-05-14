<?php 

namespace DEI_FAQs_Meta_Boxes;

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'add_meta_boxes_faq', __NAMESPACE__.'\add_meta_boxes' );
function add_meta_boxes() {
    add_meta_box(
        'faq-question',
        'Question',
        __NAMESPACE__.'\question_metabox_callback',
        'faq'
    );
    add_meta_box(
        'faq-answer',
        'Answer',
        __NAMESPACE__.'\answer_metabox_callback',
        'faq'
    );
}

function question_metabox_callback(){
    global $post;
    $which = 'question';
	require plugin_dir_path(__DIR__) . 'includes/meta-box-form.php';
}

function answer_metabox_callback(){
    global $post;
    $which = 'answer';
	require plugin_dir_path(__DIR__) . 'includes/meta-box-form.php';
}



add_action( 'save_post', __NAMESPACE__.'\save_data', 10, 2 );
function save_data( $post_id, $post ){

    if ( !isset( $_POST['meta_box_faq_question_nonce'] ) || !isset( $_POST['meta_box_faq_answer_nonce'] ) ){ return $post_id; }
                
    //Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $_POST['meta_box_faq_question_nonce'], 'meta_box_faq_question' ) || ! wp_verify_nonce( $_POST['meta_box_faq_answer_nonce'], 'meta_box_faq_answer' ) ) { return $post_id; }

    //with wp_update_post, must make sure post is not revision and input doesn't match db, otherwise get infinite loop
    //https://codex.wordpress.org/Function_Reference/wp_update_post
    if ( isset($_POST['faq-question'] ) && ( $_POST['faq-question'] !== get_post_meta( $post_id, 'question', true) ) && ! wp_is_post_revision( $post_id ) ) {
        update_post_meta( $post_id, 'question', $_POST['faq-question'] );


        //create title form question to avoid auto draft title assignation
        $title_array = explode(" ", $_POST['faq-question']);

        $title = implode( " ",  array_splice($title_array, 0, 5 ) );

         $update_title = array(
              'ID'           => $post_id,
              'post_title'   => $title,
              'post_name'    => $title
          );

        // Update the post into the database
          wp_update_post( $update_title );
    }

    if ( isset($_POST['faq-answer']) && ( $_POST['faq-answer'] !== get_post_meta( $post_id, 'answer', true) ))  {
        update_post_meta( $post_id, 'answer', $_POST['faq-answer'] );
    }

}



