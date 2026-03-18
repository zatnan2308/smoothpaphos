<?php
/**
 * Template Name: About Page
 * Template Post Type: page
 */

get_header();
?>

<main class="site-main" id="main">
    <?php get_template_part( 'template-parts/section-page-hero' ); ?>
    <?php get_template_part( 'template-parts/section-about-content' ); ?>
    <?php get_template_part( 'template-parts/section-philosophy' ); ?>
    <?php get_template_part( 'template-parts/section-master' ); ?>
</main>

<?php get_footer(); ?>
