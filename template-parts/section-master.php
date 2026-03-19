<?php
/**
 * Template Part: Master Section
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$label    = get_field( 'master_label' ) ?: 'Your Master';
$title    = get_field( 'master_name' ) ?: 'Diana';
$subtitle = 'Massage therapist & beauty specialist';
$bio      = '<p>Diana has been practising massage therapy for over 5 years, combining classical techniques with a deeply personal approach. Each session is tailored to your needs — whether you seek relaxation, recovery or balance.</p>';
$image    = get_field( 'master_image' );
$quote    = get_field( 'master_quote' ) ?: 'I believe the body knows how to heal — my role is to help it remember.';

$stats = get_field( 'master_stats' );
if ( empty( $stats ) ) {
    $stats = array(
        array( 'number' => '5+',   'label' => 'Years of experience' ),
        array( 'number' => '10+',  'label' => 'Massage techniques' ),
        array( 'number' => '500+', 'label' => 'Happy clients' ),
    );
}
?>

<section class="master" id="master">
    <div class="container">
        <div class="master-grid">
            <div class="master-image-wrap">
                <?php if ( $image ) : ?>
                    <div class="master-image">
                        <img src="<?php echo esc_url( $image['url'] ); ?>"
                             alt="<?php echo esc_attr( $image['alt'] ?: $title ); ?>"
                             width="<?php echo esc_attr( $image['width'] ?? '' ); ?>"
                             height="<?php echo esc_attr( $image['height'] ?? '' ); ?>"
                             loading="lazy"
                             decoding="async">
                    </div>
                <?php endif; ?>
                <?php if ( $stats ) : ?>
                    <div class="master-stats">
                        <?php foreach ( $stats as $stat ) : ?>
                            <div class="stat-item">
                                <span class="stat-value"><?php echo esc_html( $stat['number'] ?? '' ); ?></span>
                                <span class="stat-label"><?php echo esc_html( $stat['label'] ?? '' ); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="master-content">
                <span class="section-label"><?php echo esc_html( $label ); ?></span>
                <?php if ( $title ) : ?>
                    <h2 class="master-name font-serif"><?php echo esc_html( $title ); ?></h2>
                <?php endif; ?>
                <?php if ( $subtitle ) : ?>
                    <p class="master-subtitle"><?php echo esc_html( $subtitle ); ?></p>
                <?php endif; ?>
                <?php if ( $bio ) : ?>
                    <div class="master-bio wysiwyg-content">
                        <?php echo smooth_wysiwyg( $bio ); ?>
                    </div>
                <?php endif; ?>
                <?php if ( $quote ) : ?>
                    <blockquote class="master-quote">
                        <?php echo esc_html( $quote ); ?>
                    </blockquote>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>