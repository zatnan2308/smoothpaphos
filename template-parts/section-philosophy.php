<?php
/**
 * Template Part: Philosophy Section
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_anchor = sanitize_key( get_field( 'philosophy_anchor' ) ?: 'about' );

$label    = get_field( 'philosophy_label' ) ?: 'Philosophy';
$title    = get_field( 'philosophy_title' ) ?: 'More than ten techniques';
$desc     = get_field( 'philosophy_description' ) ?: '<p>At Smooth Studio we believe that every massage should be unique. We individually select each technique — for your mood, condition and goals. Every session is a step towards feeling light, restored and balanced.</p>';
$features = get_field( 'philosophy_features' );

if ( empty( $features ) ) {
    $features = array(
        array( 'icon' => 'heart',    'text' => 'Individual approach to every client' ),
        array( 'icon' => 'shield',   'text' => 'Professional quality guaranteed' ),
        array( 'icon' => 'star',     'text' => '5+ years of experience' ),
        array( 'icon' => 'check',    'text' => 'Over ten massage techniques' ),
        array( 'icon' => 'clock',    'text' => 'Sessions from 40 to 90 minutes' ),
        array( 'icon' => 'map-pin',  'text' => 'Cozy studio in central Paphos' ),
    );
}
?>

<section class="philosophy" id="<?php echo esc_attr( $section_anchor ); ?>"<?php echo smooth_section_bg( 'philosophy_section_bg' ); ?>>
    <div class="container">
        <div class="philosophy-header">
            <span class="section-label"><?php echo esc_html( $label ); ?></span>
            <?php if ( $title ) : ?>
                <h2 class="philosophy-title font-serif">
                    <?php echo smooth_heading( $title ); ?>
                </h2>
            <?php endif; ?>
        </div>
        <div class="philosophy-grid">
            <?php if ( $desc ) : ?>
                <div class="philosophy-desc wysiwyg-content">
                    <?php echo smooth_wysiwyg( $desc ); ?>
                </div>
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