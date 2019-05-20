<?php get_header(); ?>
<main id="main-content" class="flex-grow">
 <div class="container">
	<div class="row">
		<section id="faq-cpu-single" class="col-md-12">
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-question">
					<h3><?php echo get_post_meta( get_the_ID(), 'question', true) ; ?></h3>
				</header><!-- .entry-header -->
			 
					<div class="entry-answer">
						<?php 
							setup_postdata( $post ); 
							the_content(); 
							wp_reset_postdata(); 
						?>
					</div><!-- .entry-content -->
				 


				<footer class="entry-meta">
					<?php 
					wp_link_pages( array(
							'before'      => '<nav class="page-links"><span class="page-links-title">' . __( 'Pages:', 'dei' ) . '</span>',
							'after'       => '</nav>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
					) );

					?>	
				</footer><!-- .entry-meta -->
			</article><!-- #post-## -->					
				
		</section>

	</div><!--  .row -->
 </div><!--  .container -->
</main>
<?php get_footer(); ?>




