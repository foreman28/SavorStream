<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main main">
        <section class="hero">
            <div class="hero__container container">
                <h1 class="hero__title"> <?php the_field('hero_title'); ?></h1>

                <div class="hero__bg"><img src="<?php the_field('hero_img'); ?>" alt="coffee"></div>
            </div>
        </section>

        <section class="features">
            <div class="features__container container">
                <h3 class="features__subtitle subtitle"><?php the_field('features_title'); ?></h3>
                <h2 class="features__title title"><?php the_field('features_subtitle'); ?></h2>

                <div class="features__items">

                    <?php if (get_field('sec2_repeater')) : ?>
                        <?php while (has_sub_field('sec2_repeater')) : ?>
                            <div class="features__item">
                                <img loading="lazy" src="<?php the_sub_field('sec2_repeater_img'); ?>" class="features__item__image image" width="100" height="100" alt="">
                                <p class="features__item__title"><?php the_sub_field('sec2_repeater_title'); ?></p>
                                <p class="features__item__text"><?php the_sub_field('sec2_repeater_info'); ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>

                </div>
            </div>
        </section>

        <section class="catalog">
            <div class="catalog__container container">
                <h3 class="catalog__subtitle subtitle"><?php the_field('features_title'); ?></h3>
                <h2 class="catalog__title title"><?php the_field('features_subtitle'); ?></h2>

                <div class="swiper catalog-swiper catalog__items">
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'category_name' => 'catalog',
                        'tag__not_in' => '3',
                        'posts_per_page' => 6, // Количество записей
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                    ?>
                        <div class="swiper-wrapper">
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <div class="swiper-slide">
                                    <div class="catalog__item">
                                        <img loading="lazy" src="<?php the_field('catalog_item_img'); ?>" class="catalog__item__image image" width="256" height="256" alt="">
                                        <div class="catalog__item__content">
                                            <div class="catalog__item__price"><?php the_field('catalog_item_price'); ?></div>
                                            <a href="<?php the_permalink(); ?>" class="catalog__item__title"><?php the_title(); ?></a>
                                            <p class="catalog__item__text"><?php the_field('catalog_item_info'); ?></p>
                                            <div class="catalog__item__btns">
                                                <a href="<?php the_permalink(); ?>" class="catalog__item__btn-1 btn btn-1">Купить</a> <!-- edit -->
                                                <a href="<?php the_permalink(); ?>" class="catalog__item__btn-2 btn btn-2">Подробнее</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="swiper-button-next">
                        <svg>
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow"></use>
                        </svg>
                    </div>
                    <div class="swiper-button-prev">
                        <svg>
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        <section class="gift-set">
            <div class="gift-set__container container">
                <h3 class="gift-set__subtitle subtitle">Лучший подарок лучшему другу</h3>
                <h2 class="gift-set__title title">ПОДАРОЧНЫЙ НАБОР</h2>

                <div class="tabs__nav gift-set__tabs tabs">
                    <div class="list-reset tabs__nav">
                        <span class="tabs__nav-item"><button class="tabs__btn btn-reset tabs__nav-btn" type="button">1</button></span>
                        <span class="tabs__nav-item"><button class="tabs__btn btn-reset tabs__nav-btn" type="button">2</button></span>
                        <span class="tabs__nav-item"><button class="tabs__btn btn-reset tabs__nav-btn" type="button">3</button></span>
                    </div>

                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'tag' => 'gift-set',
                        'posts_per_page' => 3, // Количество записей
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                    ?>
                        <div class="tabs__content">
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <div class="tabs__pane tabs__panel">
                                    <div class="gift-set__item">
                                        <img class="gift-set__item__image" src="<?php the_field('catalog_item_img'); ?>" alt="gift set" width="460" height="460">
                                        <div class="gift-set__item__content">
                                            <div class="gift-set__item__box">
                                                <div class="gift-set__item__price"><?php the_field('catalog_item_price'); ?></div>
                                                <a href="<?php the_permalink(); ?>" class="catalog__item__title"><?php the_title(); ?></a>
                                                <p class="gift-set__item__text"><?php the_field('catalog_item_info'); ?></p>
                                            </div>

                                            <div class="gift-set__item__info">
                                                <div class="gift-set__item__info__item">
                                                    <svg class="gift-set__item__info__image">
                                                        <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#coffee"></use>
                                                    </svg>
                                                    <div class="gift-set__item__info__content">
                                                        <div class="gift-set__item__info__title">Вид зерна</div>
                                                        <div class="gift-set__item__info__text"><?php the_field('gift-set_item_type-of-grain'); ?></div>
                                                    </div>
                                                </div>
                                                <div class="gift-set__item__info__item">
                                                    <svg class="gift-set__item__info__image">
                                                        <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#mountain"></use>
                                                    </svg>
                                                    <div class="gift-set__item__info__content">
                                                        <div class="gift-set__item__info__title">Высота</div>
                                                        <div class="gift-set__item__info__text"><?php the_field('gift-set_item_height'); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gift-set__item__btns">
                                                <a href="<?php the_permalink(); ?>" class="gift-set__item__btn-1 btn btn-1">Купить</a>
                                                <a href="<?php the_permalink(); ?>" class="gift-set__item__btn-2 btn btn-2">подробнее</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="coffee-combo">
            <div class="coffee-combo__container container">
                <h3 class="coffee-combo__subtitle subtitle">Ваш персонализированный кофе</h3>
                <h2 class="coffee-combo__title title">КОФЕЙНОЕ КОМБО</h2>

                <div class="swiper coffee-combo-swiper coffee-combo__items">

                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'category_name' => 'catalog',
                        'tag__not_in' => '3',
                        'posts_per_page' => 6, // Количество записей
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                    ?>
                        <div class="swiper-wrapper">
                            <?php while ($query->have_posts()) : $query->the_post(); ?>
                                <div class="swiper-slide">
                                    <div class="coffee-combo__item">
                                        <img loading="lazy" src="<?php the_field('catalog_item_img'); ?>" class="coffee-combo__item__image" width="380" height="300" alt="coffee">
                                        <div class="coffee-combo__item__content">
                                            <div class="coffee-combo__item__price"><?php the_field('catalog_item_price'); ?><span><?php the_field('catalog_item_past-price'); ?></span></div>
                                            <a href="<?php the_permalink(); ?>" class="coffee-combo__item__title"><?php the_title(); ?></a>
                                            <p class="coffee-combo__item__text"><?php the_field('catalog_item_info'); ?></p>
                                            <div class="coffee-combo__item__btns">
                                                <a href="<?php the_permalink(); ?>" class="coffee-combo__item__btn-1 btn btn-1">Купить</a>
                                                <a href="<?php the_permalink(); ?>" class="coffee-combo__item__btn-2 btn btn-2">Подробнее</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata(); ?>
                        </div>
                    <?php endif; ?>

                    <div class="swiper-button-next">
                        <svg>
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow"></use>
                        </svg>
                    </div>
                    <div class="swiper-button-prev">
                        <svg>
                            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#arrow"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>