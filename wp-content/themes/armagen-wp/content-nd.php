<?php
/**
 * @package ArmaGen
 */
?>
 


				<?php $tax_query = array( 'relation' => 'AND' );
			
				$tax_query[] = array( 
					'taxonomy' => 'disease_cat', 
					'terms' => array('nd'),
					'field' => 'slug' 
				);
				
				$args = array(
					'post_type' => 'compounds',
					'tax_query' => $tax_query
				);
				
				$custom_loop = new WP_Query( $args ); 
				
				if ( $custom_loop->have_posts() ) :
				
					while( $custom_loop->have_posts() ) : $custom_loop->the_post(); ?>
		
		
	
					<li class="<?php the_field('color_assignment'); ?>" id="post-<?php the_ID(); ?>">
						<h3><?php the_field('short_name'); ?></h3>
						<?php the_field('status'); ?>
						<a class="button" href="<?php the_permalink() ?>" title="Learn More">Learn More</a>
					</li>					



				<?php
					endwhile;
				
				else :
				
					_e('Sorry, nothing here.');
				
				endif;
				
				wp_reset_query();
				?>



