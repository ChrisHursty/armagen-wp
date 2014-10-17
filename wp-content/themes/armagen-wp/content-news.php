<?php
/**
 * @package ArmaGen
 */
?>
 


	<div id="primary">
        <div id="content" role="main">

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content clearfix">

			
					<div class="pagination clearfix">
						<div class="prev">
						<?php previous_post_link_plus( array(
								 'format' => '%link',
								 'link' => 'Previous',
								 'tooltip' => 'Previous News Release',
							) );?>&nbsp;
						</div>
						<div class="all"><a href="/news" title="All News">All News</a></div>
						<div class="next">&nbsp;
						<?php next_post_link_plus( array(
								 'format' => '%link',
								 'link' => 'Next',
								 'tooltip' => 'Next News Release',
							) );?>
						</div>
					</div>

					<h3><?php the_title(); ?></h3>
					
					<?php the_content(); ?>



					<section>
					<?php
					if(get_field('pdf_download')) {
						echo '<a class="orange-button" href="' . get_field('pdf_download') . '" target="_blank" title="Download the PDF">Download the PDF</a>';
					}
					?>
					</section>




				</div>
			</article>
		
		
			<?php wp_link_pages( array( 
				'before' => '<div class="page-link">' . __( 'Pages:', 'armagen' ), 
				'after'  => '</div>' ) ); ?>
			<?php edit_post_link( __( 'Edit', 'armagen' ), '<span class="edit-link">', '</span>' ); ?>
					
		 
		</div>
	</div>



