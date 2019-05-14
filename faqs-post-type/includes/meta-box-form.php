<?php wp_nonce_field( 'meta_box_faq_'.$which, 'meta_box_faq_'.$which.'_nonce' ); ?>
<p>
<textarea class="widefat"  name="faq-<?php echo $which;?>" id="faq-<?php echo $which;?>" rows="4" cols="50" ><?php echo esc_attr( get_post_meta( $post->ID, $which, true ) );  ?></textarea>
</p>

