<?php
/**
 * Template Part: Contacts — Full Contact Section with Map
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$intro_title   = get_field( 'contacts_intro_title' ) ?: 'Get in Touch';
$intro_content = get_field( 'contacts_intro_content' ) ?: '';
$map_url       = get_field( 'contacts_map_url' ) ?: '';
$hours         = get_field( 'contacts_hours' );

// Global options
$address        = get_field( 'address', 'option' ) ?: '';
$instagram      = get_field( 'instagram_handle', 'option' ) ?: '';
$instagram_url  = get_field( 'instagram_url', 'option' ) ?: '#';
$whatsapp_link  = get_field( 'whatsapp_link', 'option' ) ?: '#';
$whatsapp_text  = get_field( 'whatsapp_button_text', 'option' ) ?: 'Message on WhatsApp';
?>

<section class="contacts-full" id="contacts">
    <div class="container">

        <div class="contacts-full-grid">

            <!-- Left: Info -->
            <div class="contacts-info">

                <h2 class="contacts-info-title font-serif">
                    <?php echo smooth_heading( $intro_title ); ?>
                </h2>

                <?php if ( $intro_content ) : ?>
                    <div class="contacts-intro-text wysiwyg-content">
                        <?php echo smooth_wysiwyg( $intro_content ); ?>
                    </div>
                <?php endif; ?>

                <!-- Contact Details -->
                <div class="contacts-details">

                    <?php if ( $address ) : ?>
                        <div class="contact-item">
                            <div class="contact-icon">
                                <?php echo smooth_icon( 'map-pin', 20 ); ?>
                            </div>
                            <div>
                                <p class="contact-label"><?php esc_html_e( 'Address', 'smooth-theme' ); ?></p>
                                <p class="contact-value"><?php echo esc_html( $address ); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ( $instagram ) : ?>
                        <a href="<?php echo esc_url( $instagram_url ); ?>" class="contact-item" target="_blank" rel="noopener noreferrer">
                            <div class="contact-icon">
                                <?php echo smooth_icon( 'instagram', 20 ); ?>
                            </div>
                            <div>
                                <p class="contact-label">Instagram</p>
                                <p class="contact-value"><?php echo esc_html( $instagram ); ?></p>
                            </div>
                        </a>
                    <?php endif; ?>

                </div>

                <!-- Working Hours -->
                <?php if ( is_array( $hours ) && ! empty( $hours ) ) : ?>
                    <div class="contacts-hours">
                        <p class="contacts-hours-label">
                            <?php esc_html_e( 'Working Hours', 'smooth-theme' ); ?>
                        </p>
                        <ul class="contacts-hours-list">
                            <?php foreach ( $hours as $row ) : ?>
                                <li class="contacts-hours-item">
                                    <span class="hours-day"><?php echo esc_html( $row['day'] ?? '' ); ?></span>
                                    <span class="hours-time"><?php echo esc_html( $row['time'] ?? '' ); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- WhatsApp CTA -->
                <a href="<?php echo esc_url( $whatsapp_link ); ?>" class="btn-whatsapp" target="_blank" rel="noopener noreferrer">
                    <?php echo smooth_icon( 'phone', 14 ); ?>
                    <?php echo esc_html( $whatsapp_text ); ?>
                </a>

            </div>

            <!-- Right: Map -->
            <?php if ( $map_url ) : ?>
                <div class="contacts-map">
                    <iframe
                        src="<?php echo esc_url( $map_url ); ?>"
                        width="100%"
                        height="100%"
                        style="border: 0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="<?php esc_attr_e( 'Studio location on map', 'smooth-theme' ); ?>"
                    ></iframe>
                </div>
            <?php endif; ?>

        </div>

    </div>
</section>
