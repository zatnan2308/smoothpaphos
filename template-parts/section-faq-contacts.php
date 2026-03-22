<?php
/**
 * Template Part: FAQ + Contacts Section
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$faq_label = get_field( 'faq_label' ) ?: 'FAQ';
$faq_title = get_field( 'faq_title' ) ?: 'Common questions';
$faq_items = get_field( 'faq_items' );

if ( empty( $faq_items ) ) {
    $faq_items = array(
        array(
            'question' => 'How do I book a session?',
            'answer'   => '<p>The easiest way is via Instagram Direct — @smoothstudio.paphos. You can also reach us by WhatsApp. We will confirm your time and send the studio address.</p>',
        ),
        array(
            'question' => 'How long is a session?',
            'answer'   => "<p>Sessions run from 30 minutes (express head, neck and shoulders) to 90 minutes (full-body or signature Aphrodite\u{2019}s Touch). You choose the duration that suits you best.</p>",
        ),
        array(
            'question' => 'Do I need to prepare anything?',
            'answer'   => '<p>No special preparation is needed. We recommend arriving 5 minutes early, avoiding a heavy meal beforehand, and letting Diana know about any injuries or health conditions.</p>',
        ),
        array(
            'question' => 'What is included in the price?',
            'answer'   => '<p>The price includes the full session, premium massage oils, disposable linen and a complimentary herbal tea afterwards.</p>',
        ),
        array(
            'question' => 'Can I choose the massage pressure?',
            'answer'   => '<p>Absolutely. Diana will adjust the pressure to your preference at any point during the session. Your comfort is the priority.</p>',
        ),
        array(
            'question' => 'Do you offer gift certificates?',
            'answer'   => '<p>Yes! Gift certificates are available for any service or amount. Contact us via Instagram or WhatsApp to arrange one.</p>',
        ),
    );
}

$contact_label    = get_field( 'contact_label' ) ?: 'Contact';
$contact_title    = get_field( 'contact_title' ) ?: 'Get in touch';
$contact_desc     = get_field( 'contact_desc' ) ?: '<p>Ready to book or have a question? Reach out via Instagram or WhatsApp — we reply quickly.</p>';
$contact_btn_text = get_field( 'contact_btn_text' ) ?: 'Write on WhatsApp';
$contact_btn_link = get_field( 'contact_btn_link' ) ?: get_field( 'whatsapp_link', 'option' ) ?: '#';
$address          = get_field( 'address', 'option' );
$instagram        = get_field( 'instagram_url', 'option' );
$whatsapp         = get_field( 'whatsapp_link', 'option' );
?>

<section class="faq-contacts" id="faq"<?php echo smooth_section_bg( 'faq_section_bg' ); ?>>
    <div class="container">
        <div class="faq-contacts-grid">

            <div class="faq-col">
                <div class="faq-header">
                    <span class="section-label"><?php echo esc_html( $faq_label ); ?></span>
                    <?php if ( $faq_title ) : ?>
                        <h2 class="faq-title font-serif">
                            <?php echo smooth_heading( $faq_title ); ?>
                        </h2>
                    <?php endif; ?>
                </div>
                <?php if ( is_array( $faq_items ) && ! empty( $faq_items ) ) : ?>
                    <div class="faq-list">
                        <?php foreach ( $faq_items as $item ) : ?>
                            <div class="faq-item">
                                <button class="faq-question" aria-expanded="false">
                                    <?php echo esc_html( $item['question'] ?? '' ); ?>
                                    <span class="faq-icon" aria-hidden="true"></span>
                                </button>
                                <div class="faq-answer">
                                    <div class="wysiwyg-content">
                                        <?php echo smooth_wysiwyg( $item['answer'] ?? '' ); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="contacts-col">
                <div class="contact-card">
                    <span class="section-label"><?php echo esc_html( $contact_label ); ?></span>
                    <?php if ( $contact_title ) : ?>
                        <h2 class="contact-title font-serif">
                            <?php echo smooth_heading( $contact_title ); ?>
                        </h2>
                    <?php endif; ?>
                    <?php if ( $contact_desc ) : ?>
                        <div class="contact-desc wysiwyg-content">
                            <?php echo smooth_wysiwyg( $contact_desc ); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ( $address ) : ?>
                        <p class="contact-address">
                            <?php echo smooth_icon( 'map-pin', 16 ); ?>
                            <?php echo esc_html( $address ); ?>
                        </p>
                    <?php endif; ?>
                    <?php if ( $instagram ) : ?>
                        <a href="<?php echo esc_url( $instagram ); ?>" class="contact-social" target="_blank" rel="noopener noreferrer">
                            <?php echo smooth_icon( 'instagram', 16 ); ?>
                            @smoothstudio.paphos
                        </a>
                    <?php endif; ?>
                    <!-- ═══════════════════════════════════════════
                         MULTI-STEP BOOKING FORM
                         Email sent via wp_mail() — no plugin needed
                    ════════════════════════════════════════════ -->
                    <div class="booking-form" id="booking-form" role="form" aria-label="Book a service">

                        <!-- ── Progress dots ── -->
                        <div class="bf-progress" aria-hidden="true">
                            <div class="bf-progress-step is-active" data-step="1">1</div>
                            <div class="bf-progress-line"></div>
                            <div class="bf-progress-step" data-step="2">2</div>
                            <div class="bf-progress-line"></div>
                            <div class="bf-progress-step" data-step="3">3</div>
                        </div>

                        <!-- ══════════════════════
                             STEP 1 — Services
                        ══════════════════════ -->
                        <div class="bf-step is-active" data-step="1">
                            <span class="bf-step-meta">Step 1 of 3</span>
                            <p class="bf-step-heading">Select services</p>

                            <div class="bf-s1-layout">

                                <!-- Category sidebar -->
                                <nav class="bf-cats" aria-label="Service categories">
                                    <button class="bf-cat is-active" data-cat="massage" type="button">
                                        Massage
                                        <span class="bf-badge" data-badge="massage"></span>
                                    </button>
                                    <button class="bf-cat" data-cat="depilation" type="button">
                                        Depilation
                                        <span class="bf-badge" data-badge="depilation"></span>
                                    </button>
                                    <button class="bf-cat" data-cat="nails" type="button">
                                        Nails
                                        <span class="bf-badge" data-badge="nails"></span>
                                    </button>
                                    <button class="bf-cat" data-cat="hair" type="button">
                                        Hair Studio
                                        <span class="bf-badge" data-badge="hair"></span>
                                    </button>
                                </nav>

                                <!-- Service panels -->
                                <div class="bf-panels">

                                    <div class="bf-panel is-active" data-panel="massage">
                                        <?php foreach ( array(
                                            'Relax Massage',
                                            'Deep Tissue Massage',
                                            'Sports Massage',
                                            'Aroma Massage',
                                            'Back Massage',
                                            'Anti-cellulite Massage',
                                            "Aphrodite's Touch",
                                            'Facial Massage',
                                            'Lymphatic Massage',
                                        ) as $svc ) : ?>
                                        <label class="bf-svc">
                                            <input type="checkbox" value="<?php echo esc_attr( $svc ); ?>" data-cat="massage">
                                            <span class="bf-svc-check" aria-hidden="true"></span>
                                            <span class="bf-svc-name"><?php echo esc_html( $svc ); ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="bf-panel" data-panel="depilation">
                                        <?php foreach ( array(
                                            'Legs up to the knee',
                                            'Full legs',
                                            'Classic bikini',
                                            'Full bikini',
                                            'Armpits',
                                            'Hands up to the elbow',
                                            'Full hands',
                                            'Complex Package',
                                        ) as $svc ) : ?>
                                        <label class="bf-svc">
                                            <input type="checkbox" value="<?php echo esc_attr( $svc ); ?>" data-cat="depilation">
                                            <span class="bf-svc-check" aria-hidden="true"></span>
                                            <span class="bf-svc-name"><?php echo esc_html( $svc ); ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="bf-panel" data-panel="nails">
                                        <?php foreach ( array(
                                            'Classic Manicure',
                                            'Pedicure',
                                            'Nail Extensions',
                                            'Nail Strengthening',
                                            'French Sculpting',
                                        ) as $svc ) : ?>
                                        <label class="bf-svc">
                                            <input type="checkbox" value="<?php echo esc_attr( $svc ); ?>" data-cat="nails">
                                            <span class="bf-svc-check" aria-hidden="true"></span>
                                            <span class="bf-svc-name"><?php echo esc_html( $svc ); ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>

                                    <div class="bf-panel" data-panel="hair">
                                        <?php foreach ( array(
                                            'Blow Dry',
                                            'Flat Iron Styling',
                                            'Full Hair Reconstruction',
                                            'Scalp Peeling',
                                            'Cold Restoration',
                                            'Keratin Botox',
                                        ) as $svc ) : ?>
                                        <label class="bf-svc">
                                            <input type="checkbox" value="<?php echo esc_attr( $svc ); ?>" data-cat="hair">
                                            <span class="bf-svc-check" aria-hidden="true"></span>
                                            <span class="bf-svc-name"><?php echo esc_html( $svc ); ?></span>
                                        </label>
                                        <?php endforeach; ?>
                                    </div>

                                </div><!-- /.bf-panels -->
                            </div><!-- /.bf-s1-layout -->

                            <div class="bf-actions">
                                <span class="bf-select-hint">Select at least one service</span>
                                <button class="btn-primary bf-next" data-next="2" type="button" disabled>
                                    Continue →
                                </button>
                            </div>
                        </div><!-- /step 1 -->

                        <!-- ══════════════════════
                             STEP 2 — Date
                        ══════════════════════ -->
                        <div class="bf-step" data-step="2">
                            <span class="bf-step-meta">Step 2 of 3</span>
                            <p class="bf-step-heading">Choose a preferred date</p>

                            <input
                                type="date"
                                class="bf-date"
                                id="bf-date-input"
                                min="<?php echo esc_attr( gmdate( 'Y-m-d', strtotime( '+1 day' ) ) ); ?>"
                                aria-label="Preferred appointment date"
                            >

                            <div class="bf-actions">
                                <button class="bf-back" data-back="1" type="button">← Back</button>
                                <button class="btn-primary bf-next" data-next="3" type="button" disabled>
                                    Continue →
                                </button>
                            </div>
                        </div><!-- /step 2 -->

                        <!-- ══════════════════════
                             STEP 3 — Contact details
                        ══════════════════════ -->
                        <div class="bf-step" data-step="3">
                            <span class="bf-step-meta">Step 3 of 3</span>
                            <p class="bf-step-heading">Your details</p>

                            <div class="bf-fields">
                                <input
                                    type="text"
                                    class="bf-input"
                                    id="bf-name"
                                    placeholder="Full name *"
                                    autocomplete="name"
                                    aria-label="Full name"
                                >
                                <input
                                    type="tel"
                                    class="bf-input"
                                    id="bf-phone"
                                    placeholder="Phone number *"
                                    autocomplete="tel"
                                    aria-label="Phone number"
                                >
                                <input
                                    type="email"
                                    class="bf-input"
                                    id="bf-email"
                                    placeholder="Email address (optional)"
                                    autocomplete="email"
                                    aria-label="Email address"
                                >
                                <textarea
                                    class="bf-input bf-textarea"
                                    id="bf-notes"
                                    placeholder="Any preferences or notes…"
                                    aria-label="Additional notes"
                                ></textarea>
                            </div>

                            <p class="bf-error" id="bf-error-msg" hidden></p>

                            <div class="bf-actions">
                                <button class="bf-back" data-back="2" type="button">← Back</button>
                                <button class="btn-primary bf-submit" type="button">
                                    Confirm Booking
                                </button>
                            </div>
                        </div><!-- /step 3 -->

                        <!-- ══════════════════════
                             SUCCESS screen
                        ══════════════════════ -->
                        <div class="bf-success" hidden>
                            <div class="bf-success-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                            </div>
                            <p class="bf-success-title">Request Sent!</p>
                            <p class="bf-success-msg">Thank you! We'll confirm your appointment shortly via phone or email.</p>
                        </div>

                    </div><!-- /#booking-form -->
                </div>
            </div>

        </div>
    </div>
</section>