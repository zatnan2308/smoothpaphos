<?php
/**
 * Template Part: FAQ & Contacts Section
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$faq_title     = get_field( 'faq_title' ) ?: 'Важно знать';
$faq_items     = get_field( 'faq_items' );
$contact_title = get_field( 'contact_title' ) ?: 'На связи';

// Global options
$address        = get_field( 'address', 'option' ) ?: '';
$instagram      = get_field( 'instagram_handle', 'option' ) ?: '';
$instagram_url  = get_field( 'instagram_url', 'option' ) ?: '#';
$whatsapp_link  = get_field( 'whatsapp_link', 'option' ) ?: '#';
$whatsapp_text  = get_field( 'whatsapp_button_text', 'option' ) ?: 'Написать в WhatsApp';
?>

<section class="faq-contacts" id="contacts">
    <div class="container">
        <div class="faq-contacts-grid">

            <!-- FAQ -->
            <div class="faq-block">
                <h3 class="faq-title font-serif"><?php echo esc_html( $faq_title ); ?></h3>

                <?php if ( is_array( $faq_items ) && ! empty( $faq_items ) ) : ?>
                    <div class="faq-list">
                        <?php foreach ( $faq_items as $item ) : ?>
                            <div class="faq-item">
                                <div class="faq-question" role="button" tabindex="0" aria-expanded="false">
                                    <h5><?php echo esc_html( $item['question'] ?? '' ); ?></h5>
                                    <span class="faq-icon" aria-hidden="true"></span>
                                </div>
                                <div class="faq-answer" aria-hidden="true">
                                    <p><?php echo esc_html( $item['answer'] ?? '' ); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Contact Card -->
            <div class="contact-card">
                <h3 class="contact-title font-serif"><?php echo esc_html( $contact_title ); ?></h3>

                <div class="contact-items">
                    <?php if ( $address ) : ?>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <?php echo smooth_icon( 'map-pin', 20 ); ?>
                            </div>
                            <div>
                                <p class="contact-label"><?php esc_html_e( 'Адрес', 'smooth-theme' ); ?></p>
                                <p class="contact-value"><?php echo esc_html( $address ); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ( $instagram ) : ?>
                        <a href="<?php echo esc_url( $instagram_url ); ?>" class="contact-item" target="_blank" rel="noopener">
                            <div class="contact-icon">
                                <?php echo smooth_icon( 'instagram', 20 ); ?>
                            </div>
                            <div>
                                <p class="contact-label"><?php esc_html_e( 'Instagram', 'smooth-theme' ); ?></p>
                                <p class="contact-value"><?php echo esc_html( $instagram ); ?></p>
                            </div>
                        </a>
                    <?php endif; ?>
                </div>

                <a href="<?php echo esc_url( $whatsapp_link ); ?>" class="btn-whatsapp" target="_blank" rel="noopener">
                    <?php echo smooth_icon( 'phone', 14 ); ?>
                    <?php echo esc_html( $whatsapp_text ); ?>
                </a>
            </div>

        </div>
    </div>
</section>
