<?php
/**
 * Template Part: Services — Intro Section
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$intro_label   = get_field( 'services_intro_label' ) ?: 'What We Offer';
$intro_title   = get_field( 'services_intro_title' ) ?: '';
$intro_content = get_field( 'services_intro_content' ) ?: '';
$categories    = get_field( 'services_categories' );
?>

<?php if ( $intro_title || $intro_content ) : ?>
<section class="services-intro">
    <div class="container">
        <div class="services-intro-grid">

            <div class="services-intro-header">
                <span class="section-label"><?php echo esc_html( $intro_label ); ?></span>
                <?php if ( $intro_title ) : ?>
                    <h2 class="services-intro-title font-serif">
                        <?php echo smooth_heading( $intro_title ); ?>
                    </h2>
                <?php endif; ?>
            </div>

            <?php if ( $intro_content ) : ?>
                <div class="services-intro-text wysiwyg-content">
                    <?php echo smooth_wysiwyg( $intro_content ); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
<?php endif; ?>

<!-- Service Categories -->
<?php if ( is_array( $categories ) && ! empty( $categories ) ) : ?>
<section class="services-categories">
    <div class="container">
        <div class="services-categories-grid">
            <?php foreach ( $categories as $cat ) : ?>
                <div class="service-category-item">
                    <?php if ( ! empty( $cat['icon'] ) ) : ?>
                        <div class="service-cat-icon">
                            <?php echo smooth_icon( $cat['icon'], 28 ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( ! empty( $cat['name'] ) ) : ?>
                        <h3 class="service-cat-name font-serif"><?php echo esc_html( $cat['name'] ); ?></h3>
                    <?php endif; ?>
                    <?php if ( ! empty( $cat['description'] ) ) : ?>
                        <div class="service-cat-desc wysiwyg-content">
                            <?php echo smooth_wysiwyg( $cat['description'] ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
