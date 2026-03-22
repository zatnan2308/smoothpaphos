<?php
/**
 * Smooth Booking — Submissions Log
 *
 * Registers a private Custom Post Type to store every booking request.
 * Provides a clean admin list with columns, detail meta box and status management.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/* =========================================================================
   Register CPT
   ========================================================================= */
add_action( 'init', 'smooth_booking_register_cpt' );

function smooth_booking_register_cpt() {
    register_post_type( 'smooth_booking', array(
        'labels'          => array(
            'name'               => 'Booking Requests',
            'singular_name'      => 'Booking Request',
            'menu_name'          => 'Bookings',
            'all_items'          => 'All Requests',
            'edit_item'          => 'View Request',
            'view_item'          => 'View Request',
            'search_items'       => 'Search Requests',
            'not_found'          => 'No booking requests found.',
            'not_found_in_trash' => 'No requests found in trash.',
        ),
        'public'          => false,
        'show_ui'         => true,
        'show_in_menu'    => true,
        'menu_position'   => 26,
        'menu_icon'       => 'dashicons-calendar-alt',
        'capability_type' => 'post',
        'capabilities'    => array(
            'create_posts' => 'do_not_allow',
        ),
        'map_meta_cap'    => true,
        'supports'        => array( 'title' ),
        'rewrite'         => false,
        'query_var'       => false,
    ) );
}


/* =========================================================================
   Custom Admin Columns
   ========================================================================= */
add_filter( 'manage_smooth_booking_posts_columns', 'smooth_booking_columns' );

function smooth_booking_columns( $cols ) {
    return array(
        'cb'          => '<input type="checkbox">',
        'title'       => 'Client',
        'sb_date'     => 'Visit Date',
        'sb_services' => 'Services',
        'sb_contact'  => 'Contact',
        'sb_status'   => 'Status',
        'date'        => 'Submitted',
    );
}

add_action( 'manage_smooth_booking_posts_custom_column', 'smooth_booking_column_data', 10, 2 );

function smooth_booking_column_data( $col, $post_id ) {
    switch ( $col ) {

        case 'sb_date':
            $date = get_post_meta( $post_id, '_sb_date', true );
            echo $date ? esc_html( $date ) : '<span style="color:#bbb">—</span>';
            break;

        case 'sb_services':
            $svcs = get_post_meta( $post_id, '_sb_services', true );
            if ( is_array( $svcs ) && $svcs ) {
                echo '<span style="font-size:12px;line-height:1.5">' . esc_html( implode( ', ', $svcs ) ) . '</span>';
            } else {
                echo '<span style="color:#bbb">—</span>';
            }
            break;

        case 'sb_contact':
            $phone = get_post_meta( $post_id, '_sb_phone', true );
            $email = get_post_meta( $post_id, '_sb_email', true );
            if ( $phone ) {
                echo '<span style="display:block">'
                   . '<a href="tel:' . esc_attr( preg_replace( '/[^\d+]/', '', $phone ) ) . '">' . esc_html( $phone ) . '</a>'
                   . '</span>';
            }
            if ( $email ) {
                echo '<a href="mailto:' . esc_attr( $email ) . '" style="font-size:12px">' . esc_html( $email ) . '</a>';
            }
            if ( ! $phone && ! $email ) {
                echo '<span style="color:#bbb">—</span>';
            }
            break;

        case 'sb_status':
            $status = get_post_meta( $post_id, '_sb_status', true ) ?: 'new';
            $map    = array(
                'new'  => array( '🆕 New',  '#dbeafe', '#1d4ed8' ),
                'read' => array( '📖 Read', '#fef9c3', '#a16207' ),
                'done' => array( '✅ Done', '#dcfce7', '#15803d' ),
            );
            $info = isset( $map[ $status ] ) ? $map[ $status ] : $map['new'];
            printf(
                '<span style="display:inline-block;padding:2px 10px;border-radius:20px;font-size:11px;font-weight:700;background:%s;color:%s">%s</span>',
                esc_attr( $info[1] ),
                esc_attr( $info[2] ),
                esc_html( $info[0] )
            );
            break;
    }
}

add_filter( 'manage_edit-smooth_booking_sortable_columns', function( $cols ) {
    $cols['sb_date']   = 'sb_date';
    $cols['sb_status'] = 'sb_status';
    return $cols;
} );

