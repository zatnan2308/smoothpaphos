<?php
/**
 * Template Part: Reviews Section
 * Виджет отзывов (Trustindex или любой шорткод)
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$anchor    = sanitize_key( get_field( 'reviews_anchor' ) ?: 'reviews' );
$label     = get_field( 'reviews_label' )     ?: 'Reviews';
$title_1   = get_field( 'reviews_title_1' )   ?: 'What our';
$title_2   = get_field( 'reviews_title_2' )   ?: 'clients say';
$shortcode = get_field( 'reviews_shortcode' ) ?: '[trustindex no-registration=google]';
?>

<section class="reviews-section" id="<?php echo esc_attr( $anchor ); ?>">

    <!-- Заголовок внутри контейнера -->
    <div class="container">
        <div class="reviews-header">
            <?php if ( $label ) : ?>
            <p class="reviews-label">
                <span class="reviews-label-line" aria-hidden="true"></span>
                <?php echo esc_html( $label ); ?>
            </p>
            <?php endif; ?>

            <h2 class="reviews-title">
                <?php echo smooth_heading( $title_1 ); ?>
                <em><?php echo smooth_heading( $title_2 ); ?></em>
            </h2>
        </div>
    </div>

    <!-- Виджет на полную ширину страницы -->
    <div class="reviews-widget">
        <?php echo do_shortcode( $shortcode ); ?>
    </div>

</section>
