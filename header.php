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
// Options Page data
$logo_text     = get_field( 'logo_text', 'option' ) ?: 'Smooth';
$logo_sub      = get_field( 'logo_subtitle', 'option' ) ?: 'Studio';
$booking_text  = get_field( 'booking_button_text', 'option' ) ?: 'Запись';
$booking_link  = get_field( 'booking_link', 'option' ) ?: '#';
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
        <div class="nav-links">
            <a href="#about" class="nav-link"><?php esc_html_e( 'О студии', 'smooth-theme' ); ?></a>
            <a href="#prices" class="nav-link"><?php esc_html_e( 'Цены', 'smooth-theme' ); ?></a>
            <a href="#master" class="nav-link"><?php esc_html_e( 'Мастер', 'smooth-theme' ); ?></a>
            <a href="#contacts" class="nav-link"><?php esc_html_e( 'Контакты', 'smooth-theme' ); ?></a>
        </div>

        <!-- Right side -->
        <div class="nav-right">
            <a href="<?php echo esc_url( $booking_link ); ?>" class="btn-booking"><?php echo esc_html( $booking_text ); ?></a>
            <button class="btn-menu" aria-label="Open menu">
                <?php echo smooth_icon( 'menu', 24 ); ?>
            </button>
        </div>

    </div>
</nav>

<!-- Mobile Menu Overlay -->
<div class="mobile-overlay" aria-hidden="true">
    <div class="mobile-menu">
        <button class="mobile-close" aria-label="Close menu">
            <?php echo smooth_icon( 'x', 24 ); ?>
        </button>
        <nav class="mobile-nav">
            <a href="#about"><?php esc_html_e( 'О студии', 'smooth-theme' ); ?></a>
            <a href="#prices"><?php esc_html_e( 'Цены', 'smooth-theme' ); ?></a>
            <a href="#master"><?php esc_html_e( 'Мастер', 'smooth-theme' ); ?></a>
            <a href="#contacts"><?php esc_html_e( 'Контакты', 'smooth-theme' ); ?></a>
        </nav>
    </div>
</div>
