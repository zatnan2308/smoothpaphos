<?php
/**
 * Booking Form — AJAX Handler
 *
 * Email delivery uses WordPress built-in wp_mail() (PHPMailer).
 * No additional plugins required.
 *
 * Hooks:
 *   wp_ajax_nopriv_smooth_booking  — handles guests
 *   wp_ajax_smooth_booking         — handles logged-in users
 *
 * Security: nonce verification on every request.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/* =========================================================================
   Localise AJAX URL + nonce for smooth.js
   ========================================================================= */
add_action( 'wp_enqueue_scripts', 'smooth_booking_localize', 20 );

function smooth_booking_localize() {
    wp_localize_script( 'smooth-script', 'smoothBooking', array(
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'smooth_booking_nonce' ),
    ) );
}


/* =========================================================================
   AJAX handlers
   ========================================================================= */
add_action( 'wp_ajax_nopriv_smooth_booking', 'smooth_booking_handle' );
add_action( 'wp_ajax_smooth_booking',        'smooth_booking_handle' );

function smooth_booking_handle() {

    /* ── 1. Nonce check ── */
    $nonce = isset( $_POST['nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['nonce'] ) ) : '';
    if ( ! wp_verify_nonce( $nonce, 'smooth_booking_nonce' ) ) {
        wp_send_json_error( array( 'message' => 'Security check failed. Please refresh the page.' ), 403 );
    }

    /* ── 2. Sanitise input ── */
    $services = isset( $_POST['services'] )
        ? array_filter( array_map( 'sanitize_text_field', (array) $_POST['services'] ) )
        : array();

    $date  = isset( $_POST['date'] )  ? sanitize_text_field( wp_unslash( $_POST['date'] ) )  : '';
    $name  = isset( $_POST['name'] )  ? sanitize_text_field( wp_unslash( $_POST['name'] ) )  : '';
    $phone = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
    $email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) )       : '';
    $notes = isset( $_POST['notes'] ) ? sanitize_textarea_field( wp_unslash( $_POST['notes'] ) ) : '';

    /* ── 3. Validation ── */
    if ( empty( $services ) ) {
        wp_send_json_error( array( 'message' => 'Please select at least one service.' ) );
    }
    if ( empty( $date ) ) {
        wp_send_json_error( array( 'message' => 'Please choose a preferred date.' ) );
    }
    if ( empty( $name ) ) {
        wp_send_json_error( array( 'message' => 'Please enter your name.' ) );
    }
    if ( empty( $phone ) && empty( $email ) ) {
        wp_send_json_error( array( 'message' => 'Please provide a phone number or email.' ) );
    }

    /* ── 4. Save to Submissions Log ── */
    $log_id   = 0;
    $log_post = wp_insert_post( array(
        'post_type'   => 'smooth_booking',
        'post_status' => 'publish',
        'post_title'  => sanitize_text_field( $name ) . ' — ' . gmdate( 'd.m.Y H:i' ),
    ) );
    if ( $log_post && ! is_wp_error( $log_post ) ) {
        $log_id = $log_post;
        update_post_meta( $log_id, '_sb_name',     $name );
        update_post_meta( $log_id, '_sb_phone',    $phone );
        update_post_meta( $log_id, '_sb_email',    $email );
        update_post_meta( $log_id, '_sb_date',     $date );
        update_post_meta( $log_id, '_sb_notes',    $notes );
        update_post_meta( $log_id, '_sb_services', $services );
        update_post_meta( $log_id, '_sb_status',   'new' );
        $client_ip = isset( $_SERVER['REMOTE_ADDR'] )
            ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) )
            : '';
        update_post_meta( $log_id, '_sb_ip', $client_ip );
    }

    /* ── 5. Build admin email ── */
    $recipient = function_exists( 'get_field' ) ? get_field( 'booking_recipient_email', 'option' ) : '';
    $to        = ( $recipient && is_email( $recipient ) ) ? $recipient : get_option( 'admin_email' );
    $subject   = function_exists( 'get_field' )
        ? ( get_field( 'booking_email_subject', 'option' ) ?: '[Smooth Studio] New Booking Request' )
        : '[Smooth Studio] New Booking Request';

    $body  = "New booking request received via the website contact form.\n\n";
    $body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    $body .= "SERVICES REQUESTED\n";
    $body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    foreach ( $services as $svc ) {
        $body .= '  • ' . $svc . "\n";
    }
    $body .= "\nPREFERRED DATE: " . $date . "\n\n";
    $body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    $body .= "CLIENT DETAILS\n";
    $body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    $body .= "  Name:  " . $name . "\n";
    if ( $phone ) $body .= "  Phone: " . $phone . "\n";
    if ( $email ) $body .= "  Email: " . $email . "\n";
    if ( $notes ) {
        $body .= "\nNOTES:\n" . $notes . "\n";
    }
    $body .= "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    $body .= 'Sent from: ' . get_site_url() . "\n";

    $headers = array( 'Content-Type: text/plain; charset=UTF-8' );
    if ( $email && is_email( $email ) ) {
        $headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
    }

    /* ── 6. Send admin email ── */
    $sent = wp_mail( $to, $subject, $body, $headers );

    /* ── 7. Confirmation to client (optional) ── */
    $notify_client = function_exists( 'get_field' ) ? (bool) get_field( 'booking_notify_client', 'option' ) : true;
    if ( $notify_client && $email && is_email( $email ) ) {
        $c_subject = 'Booking Request Received — Smooth Studio';
        $c_body    = 'Hi ' . $name . ",\n\n"
                   . "Thank you for reaching out! We received your booking request and will confirm your appointment shortly via phone or email.\n\n"
                   . "Services: "       . implode( ', ', $services ) . "\n"
                   . "Preferred date: " . $date . "\n\n"
                   . "Smooth Studio · Paphos, Cyprus\n"
                   . "Instagram: @smoothstudio.paphos\n";
        wp_mail( $email, $c_subject, $c_body );
    }

    /* ── 8. Respond ── */
    if ( $log_id || $sent ) {
        wp_send_json_success( array( 'message' => 'Booking request sent!' ) );
    } else {
        wp_send_json_error( array( 'message' => 'Something went wrong. Please try again or contact us via WhatsApp or Instagram.' ) );
    }
}
