<?php
/**
 * Template Part: Philosophy Section
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$label    = get_field( 'philosophy_label' ) ?: 'Философия';
$title    = get_field( 'philosophy_title' ) ?: '';
$desc     = get_field( 'philosophy_description' ) ?: '';
$features = get_field( 'philosophy_features' );
?>

<section class="philosophy" id="about">
    <div class="container">

        <!-- Header -->
        <div class="philosophy-header">
            <span class="section-label"><?php echo esc_html( $label ); ?></span>
            <?php if ( $title ) : ?>
                <h2 class="philosophy-title font-serif"><?php echo esc_html( $title ); ?></h2>
            <?php endif; ?>
        </div>

        <!-- Grid -->
        <div class="philosophy-grid">
            <?php if ( $desc ) : ?>
                <p class="philosophy-desc"><?php echo esc_html( $desc ); ?></p>
            <?php endif; ?>

            <?php if ( is_array( $features ) && ! empty( $features ) ) : ?>
                <div class="philosophy-features">
                    <?php foreach ( $features as $feature ) : ?>
                        <div class="feature-item">
                            <div class="feature-icon">
                                <?php echo smooth_icon( $feature['icon'] ?: 'shield', 16 ); ?>
                            </div>
                            <p class="feature-text"><?php echo esc_html( $feature['text'] ?? '' ); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>
