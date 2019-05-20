<?php get_header(); ?>
<main id="main-content" class="flex-grow">
 <div class="container">
	<div class="row">
		<section id="faq-cpu" class="">
			<div class="grid-sizer"></div>
			<div class="gutter-sizer"></div>
					<!-- get all of the terms for faqs-categories -->
					<?php $terms = get_terms( 'faq-category', array(
					    'hide_empty' => true,
					) ); ?>

					<?php foreach ($terms as $term) { ?>
					
						<div class="faq-category-wrapper">
							<div class="faq-cat-inner">
								<h3 class="faq-cat-title"><?php echo $term->name;?></h3>
								
								<?php 
									$args = array(
										'post_type' => 'faq',
										'tax_query' => array(
												array(
													'taxonomy' => 'faq-category',
													'field' => 'slug',
													'terms' => $term
												)
											)
										);

									$posts = get_posts($args); 

									foreach ($posts as $post) { ?>
										<!-- for each category, get each post in that category -->
										<div class="faq-wrapper">
											<a href="<?php echo get_permalink($post->ID); ?>" class="faq-question-link">
												<?php echo get_post_meta($post->ID, 'question', true); ?>
											</a>
										</div>
									<?php }								
							?>
							</div>
						</div>

					<?php } ?>
					
				
		</section>

	</div><!--  .row -->
 </div><!--  .container -->
</main>
<?php get_footer(); ?>