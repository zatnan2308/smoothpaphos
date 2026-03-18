<?php
/**
 * Template Part: About — Story Section
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$story_label   = get_field( 'about_story_label' ) ?: 'Our Story';
$story_title   = get_field( 'about_story_title' ) ?: '';
$story_content = get_field( 'about_story_content' ) ?: '';
$story_image   = get_field( 'about_story_image' );

$values_title  = get_field( 'about_values_title' ) ?: 'Our Values';
$values        = get_field( 'about_values' );

$cta_text      = get_field( 'about_cta_text' ) ?: '';
$cta_btn_text  = get_field( 'about_cta_button_text' ) ?: 'Book a Session';
$cta_btn_link  = get_field( 'about_cta_button_link' ) ?: '#';
?>

<!-- Story Section -->
<?php if ( $story_title || $story_content || $story_image ) : ?>
<section class="about-story">
    <div class="container">
        <div class="about-story-grid">

            <div class="about-story-content">
                <span class="section-label"><?php echo esc_html( $story_label ); ?></span>

                <?php if ( $story_title ) : ?>
                    <h2 class="about-story-title font-serif">
                        <?php echo smooth_heading( $story_title ); ?>
                    </h2>
                <?php endif; ?>

                <?php if ( $story_content ) : ?>
                    <div class="about-story-text wysiwyg-content">
                        <?php echo smooth_wysiwyg( $story_content ); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ( $story_image ) : ?>
                <div class="about-story-image-wrap">
                    <div class="about-story-image">
                        <img src="<?php echo esc_url( $story_image['url'] ); ?>"
                             alt="<?php echo esc_attr( $story_image['alt'] ?: $story_label ); ?>"
                             width="<?php echo esc_attr( $story_image['width'] ?? '' ); ?>"
                             height="<?php echo esc_attr( $story_image['height'] ?? '' ); ?>"
                             loading="lazy"
                             decoding="async">
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php endif; ?>

<!-- Values Section -->
<?php if ( is_array( $values ) && ! empty( $values ) ) : ?>
<section class="about-values">
    <div class="container">

        <h2 class="about-values-title font-serif">
            <?php echo smooth_heading( $values_title ); ?>
        </h2>

        <div class="about-values-grid">
            <?php foreach ( $values as $item ) : ?>
                <div class="value-item">
                    <?php if ( ! empty( $item['icon'] ) ) : ?>
                        <div class="value-icon">
                            <?php echo smooth_icon( $item['icon'], 24 ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $item['title'] ) ) : ?>
                        <h4 class="value-title"><?php echo esc_html( $item['title'] ); ?></h4>
                    <?php endif; ?>
                    <?php if ( ! empty( $item['text'] ) ) : ?>
                        <div class="value-text wysiwyg-content">
                            <?php echo smooth_wysiwyg( $item['text'] ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<?php if ( $cta_text || $cta_btn_text ) : ?>
<section class="page-cta">
    <div class="container">
        <div class="page-cta-inner">
            <?php if ( $cta_text ) : ?>
                <div class="page-cta-text wysiwyg-content">
                    <?php echo smooth_wysiwyg( $cta_text ); ?>
                </div>
            <?php endif; ?>
            <?php if ( $cta_btn_text ) : ?>
                <a href="<?php echo esc_url( $cta_btn_link ); ?>" class="btn-primary">
                    <?php echo esc_html( $cta_btn_text ); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php endif; ?>
