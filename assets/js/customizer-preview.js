/**
 * Smooth Studio — Customizer Live Preview
 * With transport:'refresh' the preview reloads automatically via PHP.
 * This script handles only instant DOM-level updates that don't need a reload.
 */
( function ( $ ) {

    /* ── Book Now button text (instant, no reload needed) ── */
    wp.customize( 'smooth_book_text', function ( value ) {
        value.bind( function ( newval ) {
            if ( newval ) {
                $( '.navbar-book' ).text( newval );
            }
        } );
    } );

} )( jQuery );
