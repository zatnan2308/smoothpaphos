<?php
/**
 * Template Part: Hero Slider
 * Full-screen slider — pagination dots (bottom-left), arrows (bottom-right)
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$hero_anchor = sanitize_key( get_field( 'hero_anchor' ) ?: 'hero' );

/* ── ACF display settings ── */
$hero_content_width   = get_field( 'hero_content_width' );
$hero_title_font      = get_field( 'hero_title_font' );
$hero_title_size      = get_field( 'hero_title_size' );
$hero_desc_size       = get_field( 'hero_desc_size' );
$hero_btn_style       = get_field( 'hero_btn_style' );

/* ── ACF typography / colour overrides ── */
$hero_label_size     = get_field( 'hero_label_size' );
$hero_label_color    = get_field( 'hero_label_color' );
$hero_title_color    = get_field( 'hero_title_color' );
$hero_desc_color     = get_field( 'hero_desc_color' );
$hero_btn_font_size  = get_field( 'hero_btn_font_size' );
$hero_btn_bg_color   = get_field( 'hero_btn_bg_color' );
$hero_btn_text_color = get_field( 'hero_btn_text_color' );

$css_vars = array();

if ( $hero_content_width ) {
    if ( $hero_content_width === 'full' ) {
        $css_vars[] = '--hero-content-width: calc(100vw - 4rem)';
    } else {
        $css_vars[] = '--hero-content-width: min(' . intval( $hero_content_width ) . 'px, 90vw)';
    }
}

if ( $hero_title_font === 'sans' ) {
    $css_vars[] = '--hero-title-font: var(--font-sans)';
}

if ( $hero_title_size === 'sm' ) {
    $css_vars[] = '--hero-title-size: clamp(2.25rem, 6vw, 4.5rem)';
} elseif ( $hero_title_size === 'lg' ) {
    $css_vars[] = '--hero-title-size: clamp(4rem, 11vw, 8rem)';
}

if ( $hero_desc_size === 'sm' ) {
    $css_vars[] = '--hero-desc-size: 0.8125rem';
} elseif ( $hero_desc_size === 'lg' ) {
    $css_vars[] = '--hero-desc-size: 1.0625rem';
}

switch ( $hero_btn_style ) {
    case 'gold':
        $css_vars[] = '--hero-btn-bg: var(--gold)';
        $css_vars[] = '--hero-btn-color: #fff';
        $css_vars[] = '--hero-btn-border: none';
        $css_vars[] = '--hero-btn-hover-bg: var(--gold-light)';
        $css_vars[] = '--hero-btn-hover-color: #1a0a00';
        break;
    case 'outline-white':
        $css_vars[] = '--hero-btn-bg: transparent';
        $css_vars[] = '--hero-btn-color: #fff';
        $css_vars[] = '--hero-btn-border: 2px solid rgba(255,255,255,0.75)';
        $css_vars[] = '--hero-btn-hover-bg: #fff';
        $css_vars[] = '--hero-btn-hover-color: #1a0a00';
        break;
    case 'outline-gold':
        $css_vars[] = '--hero-btn-bg: transparent';
        $css_vars[] = '--hero-btn-color: var(--gold)';
        $css_vars[] = '--hero-btn-border: 2px solid var(--gold)';
        $css_vars[] = '--hero-btn-hover-bg: var(--gold)';
        $css_vars[] = '--hero-btn-hover-color: #fff';
        break;
}

/* ── Typography / colour overrides (applied after presets so they win) ── */
if ( $hero_label_size )     $css_vars[] = '--hero-label-size: '    . esc_attr( $hero_label_size );
if ( $hero_label_color )    $css_vars[] = '--hero-label-color: '   . esc_attr( $hero_label_color );
if ( $hero_title_color )    $css_vars[] = '--hero-title-color: '   . esc_attr( $hero_title_color );
if ( $hero_desc_color )     $css_vars[] = '--hero-desc-color: '    . esc_attr( $hero_desc_color );
if ( $hero_btn_font_size )  $css_vars[] = '--hero-btn-font-size: ' . esc_attr( $hero_btn_font_size );
if ( $hero_btn_bg_color )   $css_vars[] = '--hero-btn-bg: '        . esc_attr( $hero_btn_bg_color );
if ( $hero_btn_text_color ) $css_vars[] = '--hero-btn-color: '     . esc_attr( $hero_btn_text_color );

/* ── ACF slides repeater (primary source) ── */
$slides_acf = get_field( 'hero_slides' );

/* ── Build slide-1 from legacy hero ACF fields ── */
$legacy = array(
    'slide_label'       => get_field( 'hero_badge' )         ?: 'Smooth Experience',
    'slide_title_1'     => get_field( 'hero_title_1' )       ?: 'Your Body,',
    'slide_title_2'     => get_field( 'hero_title_2' )       ?: 'Your Balance',
    'slide_description' => get_field( 'hero_description' )   ?: '<p>Individually tailored massage — for relaxation, recovery and ease of your body.</p>',
    'slide_btn_text'    => get_field( 'hero_button_1_text' ) ?: 'Book a Session',
    'slide_btn_link'    => get_field( 'hero_button_1_link' ) ?: 'https://instagram.com/smoothstudio.paphos',
    'slide_image'       => get_field( 'hero_image' ),
);

