<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
/* ── Глобальные данные ── */
$logo_text     = get_field( 'logo_text',     'option' ) ?: 'Smooth';
$logo_sub      = get_field( 'logo_subtitle', 'option' ) ?: 'Studio';
$booking_text  = get_theme_mod( 'smooth_book_text', '' ) ?: get_field( 'booking_button_text', 'option' ) ?: 'Book Now';
$booking_link  = get_field( 'booking_link',  'option' ) ?: '#';

/* ── Данные для мобильного оверлея ── */
$mob_title    = get_field( 'mobile_nav_title',     'option' ) ?: 'Discover Smooth';
$mob_handle   = get_field( 'mobile_social_handle', 'option' ) ?: '@smoothstudio';
$mob_address  = get_field( 'address',              'option' ) ?: '';
$mob_phone    = get_field( 'phone_number',         'option' ) ?: '';
$mob_insta    = get_field( 'instagram_url',        'option' ) ?: '#';
$mob_wa       = get_field( 'whatsapp_link',        'option' ) ?: '#';

/* ── Fallback nav links ── */
$fallback_links = array(
    array( 'url' => home_url( '/services/' ), 'label' => 'Services' ),
    array( 'url' => home_url( '/about/' ),    'label' => 'About' ),
    array( 'url' => home_url( '/about/' ),    'label' => 'Master' ),
    array( 'url' => home_url( '/contacts/' ), 'label' => 'Contacts' ),
);
?>

<!-- ══ Navbar: floating pill ══ -->
<nav class="navbar" role="navigation" aria-label="Main navigation">
    <div class="navbar-pill">

        <!-- Logo — «Smooth» bold + «Studio.» light, одна строка -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-logo">
            <span class="logo-main"><?php echo esc_html( $logo_text ); ?></span><span class="logo-sub"><?php echo esc_html( $logo_sub ); ?>.</span>
        </a>

        <!-- Desktop Nav -->
        <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <?php wp_nav_menu( array(
                'theme_location'  => 'primary',
                'container'       => 'div',
                'container_class' => 'navbar-links',
                'items_wrap'      => '%3$s',
                'depth'           => 1,
                'walker'          => new Smooth_Nav_Walker(),
                'fallback_cb'     => false,
            ) ); ?>
        <?php else : ?>
            <div class="navbar-links">
                <?php foreach ( $fallback_links as $link ) : ?>
                    <a href="<?php echo esc_url( $link['url'] ); ?>" class="nav-link">
                        <?php echo esc_html( $link['label'] ); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Right: booking button + burger -->
        <div class="navbar-right">
            <a href="<?php echo esc_url( $booking_link ); ?>" class="navbar-book">
                <?php echo esc_html( $booking_text ); ?>
            </a>
            <button class="navbar-burger" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-overlay">
                <?php echo smooth_icon( 'menu', 22 ); ?>
            </button>
        </div>

    </div><!-- .navbar-pill -->
</nav><!-- .navbar -->

<!-- ══ Mobile Menu Overlay ══ -->
<div class="mobile-overlay" id="mobile-overlay" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Mobile navigation">

    <!-- Кнопка закрытия (абсолютная, поверх контента) -->
    <button class="mobile-close" aria-label="Close menu">
        <?php echo smooth_icon( 'x', 20 ); ?>
    </button>

    <div class="mobile-inner">

        <!-- Шапка: метка + заголовок -->
        <div class="mobile-header">
            <span class="mobile-label">Navigation</span>
            <p class="mobile-title"><?php echo esc_html( $mob_title ); ?></p>
        </div>

        <!-- Пункты меню -->
        <?php if ( has_nav_menu( 'mobile' ) ) : ?>
            <?php wp_nav_menu( array(
                'theme_location'  => 'mobile',
                'container'       => 'nav',
                'container_class' => 'mobile-nav',
                'items_wrap'      => '%3$s',
                'depth'           => 1,
                'walker'          => new Smooth_Nav_Walker(),
                'fallback_cb'     => false,
            ) ); ?>
        <?php else : ?>
            <nav class="mobile-nav">
                <?php foreach ( $fallback_links as $link ) : ?>
                    <a href="<?php echo esc_url( $link['url'] ); ?>" class="mobile-nav-item">
                        <span class="mobile-item-text"><?php echo esc_html( $link['label'] ); ?></span>
                        <span class="mobile-item-arrow"><?php echo smooth_icon( 'chevron-right', 16 ); ?></span>
                    </a>
                <?php endforeach; ?>
            </nav>
        <?php endif; ?>

        <!-- Подвал оверлея: контакты + соцсети -->
        <div class="mobile-footer">

            <?php if ( $mob_address || $mob_phone ) : ?>
            <div class="mobile-contacts">
                <?php if ( $mob_address ) : ?>
                <div class="mobile-contact-row">
                    <?php echo smooth_icon( 'map-pin', 14 ); ?>
                    <span><?php echo esc_html( $mob_address ); ?></span>
                </div>
                <?php endif; ?>
                <?php if ( $mob_phone ) : ?>
                <div class="mobile-contact-row">
                    <?php echo smooth_icon( 'phone', 14 ); ?>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', $mob_phone ) ); ?>">
                        <?php echo esc_html( $mob_phone ); ?>
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="mobile-socials">
                <div class="mobile-social-icons">
                    <?php if ( $mob_insta && $mob_insta !== '#' ) : ?>
                    <a href="<?php echo esc_url( $mob_insta ); ?>" target="_blank" rel="noopener noreferrer"
                       class="mobile-social-btn" aria-label="Instagram">
                        <?php echo smooth_icon( 'instagram', 18 ); ?>
                    </a>
                    <?php endif; ?>
                    <?php if ( $mob_wa && $mob_wa !== '#' ) : ?>
                    <a href="<?php echo esc_url( $mob_wa ); ?>" target="_blank" rel="noopener noreferrer"
                       class="mobile-social-btn" aria-label="WhatsApp">
                        <?php echo smooth_icon( 'message-circle', 18 ); ?>
                    </a>
                    <?php endif; ?>
                </div>
                <?php if ( $mob_handle ) : ?>
                <div class="mobile-social-text">
                    <span class="mobile-social-label">Join us on social</span>
                    <span class="mobile-social-handle"><?php echo esc_html( $mob_handle ); ?></span>
                </div>
                <?php endif; ?>
            </div>

        </div><!-- .mobile-footer -->

    </div><!-- .mobile-inner -->

</div><!-- .mobile-overlay -->