/* Custom sort by meta */
add_action( 'pre_get_posts', function( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) return;
    if ( $query->get( 'post_type' ) !== 'smooth_booking' ) return;

    $orderby = $query->get( 'orderby' );
    if ( $orderby === 'sb_date' ) {
        $query->set( 'meta_key', '_sb_date' );
        $query->set( 'orderby', 'meta_value' );
    }
    if ( $orderby === 'sb_status' ) {
        $query->set( 'meta_key', '_sb_status' );
        $query->set( 'orderby', 'meta_value' );
    }
} );


/* =========================================================================
   Meta Boxes
   ========================================================================= */
add_action( 'add_meta_boxes', 'smooth_booking_add_meta_boxes' );

function smooth_booking_add_meta_boxes() {
    add_meta_box(
        'smooth_booking_details',
        '📋 Booking Details',
        'smooth_booking_details_cb',
        'smooth_booking',
        'normal',
        'high'
    );
    add_meta_box(
        'smooth_booking_status_box',
        'Status',
        'smooth_booking_status_cb',
        'smooth_booking',
        'side',
        'high'
    );
}

function smooth_booking_details_cb( $post ) {
    $name     = get_post_meta( $post->ID, '_sb_name',     true );
    $phone    = get_post_meta( $post->ID, '_sb_phone',    true );
    $email    = get_post_meta( $post->ID, '_sb_email',    true );
    $date     = get_post_meta( $post->ID, '_sb_date',     true );
    $notes    = get_post_meta( $post->ID, '_sb_notes',    true );
    $services = get_post_meta( $post->ID, '_sb_services', true );
    $ip       = get_post_meta( $post->ID, '_sb_ip',       true );
    ?>
    <style>
        #smooth_booking_details .inside { padding: 0; }
        .sb-table { width: 100%; border-collapse: collapse; font-size: 13px; }
        .sb-table th { width: 160px; padding: 10px 16px; background: #f9f9f9; font-weight: 600; color: #444; text-align: left; vertical-align: top; border-bottom: 1px solid #eee; }
        .sb-table td { padding: 10px 16px; vertical-align: top; border-bottom: 1px solid #eee; color: #1a1a1a; word-break: break-word; }
        .sb-table tr:last-child th,
        .sb-table tr:last-child td { border-bottom: none; }
        .sb-services { margin: 0; padding: 0; list-style: none; }
        .sb-services li { padding: 2px 0; }
        .sb-services li::before { content: '•'; color: #c9a96e; margin-right: 6px; }
    </style>
    <table class="sb-table">
        <tr>
            <th>Name</th>
            <td><?php echo esc_html( $name ?: '—' ); ?></td>
        </tr>
        <tr>
            <th>Phone</th>
            <td>
                <?php if ( $phone ) : ?>
                    <a href="tel:<?php echo esc_attr( preg_replace( '/[^\d+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
                <?php else : ?>
                    <span style="color:#bbb">—</span>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Email</th>
            <td>
                <?php if ( $email ) : ?>
                    <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                <?php else : ?>
                    <span style="color:#bbb">—</span>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Preferred Date</th>
            <td><?php echo $date ? esc_html( $date ) : '<span style="color:#bbb">—</span>'; ?></td>
        </tr>
        <tr>
            <th>Services</th>
            <td>
                <?php if ( is_array( $services ) && $services ) : ?>
                    <ul class="sb-services">
                        <?php foreach ( $services as $s ) : ?>
                            <li><?php echo esc_html( $s ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <span style="color:#bbb">—</span>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th>Notes</th>
            <td><?php echo $notes ? nl2br( esc_html( $notes ) ) : '<span style="color:#bbb">—</span>'; ?></td>
        </tr>
        <tr>
            <th>Submitted</th>
            <td><?php echo esc_html( get_the_date( 'd.m.Y H:i', $post ) ); ?></td>
        </tr>
        <?php if ( $ip ) : ?>
        <tr>
            <th>IP Address</th>
            <td><?php echo esc_html( $ip ); ?></td>
        </tr>
        <?php endif; ?>
    </table>
    <?php
}

function smooth_booking_status_cb( $post ) {
    wp_nonce_field( 'smooth_booking_status_save', 'smooth_booking_status_nonce' );
    $status = get_post_meta( $post->ID, '_sb_status', true ) ?: 'new';
    ?>
    <p style="margin: 0;">
        <select name="smooth_booking_status" style="width:100%">
            <option value="new"  <?php selected( $status, 'new' ); ?>>🆕 New</option>
            <option value="read" <?php selected( $status, 'read' ); ?>>📖 Read</option>
            <option value="done" <?php selected( $status, 'done' ); ?>>✅ Done</option>
        </select>
    </p>
    <p style="margin-top:10px;font-size:12px;color:#666">
        Save the post to apply the status change.
    </p>
    <?php
}


/* =========================================================================
   Save Status
   ========================================================================= */
add_action( 'save_post_smooth_booking', 'smooth_booking_save_status' );

function smooth_booking_save_status( $post_id ) {
    if ( ! isset( $_POST['smooth_booking_status_nonce'] ) ) {
        return;
    }
    if ( ! wp_verify_nonce(
        sanitize_text_field( wp_unslash( $_POST['smooth_booking_status_nonce'] ) ),
        'smooth_booking_status_save'
    ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    if ( isset( $_POST['smooth_booking_status'] ) ) {
        $allowed = array( 'new', 'read', 'done' );
        $val     = sanitize_key( wp_unslash( $_POST['smooth_booking_status'] ) );
        if ( in_array( $val, $allowed, true ) ) {
            update_post_meta( $post_id, '_sb_status', $val );
        }
    }
}


/* =========================================================================
   Auto-mark "new" → "read" when admin opens a submission
   ========================================================================= */
add_action( 'load-post.php', 'smooth_booking_auto_read' );

function smooth_booking_auto_read() {
    if ( ! isset( $_GET['post'] ) ) {
        return;
    }
    $post_id = (int) $_GET['post'];
    if ( get_post_type( $post_id ) !== 'smooth_booking' ) {
        return;
    }
    if ( get_post_meta( $post_id, '_sb_status', true ) === 'new' ) {
        update_post_meta( $post_id, '_sb_status', 'read' );
    }
}


/* =========================================================================
   Row Actions — "Mark as Done"
   ========================================================================= */
add_filter( 'post_row_actions', 'smooth_booking_row_actions', 10, 2 );

function smooth_booking_row_actions( $actions, $post ) {
    if ( $post->post_type !== 'smooth_booking' ) {
        return $actions;
    }

    /* Remove "Quick Edit" — not useful for read-only CPT */
    unset( $actions['inline hide-if-no-js'] );

    $status = get_post_meta( $post->ID, '_sb_status', true ) ?: 'new';
    if ( $status !== 'done' ) {
        $url = wp_nonce_url(
            admin_url( 'admin-post.php?action=smooth_mark_done&post_id=' . $post->ID ),
            'smooth_mark_done_' . $post->ID
        );
        $actions['mark_done'] = '<a href="' . esc_url( $url ) . '">✅ Mark Done</a>';
    }

    return $actions;
}

add_action( 'admin_post_smooth_mark_done', 'smooth_booking_handle_mark_done' );

function smooth_booking_handle_mark_done() {
    $post_id = isset( $_GET['post_id'] ) ? (int) $_GET['post_id'] : 0;
    if ( ! $post_id ) {
        wp_die( 'Invalid request.' );
    }
    check_admin_referer( 'smooth_mark_done_' . $post_id );
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        wp_die( 'Insufficient permissions.' );
    }
    update_post_meta( $post_id, '_sb_status', 'done' );
    wp_redirect( add_query_arg(
        array( 'post_type' => 'smooth_booking', 'marked_done' => '1' ),
        admin_url( 'edit.php' )
    ) );
    exit;
}

/* Admin notice after "Mark Done" */
add_action( 'admin_notices', function() {
    $screen = get_current_screen();
    if ( ! $screen || $screen->post_type !== 'smooth_booking' ) {
        return;
    }
    if ( isset( $_GET['marked_done'] ) ) {
        echo '<div class="notice notice-success is-dismissible"><p>Booking request marked as <strong>Done</strong>.</p></div>';
    }
} );


/* =========================================================================
   Admin-only styles for the list table
   ========================================================================= */
add_action( 'admin_head', function() {
    $screen = get_current_screen();
    if ( ! $screen || $screen->post_type !== 'smooth_booking' ) {
        return;
    }
    ?>
    <style>
        /* Hide "Add New" button — submissions come from the front-end only */
        .page-title-action { display: none !important; }

        /* Column widths */
        .column-title    { width: 160px; }
        .column-sb_date  { width: 100px; }
        .column-sb_status{ width: 90px; }
        .column-sb_contact{ width: 160px; }
        .column-date     { width: 130px; }

        /* Services cell wrapping */
        .column-sb_services { max-width: 260px; }

        /* Title cell */
        .smooth_booking .column-title strong a { font-weight: 600; }
    </style>
    <?php
} );
