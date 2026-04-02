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

/* ── Колонки ── */
$col2_title = get_field( 'footer_col2_title', 'option' ) ?: 'Explore';
$col2_links = get_field( 'footer_col2_links', 'option' ) ?: array();
$col3_title = get_field( 'footer_col3_title', 'option' ) ?: 'Treatments';
$col3_links = get_field( 'footer_col3_links', 'option' ) ?: array();

/* ── Часы ── */
$hours_title = get_field( 'footer_hours_title', 'option' ) ?: 'Working Hours';
$hours_rows  = get_field( 'footer_hours',       'option' ) ?: array();

/* ── Якорь ── */
$footer_anchor = sanitize_key( get_field( 'footer_anchor', 'option' ) ?: 'contacts' );
?>

<div class="footer-wrap">

    <!-- ══ Footer Grid ══ -->
    <footer class="site-footer" id="<?php echo esc_attr( $footer_anchor ); ?>" role="contentinfo">
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

<!-- ── Floating Buttons ── -->
<div class="float-wrap">
    <button class="scroll-top" id="js-scroll-top" type="button" aria-label="Back to top">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="2"
             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="m18 15-6-6-6 6"/>
        </svg>
    </button>
    <?php if ( $whatsapp_link && '#' !== $whatsapp_link ) : ?>
    <a href="<?php echo esc_url( $whatsapp_link ); ?>"
       class="float-phone"
       target="_blank" rel="noopener noreferrer"
       aria-label="WhatsApp">
        <span class="float-phone-pulse" aria-hidden="true"></span>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
             fill="currentColor" aria-hidden="true">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
        </svg>
    </a>
    <?php endif; ?>
</div>

<?php wp_footer(); ?>
</body>
</html>
