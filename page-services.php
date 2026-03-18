<?php
/**
 * Template Name: Services Page
 * Template Post Type: page
 */

get_header();
?>

<main class="site-main" id="main">
    <?php get_template_part( 'template-parts/section-page-hero' ); ?>
    <?php get_template_part( 'template-parts/section-services-content' ); ?>
    <?php get_template_part( 'template-parts/section-prices' ); ?>
    <?php get_template_part( 'template-parts/section-faq-contacts' ); ?>
</main>

<?php get_footer(); ?>
