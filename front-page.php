<?php
/**
 * Template: Front Page
 * Собирает все секции главной страницы
 */

get_header();
?>

<main class="site-main">
    <?php get_template_part( 'template-parts/section', 'hero' ); ?>
    <?php get_template_part( 'template-parts/section', 'services-menu' ); ?>
    <?php get_template_part( 'template-parts/section', 'home-prices' ); ?>
    <?php get_template_part( 'template-parts/section', 'master' ); ?>
    <?php get_template_part( 'template-parts/section', 'reviews' ); ?>
</main>

<?php get_footer(); ?>
