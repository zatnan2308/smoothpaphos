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
            'answer'   => '<p>Sessions run from 30 minutes (express head, neck and shoulders) to 90 minutes (full-body or signature Aphrodite's Touch). You choose the duration that suits you best.</p>',
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
            'answer'   => '<p>Yes\! Gift certificates are available for any service or amount. Contact us via Instagram or WhatsApp to arrange one.</p>',
        ),
    );
}

$contact_label    = get_field( 'contact_label' ) ?: 'Contact';
$contact_title    = get_field( 'contact_title' ) ?: 'Get in touch';
$contact_desc     = get_field( 'contact_desc' ) ?: '<p>Ready to book or have a question? Reach out via Instagram or WhatsApp — we reply quickly.</p>';
$contact_btn_text = get_field( 'contact_btn_text' ) ?: 'Write on WhatsApp';
$contact_btn_link = get_field( 'contact_btn_link' ) ?: get_field( 'whatsapp', 'option' ) ?: '#';
$address          = get_field( 'address', 'option' );
$instagram        = get_field( 'instagram', 'option' );
$whatsapp         = get_field( 'whatsapp', 'option' );
?>

<section class="faq-contacts" id="faq">
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
                                <div class="faq-answer wysiwyg-content" hidden>
                                    <?php echo smooth_wysiwyg( $item['answer'] ?? '' ); ?>
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
                    <?php if ( $contact_btn_text ) : ?>
                        <a href="<?php echo esc_url( $contact_btn_link ); ?>" class="btn-primary contact-btn" target="_blank" rel="noopener noreferrer">
                            <?php echo esc_html( $contact_btn_text ); ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
</section>