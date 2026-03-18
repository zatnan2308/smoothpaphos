<?php
/**
 * Template Part: Page Hero — общий hero для внутренних страниц
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$title    = get_field( 'page_hero_title' ) ?: get_the_title();
$subtitle = get_field( 'page_hero_subtitle' ) ?: '';
$image    = get_field( 'page_hero_image' );
?>

<section class="page-hero">
    <div class="container">
        <div class="page-hero-inner">

            <div class="page-hero-content">
                <?php if ( $subtitle ) : ?>
                    <span class="section-label"><?php echo esc_html( $subtitle ); ?></span>
                <?php endif; ?>

                <h1 class="page-hero-title font-serif">
                    <?php echo smooth_heading( $title ); ?>
                </h1>
            </div>

            <?php if ( $image ) : ?>
                <div class="page-hero-image">
                    <img src="<?php echo esc_url( $image['url'] ); ?>"
                         alt="<?php echo esc_attr( $image['alt'] ?: get_the_title() ); ?>"
                         width="<?php echo esc_attr( $image['width'] ?? '' ); ?>"
                         height="<?php echo esc_attr( $image['height'] ?? '' ); ?>"
                         fetchpriority="high"
                         decoding="async">
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
