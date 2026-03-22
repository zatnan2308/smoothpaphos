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

            <!-- Текст — сверху по всей ширине -->
            <div class="footer-cta-text">
                <h2 class="footer-cta-heading">
                    <?php echo esc_html( $cta_heading ); ?><br>
                    <em><?php echo esc_html( $cta_heading_em ); ?></em>
                </h2>
                <?php if ( $cta_desc ) : ?>
                    <p class="footer-cta-desc"><?php echo esc_html( $cta_desc ); ?></p>
                <?php endif; ?>
            </div>

            <!-- Форма — на всю ширину ниже -->
            <div class="footer-cta-form">
                <div class="booking-form" id="booking-form" role="form" aria-label="Book a service">

                    <!-- ══════════════════════════════
                         STEP 1 — Выбор услуг
                    ══════════════════════════════ -->
                    <div class="bf-step is-active" data-step="1">

                        <div class="bf-s1-layout">

                            <!-- Боковой список категорий -->
                            <div class="bf-cats-wrap">
                                <p class="bf-cats-label">Categories</p>
                                <nav class="bf-cats" aria-label="Service categories">

                                    <button class="bf-cat is-active" data-cat="massage" type="button">
                                        <span class="bf-cat-cb" aria-hidden="true"></span>
                                        <span class="bf-cat-name-text">Massage</span>
                                        <span class="bf-badge" data-badge="massage"></span>
                                    </button>

                                    <button class="bf-cat" data-cat="depilation" type="button">
                                        <span class="bf-cat-cb" aria-hidden="true"></span>
                                        <span class="bf-cat-name-text">Sugaring &amp; Wax</span>
                                        <span class="bf-badge" data-badge="depilation"></span>
                                    </button>

                                    <button class="bf-cat" data-cat="nails" type="button">
                                        <span class="bf-cat-cb" aria-hidden="true"></span>
                                        <span class="bf-cat-name-text">Nails</span>
                                        <span class="bf-badge" data-badge="nails"></span>
                                    </button>

                                    <button class="bf-cat" data-cat="hair" type="button">
                                        <span class="bf-cat-cb" aria-hidden="true"></span>
                                        <span class="bf-cat-name-text">Hair</span>
                                        <span class="bf-badge" data-badge="hair"></span>
                                    </button>

                                </nav>
                            </div><!-- /.bf-cats-wrap -->

                            <!-- Сетка услуг -->
                            <div class="bf-panels">

                                <div class="bf-panel is-active" data-panel="massage">
                                    <?php foreach ( array(
                                        'Relax Massage', 'Deep Tissue Massage', 'Sports Massage',
                                        'Aroma Massage', 'Back Massage', 'Anti-cellulite Massage',
                                        "Aphrodite's Touch", 'Facial Massage', 'Lymphatic Massage',
                                        'Facial Mask',
                                    ) as $svc ) : ?>
                                    <label class="bf-svc">
                                        <input type="checkbox" value="<?php echo esc_attr( $svc ); ?>" data-cat="massage">
                                        <span class="bf-svc-name"><?php echo esc_html( $svc ); ?></span>
                                        <span class="bf-svc-check" aria-hidden="true"></span>
                                    </label>
                                    <?php endforeach; ?>
                                </div>

                                <div class="bf-panel" data-panel="depilation">
                                    <?php foreach ( array(
                                        'Legs up to the knee', 'Full legs', 'Classic bikini',
                                        'Full bikini', 'Armpits', 'Hands up to the elbow',
                                        'Full hands', 'Belly / Loin', 'Complex Package',
                                    ) as $svc ) : ?>
                                    <label class="bf-svc">
                                        <input type="checkbox" value="<?php echo esc_attr( $svc ); ?>" data-cat="depilation">
                                        <span class="bf-svc-name"><?php echo esc_html( $svc ); ?></span>
                                        <span class="bf-svc-check" aria-hidden="true"></span>
                                    </label>
                                    <?php endforeach; ?>
                                </div>

                                <div class="bf-panel" data-panel="nails">
                                    <?php foreach ( array(
                                        'Classic Manicure', 'Pedicure', 'Nail Extensions',
                                        'French Sculpting', 'Nail Strengthening (Base)',
                                        'Nail Strengthening (Gel)',
                                    ) as $svc ) : ?>
                                    <label class="bf-svc">
                                        <input type="checkbox" value="<?php echo esc_attr( $svc ); ?>" data-cat="nails">
                                        <span class="bf-svc-name"><?php echo esc_html( $svc ); ?></span>
                                        <span class="bf-svc-check" aria-hidden="true"></span>
                                    </label>
                                    <?php endforeach; ?>
                                </div>

                                <div class="bf-panel" data-panel="hair">
                                    <?php foreach ( array(
                                        'Blow Dry', 'Flat Iron Styling', 'Full Hair Reconstruction',
                                        'Scalp Peeling', 'Pre-keratin Base Mask', 'Hair Wash',
                                        'Cold Restoration', 'Keratin Botox',
                                    ) as $svc ) : ?>
                                    <label class="bf-svc">
                                        <input type="checkbox" value="<?php echo esc_attr( $svc ); ?>" data-cat="hair">
                                        <span class="bf-svc-name"><?php echo esc_html( $svc ); ?></span>
                                        <span class="bf-svc-check" aria-hidden="true"></span>
                                    </label>
                                    <?php endforeach; ?>
                                </div>

                            </div><!-- /.bf-panels -->
                        </div><!-- /.bf-s1-layout -->

                        <!-- Нижняя панель: счётчик + dots + кнопка -->
                        <div class="bf-actions">
                            <div class="bf-action-left">
                                <span class="bf-select-hint">Select services</span>
                                <div class="bf-dots" aria-hidden="true">
                                    <span class="bf-dot is-on"></span>
                                    <span class="bf-dot"></span>
                                    <span class="bf-dot"></span>
                                </div>
                            </div>
                            <button class="bf-cta-btn bf-next" data-next="2" type="button" disabled>
                                Continue
                            </button>
                        </div>

                    </div><!-- /step 1 -->

                    <!-- ══════════════════════════════
                         STEP 2 — Дата
                    ══════════════════════════════ -->
                    <div class="bf-step" data-step="2">
                        <div class="bf-step-body">
                            <p class="bf-step-heading">Visit Date</p>
                            <div class="bf-field-group">
                                <label class="bf-field-label" for="bf-date-input">Day of Visit *</label>
                                <input
                                    type="date"
                                    class="bf-date"
                                    id="bf-date-input"
                                    min="<?php echo esc_attr( gmdate( 'Y-m-d', strtotime( '+1 day' ) ) ); ?>"
                                    aria-label="Preferred appointment date"
                                >
                            </div>
                        </div>
                        <div class="bf-actions">
                            <div class="bf-action-left">
                                <div class="bf-dots" aria-hidden="true">
                                    <span class="bf-dot is-on"></span>
                                    <span class="bf-dot is-on"></span>
                                    <span class="bf-dot"></span>
                                </div>
                            </div>
                            <div class="bf-action-right">
                                <button class="bf-back" data-back="1" type="button">Back</button>
                                <button class="bf-cta-btn bf-next" data-next="3" type="button" disabled>Next</button>
                            </div>
                        </div>
                    </div><!-- /step 2 -->

                    <!-- ══════════════════════════════
                         STEP 3 — Контакты
                    ══════════════════════════════ -->
                    <div class="bf-step" data-step="3">
                        <div class="bf-step-body">
                            <p class="bf-step-heading">Contact Details</p>
                            <div class="bf-fields">
                                <div class="bf-field-group">
                                    <label class="bf-field-label" for="bf-name">Name *</label>
                                    <input type="text" class="bf-input" id="bf-name" placeholder="e.g. Maria" autocomplete="name" aria-label="Full name">
                                </div>
                                <div class="bf-field-group">
                                    <label class="bf-field-label" for="bf-phone">Phone *</label>
                                    <input type="tel" class="bf-input" id="bf-phone" placeholder="+357 XX XXX XXX" autocomplete="tel" aria-label="Phone number">
                                </div>
                                <div class="bf-field-group">
                                    <label class="bf-field-label" for="bf-email">Email *</label>
                                    <input type="email" class="bf-input" id="bf-email" placeholder="example@mail.com" autocomplete="email" aria-label="Email address">
                                </div>
                                <div class="bf-field-group bf-field-group--full">
                                    <label class="bf-field-label" for="bf-notes">Notes for the specialist</label>
                                    <textarea class="bf-input bf-textarea" id="bf-notes" placeholder="Allergies, preferences or special requests" aria-label="Additional notes"></textarea>
                                </div>
                            </div>
                            <p class="bf-error" id="bf-error-msg" hidden></p>
                        </div>
                        <div class="bf-actions">
                            <div class="bf-action-left">
                                <div class="bf-dots" aria-hidden="true">
                                    <span class="bf-dot is-on"></span>
                                    <span class="bf-dot is-on"></span>
                                    <span class="bf-dot is-on"></span>
                                </div>
                            </div>
                            <div class="bf-action-right">
                                <button class="bf-back" data-back="2" type="button">Back</button>
                                <button class="bf-cta-btn bf-submit" type="button">Confirm Booking</button>
                            </div>
                        </div>
                    </div><!-- /step 3 -->

                    <!-- ══════════════════════════════
                         SUCCESS
                    ══════════════════════════════ -->
                    <div class="bf-success" hidden>
                        <div class="bf-success-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                        </div>
                        <p class="bf-success-title">Request Sent!</p>
                        <p class="bf-success-msg">Thank you! We'll confirm your appointment shortly via phone or email.</p>
                    </div>

                </div><!-- /#booking-form -->
            </div><!-- .footer-cta-form -->

        </div><!-- .footer-cta-inner -->
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
