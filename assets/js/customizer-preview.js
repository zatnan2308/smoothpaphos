/**
 * Smooth Studio — Customizer Live Preview
 * Updates CSS custom properties on :root in real time via postMessage.
 */
( function () {
    'use strict';

    var root = document.documentElement;

    function set( prop, value ) {
        root.style.setProperty( prop, value );
    }

    function hexToRgba( hex, opacity ) {
        hex = hex.replace( '#', '' );
        if ( hex.length === 3 ) {
            hex = hex[0] + hex[0] + hex[1] + hex[1] + hex[2] + hex[2];
        }
        var r = parseInt( hex.substring( 0, 2 ), 16 );
        var g = parseInt( hex.substring( 2, 4 ), 16 );
        var b = parseInt( hex.substring( 4, 6 ), 16 );
        return 'rgba(' + r + ',' + g + ',' + b + ',' + parseFloat( opacity ) + ')';
    }

    /* ── Simple px settings ── */
    var pxSettings = [
        [ 'smooth_nav_top',         '--nav-top' ],
        [ 'smooth_nav_pill_radius', '--nav-pill-radius' ],
        [ 'smooth_nav_pill_gap',    '--nav-pill-gap' ],
        [ 'smooth_nav_pill_left',   '--nav-pill-left' ],
        [ 'smooth_nav_glass_blur',  '--nav-glass-blur' ],
        [ 'smooth_logo_size',       '--logo-size' ],
        [ 'smooth_navlink_size',    '--navlink-size' ],
        [ 'smooth_navlink_gap',     '--navlink-gap' ],
        [ 'smooth_book_size',       '--book-size' ],
    ];

    pxSettings.forEach( function ( pair ) {
        wp.customize( pair[0], function ( value ) {
            value.bind( function ( v ) {
                set( pair[1], parseInt( v ) + 'px' );
            } );
        } );
    } );

    /* ── Simple color settings ── */
    var colorSettings = [
        [ 'smooth_logo_color',          '--logo-color' ],
        [ 'smooth_logo_scrolled_color', '--logo-scrolled-color' ],
        [ 'smooth_logo_hover_color',    '--logo-hover-color' ],
        [ 'smooth_navlink_scrolled_color', '--navlink-scrolled-color' ],
        [ 'smooth_navlink_hover_color',    '--navlink-hover-color' ],
        [ 'smooth_book_color',             '--book-color' ],
        [ 'smooth_book_hover_color',       '--book-hover-color' ],
        [ 'smooth_book_scrolled_bg',       '--book-scrolled-bg' ],
        [ 'smooth_book_scrolled_hover_bg', '--book-scrolled-hover-bg' ],
    ];

    colorSettings.forEach( function ( pair ) {
        wp.customize( pair[0], function ( value ) {
            value.bind( function ( v ) {
                set( pair[1], v );
            } );
        } );
    } );

    /* ── rgba combos: hex + opacity ── */
    var rgbaGroups = [
        {
            hex:     'smooth_nav_glass_color',
            opacity: 'smooth_nav_glass_opacity',
            prop:    '--nav-glass-bg',
            defHex:  '#ffffff',
            defOp:   0.18,
        },
        {
            hex:     'smooth_nav_scrolled_color',
            opacity: 'smooth_nav_scrolled_opacity',
            prop:    '--nav-scrolled-bg',
            defHex:  '#fcf9f6',
            defOp:   0.88,
        },
        {
            hex:     'smooth_navlink_color',
            opacity: 'smooth_navlink_opacity',
            prop:    '--navlink-color',
            defHex:  '#ffffff',
            defOp:   0.80,
        },
        {
            hex:     'smooth_book_bg',
            opacity: 'smooth_book_bg_opacity',
            prop:    '--book-bg',
            defHex:  '#ffffff',
            defOp:   0.20,
        },
        {
            hex:     'smooth_book_hover_bg',
            opacity: 'smooth_book_hover_bg_opacity',
            prop:    '--book-hover-bg',
            defHex:  '#ffffff',
            defOp:   0.32,
        },
    ];

    rgbaGroups.forEach( function ( g ) {
        var currentHex = g.defHex;
        var currentOp  = g.defOp;

        wp.customize( g.hex, function ( value ) {
            value.bind( function ( v ) {
                currentHex = v;
                set( g.prop, hexToRgba( currentHex, currentOp ) );
            } );
        } );

        wp.customize( g.opacity, function ( value ) {
            value.bind( function ( v ) {
                currentOp = v;
                set( g.prop, hexToRgba( currentHex, currentOp ) );
            } );
        } );
    } );

    /* ── Glass border (always white, only opacity changes) ── */
    wp.customize( 'smooth_nav_glass_border', function ( value ) {
        value.bind( function ( v ) {
            set( '--nav-glass-border', hexToRgba( '#ffffff', v ) );
        } );
    } );

    /* ── Book Now button text ── */
    wp.customize( 'smooth_book_text', function ( value ) {
        value.bind( function ( v ) {
            var btn = document.querySelector( '.navbar-book' );
            if ( btn && v ) {
                btn.textContent = v;
            }
        } );
    } );

} )();
