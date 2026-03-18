<?php
/**
 * Template Part: Inner Page Hero (shared)
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$title    = get_field( 'page_hero_title' ) ?: get_the_title();
$subtitle = get_field( 'page_hero_subtitle' );

// Smart subtitle fallback based on page template
if ( empty( $subtitle ) ) {
    $template = get_page_template_slug();
    if ( 'page-about.php' === $template ) {
        $subtitle = 'Our story, values and the hands behind every session';
    } elseif ( 'page-services.php' === $template ) {
        $subtitle = 'Massage, sugaring, nails and hair — all under one roof';
    } elseif ( 'page-contacts.php' === $template ) {
        $subtitle = 'Located in the heart of Paphos, Cyprus';
    }
}
?>

<section class="page-hero">
    <div class="container">
        <div class="page-hero-inner">
            <?php if ( $title ) : ?>
                <h1 class="page-hero-title font-serif">
                    <?php echo smooth_heading( $title ); ?>
                </h1>
            <?php endif; ?>
            <?php if ( $subtitle ) : ?>
                <p class="page-hero-subtitle"><?php echo esc_html( $subtitle ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>