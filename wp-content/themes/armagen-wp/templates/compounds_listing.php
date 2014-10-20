<?php 
/* 
Template Name: Compounds index 
*/ 
get_header( 'small' ); ?>


<div id="primary">
	<div id="content" role="main">
	
		<section id="compounds" class="compounds-home">
			<div class="clearfix">
				<ul>
	
				<?php 
					if ( is_page('lysosomal-storage-diseases') ) { get_template_part( 'content', 'lsd' );  }
					if ( is_page('neurodegenerative-diseases') ) { get_template_part( 'content', 'nd' );  }
				?>

				</ul>
			</div>
		</section>

	</div>
</div>


  
<?php get_footer(); ?>