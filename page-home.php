<?php
/**
 * Template Name: Home Page
 * Template Post Type: page
 *
 * Главная страница: Hero, Philosophy, Prices, Master, FAQ & Contacts
 */

get_header();
?>

<main class="site-main">
    <?php get_template_part( 'template-parts/section', 'hero' ); ?>
    <?php get_template_part( 'template-parts/section', 'philosophy' ); ?>
    <?php get_template_part( 'template-parts/section', 'prices' ); ?>
    <?php get_template_part( 'template-parts/section', 'master' ); ?>
</main>

<?php get_footer(); ?>
