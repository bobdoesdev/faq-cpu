<?php wp_nonce_field( 'meta_box_faq_'.$which, 'meta_box_faq_'.$which.'_nonce' ); 

$content = get_post_meta($post->ID, 'answer', true);

wp_editor(
	$content,
	'faq-answer'
	);
