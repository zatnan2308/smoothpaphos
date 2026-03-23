<?php
/**
 * Template Part: Services Menu Section
 * Меню услуг с категориями, фото, списком — заменяет Price List на главной
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$section_anchor = sanitize_key( get_field( 'svc_menu_anchor' ) ?: 'services' );

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
            'cat_icon'        => '🧘',
            'cat_name'        => 'Massage',
            'cat_description' => 'The art of touch for complete restoration of strength and inner harmony.',
            'cat_link_url'    => '#booking',
            'cat_image'       => null,
            'cat_services'    => "Relax Massage\nSports Massage\nBack Massage\n**Anti-cellulite Package**\nFacial Massage\nFacial Mask\nDeep Tissue Massage\nAroma Massage\nAnti-cellulite Massage\nAphrodite's Touch\nLymphatic Massage",
        ),
        array(
            'cat_icon'        => '🪒',
            'cat_name'        => 'Hair Removal',
            'cat_description' => 'Impeccable skin smoothness and gentle care for your comfort.',
            'cat_link_url'    => '#booking',
            'cat_image'       => null,
            'cat_services'    => "Legs up to the knee\nClassic bikini\nArmpits\nFull hands\nFull legs\nFull bikini\nHands up to the elbow\n**Complex (hands + legs + bikini)**",
        ),
        array(
            'cat_icon'        => '💅',
            'cat_name'        => 'Nails',
            'cat_description' => 'Sophisticated nail art and premium manicure for radiant, elegant hands.',
            'cat_link_url'    => '#booking',
            'cat_image'       => null,
            'cat_services'    => "Nail Extensions\nNail Strengthening (Base)\nClassic Manicure\nPedicure\nFrench Sculpting\nNail Strengthening (Gel)",
        ),
        array(
            'cat_icon'        => '💆',
            'cat_name'        => 'Hair',
            'cat_description' => 'Professional hair care rituals for healthy, lustrous and vibrant locks.',
            'cat_link_url'    => '#booking',
            'cat_image'       => null,
            'cat_services'    => "Scalp Peeling\nFlat Iron Styling\nCold Hair Restoration\nHair Wash & Blow Dry\nFull Hair Reconstruction\nPre-keratin Base Mask\n**Keratin Botox**",
        ),
    );
}

/**
 * Парсит строку: **текст** → ['text' => ..., 'special' => true]
 */
function smooth_parse_svc_item( $raw ) {
    $raw = trim( $raw );
    if ( preg_match( '/^\*\*(.+)\*\*$/', $raw, $m ) ) {
        return array( 'text' => trim( $m[1] ), 'special' => true );
    }
    return array( 'text' => $raw, 'special' => false );
}
?>

<section class="svc-menu" id="<?php echo esc_attr( $section_anchor ); ?>"<?php echo smooth_section_bg( 'svc_menu_section_bg' ); ?>>
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

                    $name     = $cat['cat_name']        ?? '';
                    $cat_desc = $cat['cat_description'] ?? '';
                    $cat_link = $cat['cat_link_url']    ?? '#booking';
                    $raw      = trim( $cat['cat_services'] ?? '' );
                    $services = $raw
                        ? array_values( array_filter( array_map( 'trim', explode( "\n", $raw ) ) ) )
                        : array();

                    $half      = (int) ceil( count( $services ) / 2 );
                    $col_left  = array_slice( $services, 0, $half );
                    $col_right = array_slice( $services, $half );

                    $cat_works = $cat['cat_works'] ?? array();
                    $mod_class = $is_even ? 'svc-cat--img-left' : 'svc-cat--img-right';
                ?>
                <div class="svc-cat <?php echo esc_attr( $mod_class ); ?>">

                    <!-- Фото с бейджем -->
                    <div class="svc-cat-photo<?php echo $img_url ? '' : ' svc-cat-photo--empty'; ?>">
                        <?php if ( $img_url ) : ?>
                            <img src="<?php echo esc_url( $img_url ); ?>"
                                 alt="<?php echo esc_attr( $name ); ?>"
                                 loading="lazy">
                        <?php endif; ?>
                        <div class="svc-cat-badge" aria-hidden="true">
                            AUTHENTIC<br>CARE<br>SINCE 2024
                        </div>
                    </div>

                    <!-- Контент -->
                    <div class="svc-cat-content">

                        <h3 class="svc-cat-name"><?php echo esc_html( $name ); ?></h3>

                        <?php if ( $cat_desc ) : ?>
                            <p class="svc-cat-desc"><?php echo esc_html( $cat_desc ); ?></p>
                        <?php endif; ?>

                        <?php if ( ! empty( $services ) ) : ?>
                            <div class="svc-cat-services">
                                <ul class="svc-cat-col svc-cat-col--left">
                                    <?php foreach ( $col_left as $svc ) :
                                        $item = smooth_parse_svc_item( $svc );
                                    ?>
                                        <li class="<?php echo $item['special'] ? 'svc-item--special' : ''; ?>">
                                            <?php echo esc_html( $item['text'] ); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <ul class="svc-cat-col svc-cat-col--right">
                                    <?php foreach ( $col_right as $svc ) :
                                        $item = smooth_parse_svc_item( $svc );
                                    ?>
                                        <li class="<?php echo $item['special'] ? 'svc-item--special' : ''; ?>">
                                            <?php echo esc_html( $item['text'] ); ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <div class="svc-cat-btns">
                            <a href="<?php echo esc_url( $cat_link ); ?>" class="svc-cat-btn">
                                Book Online
                            </a>
                            <?php if ( ! empty( $cat_works ) ) : ?>
                            <button class="svc-work-btn" type="button"
                                    data-cat="<?php echo $idx; ?>"
                                    aria-haspopup="dialog">
                                Our Work
                            </button>
                            <?php endif; ?>
                        </div>

                    </div>

                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php
