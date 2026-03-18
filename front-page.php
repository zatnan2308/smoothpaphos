<?php
/**
 * Template: Front Page
 * Собирает все секции главной страницы
 */

get_header();
?>

<main class="site-main">
    <?php get_template_part( 'template-parts/section', 'hero' ); ?>
    <?php get_template_part( 'template-parts/section', 'philosophy' ); ?>
    <?php get_template_part( 'template-parts/section', 'prices' ); ?>
    <?php get_template_part( 'template-parts/section', 'master' ); ?>
    <?php get_template_part( 'template-parts/section', 'faq-contacts' ); ?>
</main>

<?php get_footer(); ?>
