<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package website-revo
 */

get_header('page');
?>

<main id="primary" class="site-main">
	<div class="page-header">
		<?php
		the_archive_title('<h1 class="page-title">', '</h1>');
		the_archive_description('<div class="archive-description">', '</div>');
		?>
	</div><!-- .page-header -->
	<div class="archive__main container">
		<div class="archive__body">
			<?php if (have_posts()) : ?>

				<?php
				/* Start the Loop */
				while (have_posts()) :
					the_post();
				?>
					<div class="catalog__item">
						<img loading="lazy" src="<?php the_field('catalog_item_img'); ?>" class="catalog__item__image image" width="256" height="256" alt="">
						<div class="catalog__item__content">
							<div class="catalog__item__price"><?php the_field('catalog_item_price'); ?></div>
							<a href="<?php the_permalink(); ?>" class="catalog__item__title"><?php the_title(); ?></a>
							<p class="catalog__item__text"><?php the_field('catalog_item_info'); ?></p>
							<div class="catalog__item__btns">
								<a href="<?php the_permalink(); ?>" class="catalog__item__btn-1">Купить</a> <!-- edit -->
								<a href="<?php the_permalink(); ?>" class="catalog__item__btn-2">Подробнее</a>
							</div>
						</div>
					</div>
			<?php
				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				// get_template_part('template-parts/content', get_post_type());

				endwhile;

			// the_posts_navigation();

			else :

			// get_template_part('template-parts/content', 'none');

			endif;
			?>
		</div>
		<?php get_sidebar(); ?>
	</div>
</main><!-- #main -->

<?php
get_footer();
