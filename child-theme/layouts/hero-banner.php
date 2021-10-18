<section class="hero-banner">
	<img src="<?php echo get_sub_field("bg_image")["url"]; ?>">
	<div class="contain">
		<div class="col-8 sticker weight-300">
			<?php if(get_sub_field('add_sale_sticker')) : ?>
			<div class="sale-sticker">
				<p class="large">Sale</p>
				<p class="small">Now on</p>
			</div>
			<?php endif; ?>
		</div>
		<div class="col-4">
			<div class="main-text-contain">
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
				if(have_rows('hero_list')) : ?>
				<ul class="hero-list">
					<?php while(have_rows('hero_list')) : the_row(); ?>
					<li><?php echo get_sub_field('hero_list_item'); ?></li>
					<?php endwhile; ?>
				</ul>
				<?php endif; ?>
				<?php if(have_rows('buttons')) : ?>
				<div class="button-row">
					<?php while(have_rows('buttons')) : the_row(); ?>
					<a href="<?php echo get_sub_field('button')['url']; ?>" alt="<?php echo get_sub_field('button')['alt']; ?>" class="weight-700"><?php echo get_sub_field('button')['title']; ?></a>
					<?php endwhile; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>