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
// Global Options
$logo_text     = get_field( 'logo_text', 'option' ) ?: 'Smooth';
$logo_sub      = get_field( 'logo_subtitle', 'option' ) ?: 'Studio';
$booking_text  = get_field( 'booking_button_text', 'option' ) ?: 'Book Now';
$booking_link  = get_field( 'booking_link', 'option' ) ?: '#';

// Fallback nav links — используются если меню не создано в WP Admin
$fallback_links = array(
    array( 'url' => home_url( '/#about' ),    'label' => 'About' ),
    array( 'url' => home_url( '/services/' ), 'label' => 'Services' ),
    array( 'url' => home_url( '/about/' ),    'label' => 'About Us' ),
    array( 'url' => home_url( '/contacts/' ), 'label' => 'Contacts' ),
);
?>

<!-- Navbar -->
<nav class="navbar" role="navigation" aria-label="Main navigation">
    <div class="navbar-inner">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
            <span class="logo-main"><?php echo esc_html( $logo_text ); ?></span>
            <span class="logo-sub"><?php echo esc_html( $logo_sub ); ?></span>
        </a>

        <!-- Desktop Nav -->
        <?php if ( has_nav_menu( 'primary' ) ) : ?>
            <?php wp_nav_menu( array(
                'theme_location'  => 'primary',
                'container'       => 'div',
                'container_class' => 'nav-links',
                'depth'           => 1,
                'walker'          => new Smooth_Nav_Walker(),
                'fallback_cb'     => false,
            ) ); ?>
        <?php else : ?>
            <div class="nav-links">
                <?php foreach ( $fallback_links as $link ) : ?>
                    <a href="<?php echo esc_url( $link['url'] ); ?>" class="nav-link">
                        <?php echo esc_html( $link['label'] ); ?>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Right side -->
        <div class="nav-right">
            <a href="<?php echo esc_url( $booking_link ); ?>" class="btn-booking">
                <?php echo esc_html( $booking_text ); ?>
            </a>
            <button class="btn-menu" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-overlay">
                <?php echo smooth_icon( 'menu', 24 ); ?>
            </button>
        </div>

    </div>
</nav>

<!-- Mobile Menu Overlay -->
<div class="mobile-overlay" id="mobile-overlay" aria-hidden="true" role="dialog" aria-label="Mobile navigation">
    <div class="mobile-menu">
        <button class="mobile-close" aria-label="Close menu">
            <?php echo smooth_icon( 'x', 24 ); ?>
        </button>
        <?php if ( has_nav_menu( 'mobile' ) ) : ?>
            <?php wp_nav_menu( array(
                'theme_location'  => 'mobile',
                'container'       => 'nav',
                'container_class' => 'mobile-nav',
                'depth'           => 1,
                'walker'          => new Smooth_Nav_Walker(),
                'fallback_cb'     => false,
            ) ); ?>
        <?php else : ?>
            <nav class="mobile-nav">
                <?php foreach ( $fallback_links as $link ) : ?>
                    <a href="<?php echo esc_url( $link['url'] ); ?>">
                        <?php echo esc_html( $link['label'] ); ?>
                    </a>
                <?php endforeach; ?>
            </nav>
        <?php endif; ?>
    </div>
</div>
