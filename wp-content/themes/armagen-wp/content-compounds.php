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
								 'tooltip' => 'Previous Compound',
							) );?>&nbsp;
						</div>
						<div class="all"><a href="/compounds" title="All Compounds">All Compounds</a></div>
						<div class="next">&nbsp;
						<?php next_post_link_plus( array(
								 'format' => '%link',
								 'link' => 'Next',
								 'tooltip' => 'Next Compound',
							) );?>
						</div>
					</div>

					<?php the_field('compound_page_content'); ?>

				</div>
			</article>
		
		
			<?php wp_link_pages( array( 
				'before' => '<div class="page-link">' . __( 'Pages:', 'armagen' ), 
				'after'  => '</div>' ) ); ?>
			<?php edit_post_link( __( 'Edit', 'armagen' ), '<span class="edit-link">', '</span>' ); ?>
					
		 
		</div>
	</div>



