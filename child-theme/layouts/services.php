<section class="services-list grey-bg">
	<?php 
	$heading_tag = get_sub_field('heading_tag');
	if(have_rows('heading')) :
	echo '<'.$heading_tag.' class="heading weight-300">';
	while(have_rows('heading')) : the_row();
	if(get_sub_field('colour') == 'Orange') : 
	echo '<span class="orange"> '.get_sub_field('heading_text').'</span>';
	else : echo ' '.get_sub_field('heading_text');
	endif;
	endwhile; 
	echo '</'.$heading_tag.'>';
	endif;
	?>
	<div class="contain">		
		<div class="services-slider">		
			<?php
			$args = array(  
				'post_type' => 'kitchens',
				'post_status' => 'publish',
				'posts_per_page' => 3, 
				'orderby' => 'date', 
				'order' => 'ASC', 
			);
			$loop = new WP_Query( $args ); 
			while ( $loop->have_posts() ) : $loop->the_post(); 
			$thumb = get_the_post_thumbnail_url();
			?>
			<a href="<?php echo the_permalink(); ?>">
				<div class="service ease-in" style="background-image:url('<?php echo $thumb; ?>')">
					<div class="service-text-contain weight-300 ease-in">						
						<p class="service-text-title">
						<?php
						echo the_title(); 
						?>
						</p>
						<svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M21.883 12l-7.527 6.235.644.765 9-7.521-9-7.479-.645.764 7.529 6.236h-21.884v1h21.883z" fill="#FB6C55" class="ease-in"/></svg>
						<p class="service-text-cat ease-in">
							Kitchens
						</p>
					</div>
				</div>
			</a>
			<?php
			endwhile;

			wp_reset_postdata(); 
			?>
		</div>
	</div>

</section>