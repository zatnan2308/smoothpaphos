<?php
/**
 * Smooth Studio — Footer
 * Pre-footer CTA + 4-column footer grid
 */

/* ── Глобальные данные ── */
$logo_text      = get_field( 'logo_text',      'option' ) ?: 'Smooth';
$logo_sub       = get_field( 'logo_subtitle',  'option' ) ?: 'Studio';
$address        = get_field( 'address',        'option' ) ?: '';
$phone          = get_field( 'phone_number',   'option' ) ?: '';
$footer_email   = get_field( 'footer_email',   'option' ) ?: '';
$instagram_url  = get_field( 'instagram_url',  'option' ) ?: '#';
$whatsapp_link  = get_field( 'whatsapp_link',  'option' ) ?: '#';
$copyright      = get_field( 'copyright_text', 'option' ) ?: wp_date( 'Y' ) . ' Smooth Studio. All rights reserved.';

/* ── CTA-секция ── */
$cta_heading    = get_field( 'footer_cta_heading',    'option' ) ?: 'Ready to feel';
$cta_heading_em = get_field( 'footer_cta_heading_em', 'option' ) ?: 'completely renewed?';
$cta_desc       = get_field( 'footer_cta_desc',       'option' ) ?: 'Join our community of beauty and wellness lovers. We\'re here to help you shine.';
$cta_btn_text   = get_field( 'footer_cta_btn_text',   'option' ) ?: 'Book Appointment';
$cta_btn_url    = get_field( 'footer_cta_btn_url',    'option' ) ?: ( get_field( 'booking_link', 'option' ) ?: '#' );

/* ── Колонки ── */
$col2_title = get_field( 'footer_col2_title', 'option' ) ?: 'Explore';
$col2_links = get_field( 'footer_col2_links', 'option' ) ?: array();
$col3_title = get_field( 'footer_col3_title', 'option' ) ?: 'Treatments';
$col3_links = get_field( 'footer_col3_links', 'option' ) ?: array();

/* ── Часы ── */
$hours_title = get_field( 'footer_hours_title', 'option' ) ?: 'Working Hours';
$hours_rows  = get_field( 'footer_hours',       'option' ) ?: array();
?>

<div class="footer-wrap">

    <!-- ══ Pre-footer CTA ══ -->
    <div class="footer-cta">
        <div class="footer-cta-inner">

            <!-- Текст -->
            <div class="footer-cta-text">
                <h2 class="footer-cta-heading">
                    <?php echo esc_html( $cta_heading ); ?><br>
                    <em><?php echo esc_html( $cta_heading_em ); ?></em>
                </h2>
                <?php if ( $cta_desc ) : ?>
                    <p class="footer-cta-desc"><?php echo esc_html( $cta_desc ); ?></p>
                <?php endif; ?>
            </div>

            <!-- Кнопка -->
            <a href="<?php echo esc_url( $cta_btn_url ); ?>" class="footer-cta-btn">
                <?php echo esc_html( $cta_btn_text ); ?>
                <?php echo smooth_icon( 'arrow-up-right', 16 ); ?>
            </a>

        </div>
        <hr class="footer-divider">
    </div><!-- .footer-cta -->

    <!-- ══ Footer Grid ══ -->
    <footer class="site-footer" role="contentinfo">
        <div class="footer-grid">

            <!-- ── Колонка 1: Логотип + контакты ── -->
            <div class="footer-col footer-col--brand">

                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo" aria-label="<?php echo esc_attr( $logo_text . $logo_sub ); ?>">
                    <span class="footer-logo-main"><?php echo esc_html( $logo_text ); ?></span><span class="footer-logo-sub"><?php echo esc_html( $logo_sub ); ?>.</span>
                </a>

                <ul class="footer-contact">
                    <?php if ( $address ) : ?>
                    <li>
                        <?php echo smooth_icon( 'map-pin', 14 ); ?>
                        <span><?php echo esc_html( $address ); ?></span>
                    </li>
                    <?php endif; ?>

                    <?php if ( $phone ) : ?>
                    <li>
                        <?php echo smooth_icon( 'phone', 14 ); ?>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', $phone ) ); ?>">
                            <?php echo esc_html( $phone ); ?>
                        </a>
                    </li>
                    <?php endif; ?>

                    <?php if ( $footer_email ) : ?>
                    <li>
                        <?php echo smooth_icon( 'mail', 14 ); ?>
                        <a href="mailto:<?php echo esc_attr( $footer_email ); ?>">
                            <?php echo esc_html( $footer_email ); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>

            </div><!-- .footer-col--brand -->

            <!-- ── Колонка 2: Ссылки (Explore) ── -->
            <div class="footer-col">
                <h3 class="footer-col-title"><?php echo esc_html( $col2_title ); ?></h3>
                <?php if ( $col2_links ) : ?>
                <ul class="footer-links">
                    <?php foreach ( $col2_links as $link ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>

            <!-- ── Колонка 3: Ссылки (Treatments) ── -->
            <div class="footer-col">
                <h3 class="footer-col-title"><?php echo esc_html( $col3_title ); ?></h3>
                <?php if ( $col3_links ) : ?>
                <ul class="footer-links">
                    <?php foreach ( $col3_links as $link ) : ?>
                    <li>
                        <a href="<?php echo esc_url( $link['url'] ); ?>"><?php echo esc_html( $link['label'] ); ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>

            <!-- ── Колонка 4: Часы работы + соцсети ── -->
            <div class="footer-col">
                <h3 class="footer-col-title"><?php echo esc_html( $hours_title ); ?></h3>

                <?php if ( $hours_rows ) : ?>
                <ul class="footer-hours">
                    <?php foreach ( $hours_rows as $row ) : ?>
                    <li>
                        <span class="hours-day"><?php echo esc_html( $row['day'] ); ?></span>
                        <?php if ( ! empty( $row['is_closed'] ) ) : ?>
                            <span class="hours-time hours-time--closed">
                                <?php echo ( ! empty( $row['hours_time'] ) ) ? esc_html( $row['hours_time'] ) : 'Closed'; ?>
                            </span>
                        <?php else : ?>
                            <span class="hours-time"><?php echo esc_html( $row['hours_time'] ); ?></span>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <!-- Соцсети -->
                <div class="footer-social">
                    <?php if ( $instagram_url && $instagram_url !== '#' ) : ?>
                    <a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener noreferrer"
                       class="footer-social-btn" aria-label="Instagram">
                        <?php echo smooth_icon( 'instagram', 18 ); ?>
                    </a>
                    <?php endif; ?>

                    <?php if ( $whatsapp_link && $whatsapp_link !== '#' ) : ?>
                    <a href="<?php echo esc_url( $whatsapp_link ); ?>" target="_blank" rel="noopener noreferrer"
                       class="footer-social-btn" aria-label="WhatsApp">
                        <?php echo smooth_icon( 'message-circle', 18 ); ?>
                    </a>
                    <?php endif; ?>
                </div>

            </div><!-- .footer-col (hours) -->

        </div><!-- .footer-grid -->

        <!-- Copyright -->
        <div class="footer-bottom">
            <p class="footer-copyright">&copy; <?php echo esc_html( $copyright ); ?></p>
        </div>

    </footer><!-- .site-footer -->

</div><!-- .footer-wrap -->

<?php wp_footer(); ?>
</body>
</html>
