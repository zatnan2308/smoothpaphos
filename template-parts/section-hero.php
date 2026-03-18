<?php
/**
 * Template Part: Hero Section
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$badge      = get_field( 'hero_badge' ) ?: 'Paphos, Cyprus';
$title_1    = get_field( 'hero_title_1' ) ?: 'Smooth';
$title_2    = get_field( 'hero_title_2' ) ?: 'Experience';
$desc       = get_field( 'hero_description' ) ?: '<p>At Smooth Studio, each massage is individually tailored — for relaxation, recovery and lightness. We offer over ten techniques to help your body feel free and your mind — at peace.</p>';
$btn1_text  = get_field( 'hero_button_1_text' ) ?: 'Book via Direct';
$btn1_link  = get_field( 'hero_button_1_link' ) ?: 'https://instagram.com/smoothstudio.paphos';
$btn2_text  = get_field( 'hero_button_2_text' ) ?: 'Our Services';
$btn2_link  = get_field( 'hero_button_2_link' ) ?: '#prices';
$image      = get_field( 'hero_image' );
$card_title = get_field( 'hero_card_title' ) ?: 'Your Master';
$card_text  = get_field( 'hero_card_text' ) ?: '<p>Diana — massage therapist with 5+ years of experience.</p>';
?>

<section class="hero" id="hero">
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <?php if ( $badge ) : ?>
                    <div class="hero-badge"><?php echo esc_html( $badge ); ?></div>
                <?php endif; ?>
                <h1 class="hero-title">
                    <?php echo esc_html( $title_1 ); ?> <br>
                    <span><?php echo esc_html( $title_2 ); ?></span>
                </h1>
                <div class="hero-desc wysiwyg-content">
                    <?php echo smooth_wysiwyg( $desc ); ?>
                </div>
                <div class="hero-buttons">
                    <?php if ( $btn1_text ) : ?>
                        <a href="<?php echo esc_url( $btn1_link ); ?>" class="btn-primary"><?php echo esc_html( $btn1_text ); ?></a>
                    <?php endif; ?>
                    <?php if ( $btn2_text ) : ?>
                        <a href="<?php echo esc_url( $btn2_link ); ?>" class="btn-secondary"><?php echo esc_html( $btn2_text ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="hero-image-wrap">
                <?php if ( $image ) : ?>
                    <div class="hero-image">
                        <img src="<?php echo esc_url( $image['url'] ); ?>"
                             alt="<?php echo esc_attr( $image['alt'] ?: $title_1 ); ?>"
                             width="<?php echo esc_attr( $image['width'] ?? '' ); ?>"
                             height="<?php echo esc_attr( $image['height'] ?? '' ); ?>"
                             loading="eager"
                             fetchpriority="high"
                             decoding="async">
                    </div>
                <?php endif; ?>
                <?php if ( $card_title || $card_text ) : ?>
                    <div class="hero-card">
                        <?php if ( $card_title ) : ?>
                            <p class="hero-card-label"><?php echo esc_html( $card_title ); ?></p>
                        <?php endif; ?>
                        <?php if ( $card_text ) : ?>
                            <div class="hero-card-text wysiwyg-content">
                                <?php echo smooth_wysiwyg( $card_text ); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>