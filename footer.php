<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package website-revo
 */

?>
<footer class="footer">
  <div class="footer__container container"><?php the_field("descr", "option"); ?></div>
</footer>
<?php wp_footer(); ?>
</body>

</html>