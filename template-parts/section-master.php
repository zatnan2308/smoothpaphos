<?php
/**
 * Template Part: Master Section
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$label = get_field( 'master_label' ) ?: 'Your Master';
$name  = get_field( 'master_name' ) ?: '';
$quote = get_field( 'master_quote' ) ?: '';
$image = get_field( 'master_image' );
$stats = get_field( 'master_stats' );
?>

<section class="master" id="master">
    <div class="container">
        <div class="master-grid">

            <!-- Image -->
            <div class="master-image-wrap">
                <?php if ( $image ) : ?>
                    <div class="master-image">
                        <img src="<?php echo esc_url( $image['url'] ); ?>"
                             alt="<?php echo esc_attr( $image['alt'] ?: $name ); ?>"
                             width="<?php echo esc_attr( $image['width'] ?? '' ); ?>"
                             height="<?php echo esc_attr( $image['height'] ?? '' ); ?>"
                             loading="lazy"
                             decoding="async">
                    </div>
                <?php endif; ?>
            </div>

            <!-- Content -->
            <div class="master-content">
                <span class="section-label"><?php echo esc_html( $label ); ?></span>

                <?php if ( $name ) : ?>
                    <h2 class="master-name"><?php echo esc_html( $name ); ?></h2>
                <?php endif; ?>

                <?php if ( $quote ) : ?>
                    <div class="master-quote wysiwyg-content">
                        <?php echo smooth_wysiwyg( $quote ); ?>
                    </div>
                <?php endif; ?>

                <?php if ( is_array( $stats ) && ! empty( $stats ) ) : ?>
                    <div class="master-stats">
                        <?php foreach ( $stats as $stat ) : ?>
                            <div class="stat-item">
                                <span class="stat-number font-serif"><?php echo esc_html( $stat['number'] ?? '' ); ?></span>
                                <p class="stat-label"><?php echo esc_html( $stat['label'] ?? '' ); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>
