<?php
/**
Template Name: Fullwidth Page
**/

get_header();
?>
<section class="bs-py-default">
	<div class="container">
		<div class="row g-5">
			<div class="col-lg-12 col-12">
				   <?php 		
					the_post(); the_content(); 
					
					if( $post->comment_status == 'open' ) { 
						 comments_template( '', true ); // show comments 
					}
				?>           
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>