/* ── Fallback demo slides ── */
$fallback_slides = array(
    $legacy,
    array(
        'slide_label'       => 'Massage Therapy',
        'slide_title_1'     => 'Deep Tissue',
        'slide_title_2'     => 'Healing',
        'slide_description' => '<p>Targeted techniques to release tension, restore mobility and revive your energy.</p>',
        'slide_btn_text'    => 'Our Services',
        'slide_btn_link'    => home_url( '/services/' ),
        'slide_image'       => null,
    ),
    array(
        'slide_label'       => 'Skin & Beauty',
        'slide_title_1'     => 'Radiant',
        'slide_title_2'     => 'Confidence',
        'slide_description' => '<p>Professional skin care, nails and hair styling — all in one cozy studio in Paphos.</p>',
        'slide_btn_text'    => 'View Prices',
        'slide_btn_link'    => home_url( '/#prices' ),
        'slide_image'       => null,
    ),
);

$slides = ! empty( $slides_acf ) ? $slides_acf : $fallback_slides;
$total  = count( $slides );
?>

<?php if ( ! empty( $css_vars ) ) : ?>
<style>.hero-slider{<?php echo implode( ';', $css_vars ); ?>}</style>
<?php endif; ?>
<section class="hero-slider" id="<?php echo esc_attr( $hero_anchor ); ?>" aria-label="Hero slider">

    <!-- ══ Slides ══ -->
    <div class="slider-track">
        <?php foreach ( $slides as $i => $slide ) :
            $active   = ( $i === 0 );
            $img      = $slide['slide_image'] ?? null;
            $bg_url   = '';
            if ( $img ) {
                $bg_url = is_array( $img ) ? esc_url( $img['url'] ?? '' ) : esc_url( $img );
            }
            $label    = esc_html( $slide['slide_label']           ?? '' );
            $title_1  = $slide['slide_title_1']                   ?? '';
            $title_2  = $slide['slide_title_2']                   ?? '';
            $desc     = wp_kses_post( $slide['slide_description'] ?? '' );
            $btn_text = esc_html( $slide['slide_btn_text']        ?? '' );
            $btn_link = esc_url( $slide['slide_btn_link']         ?? '#' );
        ?>
        <div class="slide<?php echo $active ? ' is-active' : ''; ?>"
             aria-hidden="<?php echo $active ? 'false' : 'true'; ?>">

            <!-- Background -->
            <?php if ( $bg_url ) : ?>
                <div class="slide-bg" style="background-image:url('<?php echo $bg_url; ?>')"></div>
            <?php else : ?>
                <div class="slide-bg slide-bg--grad-<?php echo $i % 3; ?>"></div>
            <?php endif; ?>
            <div class="slide-overlay"></div>

            <!-- Content -->
            <div class="slide-content">
                <?php if ( $label ) : ?>
                    <span class="slide-label"><?php echo $label; ?></span>
                <?php endif; ?>

                <h1 class="slide-title">
                    <span class="slide-title-line"><?php echo smooth_heading( $title_1 ); ?></span>
                    <em   class="slide-title-line slide-title-italic"><?php echo smooth_heading( $title_2 ); ?></em>
                </h1>

                <?php if ( $desc ) : ?>
                    <div class="slide-desc wysiwyg-content"><?php echo $desc; ?></div>
                <?php endif; ?>

                <?php if ( $btn_text ) : ?>
                    <a href="<?php echo $btn_link; ?>" class="slide-btn"><?php echo $btn_text; ?></a>
                <?php endif; ?>
            </div>

        </div>
        <?php endforeach; ?>
    </div><!-- .slider-track -->

    <?php if ( $total > 1 ) : ?>

    <!-- ══ Pagination — bottom left ══ -->
    <div class="slider-pagination" role="tablist" aria-label="Slider pagination">
        <?php for ( $i = 0; $i < $total; $i++ ) : ?>
            <button class="pag-dot<?php echo $i === 0 ? ' is-active' : ''; ?>"
                    role="tab"
                    aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                    aria-label="Slide <?php echo $i + 1; ?>"
                    data-slide="<?php echo $i; ?>"></button>
        <?php endfor; ?>
    </div>

    <!-- ══ Arrows — bottom right ══ -->
    <div class="slider-arrows">
        <button class="slider-prev" aria-label="Previous slide">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5"/><path d="m12 5-7 7 7 7"/>
            </svg>
        </button>
        <button class="slider-next" aria-label="Next slide">
            <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2"
                 stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
            </svg>
        </button>
    </div>

    <?php endif; ?>

</section><!-- .hero-slider -->
