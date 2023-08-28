<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package website-revo
 */

get_header('page');
?>

<main id="primary" class="site-main single-page">
	<div class="container">

		<?php
		while (have_posts()) : ?> <?php the_post(); ?>
			<div class="card-product">
				<img src="<?php the_field('catalog_item_img'); ?>" class="card-product__image" width="380" height="380" alt="coffee">
				<div class="card-product__container">
					<h1 class="card-product__title"><?php the_title(); ?></h1>
					<p class="card-product__info"><?php the_field('catalog_item_info'); ?></p>

					<div class="card-product__prices">
						<span class="card-product__price"><?php the_field('catalog_item_price'); ?></span>
						<span class="card-product__past-price"><?php the_field('catalog_item_past-price'); ?></span>
					</div>

					<div class="card-product__btns">
						<a href="#" class="card-product__btn-1">Купить</a>
						<a href="#" class="card-product__btn-2">Подробнее</a>
					</div>
				</div>
			</div>
			<div class="card-product__description">
				<h2 class="card-product__description__title">Описание</h2>
				<?php the_content(); ?>

			</div>



			<?php
			// the_post_navigation(
			// 	array(
			// 		'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'website-revo' ) . '</span> <span class="nav-title">%title</span>',
			// 		'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'website-revo' ) . '</span> <span class="nav-title">%title</span>',
			// 	)
			// );

			// If comments are open or we have at least one comment, load up the comment template.
			// get_template_part('template-parts/content', get_post_type());

			// if (comments_open() || get_comments_number()) :
			// 	comments_template();
			// endif; 
			?>

		<?php
		endwhile; // End of the loop.
		?>
	</div>
</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
