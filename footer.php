<?php
/**
 * Footer
 */

$logo_text      = get_field( 'logo_text', 'option' ) ?: 'Smooth';
$logo_sub       = get_field( 'logo_subtitle', 'option' ) ?: 'Studio';
$copyright      = get_field( 'copyright_text', 'option' ) ?: wp_date( 'Y' ) . ' Smooth Studio. All rights reserved.';
$instagram_url  = get_field( 'instagram_url', 'option' ) ?: '#';
$whatsapp_link  = get_field( 'whatsapp_link', 'option' ) ?: '#';
?>

<footer class="site-footer">
    <div class="container">
        <div class="footer-inner">

            <!-- Logo -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
                <span class="logo-main" style="font-size: 1.125rem;"><?php echo esc_html( $logo_text ); ?></span>
                <span class="logo-sub" style="letter-spacing: 0.4em;"><?php echo esc_html( $logo_sub ); ?></span>
            </a>

            <!-- Copyright -->
            <p class="footer-copyright">&copy; <?php echo esc_html( $copyright ); ?></p>

            <!-- Socials -->
            <div class="footer-socials">
                <a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener" aria-label="Instagram">
                    <?php echo smooth_icon( 'instagram', 18 ); ?>
                </a>
                <a href="<?php echo esc_url( $whatsapp_link ); ?>" target="_blank" rel="noopener" aria-label="WhatsApp">
                    <?php echo smooth_icon( 'message-circle', 18 ); ?>
                </a>
            </div>

        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