/* ═══════════════════════════════════════════════════════
   OUR WORK — Hidden data pools (one per category)
   ═══════════════════════════════════════════════════════ */
if ( ! empty( $categories ) ) :
    foreach ( $categories as $idx => $cat ) :
        $works = $cat['cat_works'] ?? array();
        if ( empty( $works ) ) continue;
        $cat_title = esc_attr( $cat['cat_name'] ?? 'Our Work' );
?>
<div class="works-pool" data-cat="<?php echo $idx; ?>" data-title="<?php echo $cat_title; ?>" hidden aria-hidden="true">
    <?php foreach ( $works as $work ) :
        $type    = $work['work_type']    ?? 'photo';
        $caption = esc_html( $work['work_caption'] ?? '' );

        if ( $type === 'photo' ) :
            $img   = $work['work_image'] ?? null;
            if ( ! $img ) continue;
            $thumb = is_array( $img ) ? ( $img['sizes']['medium_large'] ?? $img['sizes']['medium'] ?? $img['url'] ?? '' ) : wp_get_attachment_image_url( (int) $img, 'medium_large' );
            $full  = is_array( $img ) ? ( $img['url'] ?? '' ) : wp_get_attachment_image_url( (int) $img, 'full' );
    ?>
    <div class="works-item" data-type="photo" data-full="<?php echo esc_url( $full ); ?>">
        <img src="<?php echo esc_url( $thumb ); ?>"
             alt="<?php echo $caption ? $caption : $cat_title; ?>"
             loading="lazy">
        <?php if ( $caption ) : ?><span class="works-item-cap"><?php echo $caption; ?></span><?php endif; ?>
    </div>

    <?php elseif ( $type === 'video' ) :
        $vid = $work['work_video'] ?? null;
        if ( ! $vid ) continue;
        $vid_url = is_array( $vid ) ? ( $vid['url'] ?? '' ) : wp_get_attachment_url( (int) $vid );
    ?>
    <div class="works-item" data-type="video">
        <video src="<?php echo esc_url( $vid_url ); ?>"
               preload="none" playsinline loop muted></video>
        <?php if ( $caption ) : ?><span class="works-item-cap"><?php echo $caption; ?></span><?php endif; ?>
    </div>
    <?php endif; ?>

    <?php endforeach; ?>
</div>
<?php
    endforeach;
endif;
?>

<!-- ══════════════════════════════════════════
     OUR WORK — Modal
══════════════════════════════════════════ -->
<div class="works-modal-overlay" id="works-modal"
     role="dialog" aria-modal="true" aria-labelledby="works-modal-title" hidden>
    <div class="works-modal">
        <div class="works-modal-head">
            <h3 class="works-modal-title" id="works-modal-title">Our Work</h3>
            <button class="works-modal-close" type="button" aria-label="Close">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                    <path d="M18 6 6 18M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <div class="works-grid" id="works-grid">
            <!-- Populated by JS from the hidden pool -->
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════════
     OUR WORK — Lightbox
══════════════════════════════════════════ -->
<div class="works-lb" id="works-lb"
     role="dialog" aria-modal="true" aria-label="Photo lightbox" hidden>
    <button class="works-lb-close" type="button" aria-label="Close lightbox">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <path d="M18 6 6 18M6 6l12 12"/>
        </svg>
    </button>
    <button class="works-lb-prev" type="button" aria-label="Previous photo">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <path d="M19 12H5"/><path d="m12 5-7 7 7 7"/>
        </svg>
    </button>
    <button class="works-lb-next" type="button" aria-label="Next photo">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
             stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
            <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
        </svg>
    </button>
    <div class="works-lb-media" id="works-lb-media"></div>
</div>
