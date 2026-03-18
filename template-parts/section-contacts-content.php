<?php
/**
 * Template Part: Contacts Page Content
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$label     = get_field( 'contacts_label' ) ?: 'Contacts';
$title     = get_field( 'contacts_title' ) ?: 'Find us in Paphos';
$desc      = get_field( 'contacts_desc' ) ?: '<p>Smooth Studio is located in the heart of Paphos, Cyprus. We are open seven days a week. Book via Instagram Direct or WhatsApp.</p>';
$map_embed = get_field( 'map_embed' );

$address   = get_field( 'address',   'option' );
$instagram = get_field( 'instagram', 'option' );
$whatsapp  = get_field( 'whatsapp',  'option' );
$phone     = get_field( 'phone',     'option' );

$hours = get_field( 'working_hours' );
if ( empty( $hours ) ) {
    $hours = array(
        array( 'days' => 'Monday – Friday', 'time' => '10:00 – 20:00' ),
        array( 'days' => 'Saturday',        'time' => '10:00 – 18:00' ),
        array( 'days' => 'Sunday',          'time' => 'By appointment' ),
    );
}

$btn_text = get_field( 'contacts_btn_text' ) ?: 'Book via WhatsApp';
$btn_link = get_field( 'contacts_btn_link' ) ?: $whatsapp ?: '#';
?>
<div class="contacts-content">
    <div class="container">
        <div class="contacts-grid">

            <div class="contacts-info">
                <span class="section-label"><?php echo esc_html( $label ); ?></span>
                <?php if ( $title ) : ?>
                    <h2 class="contacts-title font-serif">
                        <?php echo smooth_heading( $title ); ?>
                    </h2>
                <?php endif; ?>
                <?php if ( $desc ) : ?>
                    <div class="contacts-desc wysiwyg-content">
                        <?php echo smooth_wysiwyg( $desc ); ?>
                    </div>
                <?php endif; ?>

                <ul class="contacts-list">
                    <?php if ( $address ) : ?>
                        <li class="contacts-item">
                            <?php echo smooth_icon( 'map-pin', 18 ); ?>
                            <span><?php echo esc_html( $address ); ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if ( $phone ) : ?>
                        <li class="contacts-item">
                            <?php echo smooth_icon( 'phone', 18 ); ?>
                            <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if ( $instagram ) : ?>
                        <li class="contacts-item">
                            <?php echo smooth_icon( 'instagram', 18 ); ?>
                            <a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener noreferrer">@smoothstudio.paphos</a>
                        </li>
                    <?php endif; ?>
                    <?php if ( $whatsapp ) : ?>
                        <li class="contacts-item">
                            <?php echo smooth_icon( 'message-circle', 18 ); ?>
                            <a href="<?php echo esc_url( $whatsapp ); ?>" target="_blank" rel="noopener noreferrer">WhatsApp</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <?php if ( is_array( $hours ) && ! empty( $hours ) ) : ?>
                    <div class="contacts-hours">
                        <h3 class="contacts-hours-title"><?php esc_html_e( 'Working hours', 'smooth' ); ?></h3>
                        <table class="hours-table">
                            <?php foreach ( $hours as $row ) : ?>
                                <tr>
                                    <td class="hours-days"><?php echo esc_html( $row['days'] ?? '' ); ?></td>
                                    <td class="hours-time"><?php echo esc_html( $row['time'] ?? '' ); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                <?php endif; ?>

                <?php if ( $btn_text ) : ?>
                    <a href="<?php echo esc_url( $btn_link ); ?>" class="btn-primary contacts-btn" target="_blank" rel="noopener noreferrer">
                        <?php echo esc_html( $btn_text ); ?>
                    </a>
                <?php endif; ?>
            </div>

            <?php if ( $map_embed ) : ?>
                <div class="contacts-map">
                    <?php echo wp_kses( $map_embed, array( 'iframe' => array( 'src' => true, 'width' => true, 'height' => true, 'style' => true, 'allowfullscreen' => true, 'loading' => true, 'referrerpolicy' => true ) ) ); ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>