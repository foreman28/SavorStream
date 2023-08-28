<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package website-revo
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="page__html">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <?php wp_head(); ?>
</head>

<body class="page__body">
  <div class="site-container">
    <header class="header">
      <div class="header__container container">
        <?php the_custom_logo() ?>

        <?php
        wp_nav_menu([
          'menu_class'      => 'list-reset nav__list',
          'container_class' => '',
          'container'       => false,
          'items_wrap'      => '<div class="header__menu menu" data-menu><ul class="%2$s">%3$s</ul></div>',
          'walker' => new Custom_Menu_Walker(),
        ]);
        ?>

        <!-- <div class="header__menu menu" data-menu>
            <ul class="list-reset nav__list">
              <li class="page_item" data-menu-item><a href="#" class="nav__link">О нас</a></li>
              <li class="page_item" data-menu-item><a href="#" class="nav__link">Контакты</a></li>
            </ul>
        </div> -->

        <a href="<?php echo esc_url(get_page_link(185)); ?>" class="header__cart">
          <svg>
            <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/sprite.svg#cart"></use>
          </svg>
        </a>

        <button class="btn-reset burger header__burger" aria-label="Открыть меню" aria-expanded="false" data-burger>
          <span class="burger__line"></span>
        </button>
      </div>
    </header>