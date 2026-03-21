<?php
/**
 * Template Part: Services Menu Section
 * Меню услуг с категориями, фото, списком — заменяет Price List на главной
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ── Шапка секции ── */
$label       = get_field( 'svc_menu_label' )       ?: 'SERVICE MENU';
$title_1     = get_field( 'svc_menu_title_1' )     ?: 'Wide range of';
$title_2     = get_field( 'svc_menu_title_2' )     ?: 'procedures';
$description = get_field( 'svc_menu_description' ) ?: 'We have gathered the best care techniques so you can find everything you need in one place. The art of caring for your body.';
$link_text   = get_field( 'svc_menu_link_text' )   ?: 'FULL PRICE LIST';
$link_url    = get_field( 'svc_menu_link_url' )    ?: '#prices';

/* ── Категории ── */
$categories = get_field( 'svc_menu_categories' );

if ( empty( $categories ) ) {
    $categories = array(
        array(
            'cat_icon'     => '🧘',
            'cat_name'     => 'Massage',
            'cat_image'    => null,
            'cat_services' => "Relax Massage\nSports Massage\nBack Massage\nAnti-cellulite Package\nFacial Massage\nFacial Mask\nDeep Tissue Massage\nAroma Massage\nAnti-cellulite Massage\nAphrodite's Touch\nLymphatic Massage",
        ),
        array(
            'cat_icon'     => '🪒',
            'cat_name'     => 'Hair Removal',
            'cat_image'    => null,
            'cat_services' => "Legs up to the knee\nClassic bikini\nArmpits\nFull hands\nComplex (hands + legs + bikini)\nFull legs\nFull bikini\nHands up to the elbow\nBelly / loin",
        ),
        array(
            'cat_icon'     => '💅',
            'cat_name'     => 'Nails',
            'cat_image'    => null,
            'cat_services' => "Nail Extensions\nNail Strengthening (Base)\nClassic Manicure\nPedicure\nFrench Sculpting\nNail Strengthening (Gel)",
        ),
        array(
            'cat_icon'     => '💆',
            'cat_name'     => 'Hair',
            'cat_image'    => null,
            'cat_services' => "Scalp Peeling\nFull Hair Reconstruction\nFlat Iron Styling\nCold Hair Restoration\nPre-keratin Base Mask\nHair Wash\nBlow Dry\nKeratin Botox",
        ),
    );
}
?>

<section class="svc-menu" id="services-menu">
    <div class="container">

        <!-- ── Шапка ── -->
        <div class="svc-menu-header">
            <div class="svc-menu-header-left">
                <span class="svc-menu-label">
                    <span class="svc-menu-label-line" aria-hidden="true"></span>
                    <?php echo esc_html( $label ); ?>
                </span>
                <h2 class="svc-menu-title">
                    <?php echo esc_html( $title_1 ); ?><br>
                    <em><?php echo esc_html( $title_2 ); ?></em>
                </h2>
            </div>
            <div class="svc-menu-header-right">
                <p class="svc-menu-desc"><?php echo esc_html( $description ); ?></p>
                <?php if ( $link_url && $link_text ) : ?>
                    <a href="<?php echo esc_url( $link_url ); ?>" class="svc-menu-link">
                        <?php echo esc_html( $link_text ); ?>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <hr class="svc-menu-divider">

        <!-- ── Категории услуг ── -->
        <?php if ( ! empty( $categories ) ) : ?>
            <div class="svc-menu-categories">
                <?php foreach ( $categories as $idx => $cat ) :

                    $is_even  = ( $idx % 2 === 0 );
                    $img      = $cat['cat_image'] ?? null;
                    $img_url  = '';
                    if ( is_array( $img ) ) {
                        $img_url = $img['sizes']['large'] ?? $img['url'] ?? '';
                    } elseif ( is_numeric( $img ) && $img ) {
                        $img_url = wp_get_attachment_image_url( $img, 'large' );
                    }

                    $icon     = $cat['cat_icon']     ?? '';
                    $name     = $cat['cat_name']     ?? '';
                    $raw      = trim( $cat['cat_services'] ?? '' );
                    $services = $raw
                        ? array_values( array_filter( array_map( 'trim', explode( "\n", $raw ) ) ) )
                        : array();

                    $half      = (int) ceil( count( $services ) / 2 );
                    $col_left  = array_slice( $services, 0, $half );
                    $col_right = array_slice( $services, $half );

                    $mod_class = $is_even ? 'svc-cat--img-left' : 'svc-cat--img-right';
                ?>
                <div class="svc-cat <?php echo esc_attr( $mod_class ); ?>">

                    <!-- Фото -->
                    <div class="svc-cat-photo<?php echo $img_url ? '' : ' svc-cat-photo--empty'; ?>">
                        <?php if ( $img_url ) : ?>
                            <img src="<?php echo esc_url( $img_url ); ?>"
                                 alt="<?php echo esc_attr( $name ); ?>"
                                 loading="lazy">
                        <?php endif; ?>
                    </div>

                    <!-- Контент -->
                    <div class="svc-cat-content">
                        <div class="svc-cat-head">
                            <?php if ( $icon ) : ?>
                                <span class="svc-cat-icon" aria-hidden="true"><?php echo esc_html( $icon ); ?></span>
                            <?php endif; ?>
                            <h3 class="svc-cat-name"><?php echo esc_html( $name ); ?></h3>
                        </div>

                        <?php if ( ! empty( $services ) ) : ?>
                            <div class="svc-cat-services">
                                <ul class="svc-cat-col">
                                    <?php foreach ( $col_left as $svc ) : ?>
                                        <li><?php echo esc_html( $svc ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <ul class="svc-cat-col">
                                    <?php foreach ( $col_right as $svc ) : ?>
                                        <li><?php echo esc_html( $svc ); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>
