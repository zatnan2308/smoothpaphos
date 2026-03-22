<?php
/**
 * One-time seeder: Price List initial data for the front page
 * Runs once on first admin_init, then marks itself as done via WP option.
 * To re-run: delete the option 'smooth_prices_seeded_v1' from wp_options.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'admin_init', function () {

    if ( get_option( 'smooth_prices_seeded_v1' ) ) return;
    if ( ! function_exists( 'update_field' ) )      return;

    $pid = (int) get_option( 'page_on_front' );
    if ( ! $pid ) return;

    /* ── Заголовок блока ── */
    update_field( 'prices_section_label', 'Service Menu', $pid );
    update_field( 'prices_title',         'Curated',       $pid );
    update_field( 'prices_title_2',       'Wellness',      $pid );
    update_field( 'prices_section_desc',
        'A minimalist approach to beauty and relaxation. Discover our precise, result-driven treatments in an atmosphere of absolute serenity.',
        $pid
    );

    /* ── Категории прайса ── */
    $cats = array(

        /* ── MASSAGE ── */
        array(
            'cat_name'        => 'Massage',
            'cat_description' => 'Body and face therapies designed to relieve tension, improve circulation, and restore balance.',
            'cat_items'       => array(
                array( 'name' => 'Relax Massage',                        'time' => '60 / 90 MIN',                  'price' => '€50 / €70', 'description' => '' ),
                array( 'name' => 'Deep Tissue Massage',                  'time' => '60 / 90 MIN',                  'price' => '€60 / €80', 'description' => '' ),
                array( 'name' => 'Sports Massage',                       'time' => '60 / 90 MIN',                  'price' => '€60 / €80', 'description' => '' ),
                array( 'name' => 'Aroma Massage',                        'time' => '60 / 90 MIN',                  'price' => '€50 / €70', 'description' => '' ),
                array( 'name' => 'Back Massage',                         'time' => '40 MIN',                       'price' => '€40',        'description' => '' ),
                array( 'name' => 'Anti-cellulite Massage',               'time' => '60 / 80 MIN',                  'price' => '€60 / €80', 'description' => '' ),
                /* sub-label */
                array( 'name' => '',                                     'time' => '',                             'price' => '',           'description' => 'label:Packages & Face' ),
                array( 'name' => 'Anti-cellulite Package (10 sessions)', 'time' => '10 × 60 MIN',                 'price' => '€500',       'description' => '' ),
                array( 'name' => 'Anti-cellulite Package (5 sessions)',  'time' => '5 × 60 MIN',                  'price' => '€270',       'description' => '' ),
                array( 'name' => "Aphrodite's Touch",                    'time' => 'Body Scrub + Massage · 90 MIN', 'price' => '€90',      'description' => 'gold' ),
                array( 'name' => 'Facial Massage',                       'time' => '45 MIN',                       'price' => '€50',        'description' => '' ),
                array( 'name' => 'Lymphatic Massage',                    'time' => '50 MIN',                       'price' => '€50',        'description' => '' ),
                array( 'name' => 'Facial Mask',                          'time' => 'Add-on service',               'price' => '€10',        'description' => '' ),
            ),
        ),

        /* ── DEPILATION ── */
        array(
            'cat_name'        => 'Depilation',
            'cat_description' => 'Flawless smoothness using premium wax and gentle sugaring techniques.',
            'cat_items'       => array(
                array( 'name' => 'Legs up to the knee',   'time' => '', 'price' => '€15',    'description' => '' ),
                array( 'name' => 'Full legs',              'time' => '', 'price' => '€25',    'description' => '' ),
                array( 'name' => 'Classic bikini',         'time' => '', 'price' => '€15',    'description' => '' ),
                array( 'name' => 'Full bikini',            'time' => '', 'price' => '€30',    'description' => '' ),
                array( 'name' => 'Armpits',                'time' => '', 'price' => '€10',    'description' => '' ),
                array( 'name' => 'Hands up to the elbow', 'time' => '', 'price' => '€10',    'description' => '' ),
                array( 'name' => 'Full hands',             'time' => '', 'price' => '€15',    'description' => '' ),
                array( 'name' => 'Belly / Loin',           'time' => '', 'price' => '€7–€15', 'description' => '' ),
                /* dark banner */
                array( 'name' => 'Complex Package',        'time' => '', 'price' => '€55',    'description' => 'dark:Hands + Legs + Bikini' ),
            ),
        ),

        /* ── NAIL CARE ── */
        array(
            'cat_name'        => 'Nail Care',
            'cat_description' => 'Impeccable manicures and pedicures with an emphasis on nail health and elegant aesthetics.',
            'cat_items'       => array(
                array( 'name' => 'Nail Extensions (Upper Forms)',  'time' => '', 'price' => '€60', 'description' => '' ),
                array( 'name' => 'French Sculpting (Upper Forms)', 'time' => '', 'price' => '€70', 'description' => '' ),
                array( 'name' => 'Nail Strengthening (Base)',      'time' => '', 'price' => '€35', 'description' => '' ),
                array( 'name' => 'Nail Strengthening (Gel)',       'time' => '', 'price' => '€45', 'description' => '' ),
                array( 'name' => 'Classic Manicure',               'time' => '', 'price' => '€25', 'description' => '' ),
                array( 'name' => 'Pedicure',                       'time' => '', 'price' => '€50', 'description' => '' ),
            ),
        ),

        /* ── HAIR STUDIO ── */
        array(
            'cat_name'        => 'Hair Studio',
            'cat_description' => 'Advanced restoration, keratin treatments, and styling to bring out the natural beauty of your hair.',
            'cat_items'       => array(
                /* sub-label: Care & Styling */
                array( 'name' => '',                            'time' => '',         'price' => '',        'description' => 'label:Care & Styling' ),
                array( 'name' => 'Scalp Peeling',               'time' => '',         'price' => '€15',     'description' => '' ),
                array( 'name' => 'Pre-keratin Base Mask',       'time' => 'Optional', 'price' => '€10',     'description' => '' ),
                array( 'name' => 'Full Hair Reconstruction',    'time' => '',         'price' => '€25',     'description' => '' ),
                array( 'name' => 'Hair Wash',                   'time' => '',         'price' => '€35–€40', 'description' => '' ),
                array( 'name' => 'Flat Iron Styling (silk effect)', 'time' => '',     'price' => '€30',     'description' => '' ),
                array( 'name' => 'Blow Dry — Short hair',       'time' => '',         'price' => '€25',     'description' => '' ),
                array( 'name' => 'Blow Dry — Medium hair',      'time' => '',         'price' => '€30',     'description' => '' ),
                array( 'name' => 'Blow Dry — Long hair',        'time' => '',         'price' => '€35–€40', 'description' => '' ),
                /* sub-label: Cold Restoration */
                array( 'name' => '',         'time' => '', 'price' => '',     'description' => 'label:Cold Restoration' ),
                array( 'name' => 'Up to 30 cm', 'time' => '', 'price' => '€65',  'description' => '' ),
                array( 'name' => '40 cm',       'time' => '', 'price' => '€75',  'description' => '' ),
                array( 'name' => '50 cm',       'time' => '', 'price' => '€85',  'description' => '' ),
                array( 'name' => '60 cm',       'time' => '', 'price' => '€90',  'description' => '' ),
                array( 'name' => '70 cm',       'time' => '', 'price' => '€100', 'description' => '' ),
                /* sub-label: Keratin Botox */
                array( 'name' => '',         'time' => '', 'price' => '',     'description' => 'label:Keratin Botox' ),
                array( 'name' => 'Up to 30 cm', 'time' => '', 'price' => '€120', 'description' => '' ),
                array( 'name' => '35 cm',       'time' => '', 'price' => '€130', 'description' => '' ),
                array( 'name' => '40 cm',       'time' => '', 'price' => '€140', 'description' => '' ),
                array( 'name' => '45 cm',       'time' => '', 'price' => '€150', 'description' => '' ),
                array( 'name' => '50 cm',       'time' => '', 'price' => '€160', 'description' => '' ),
                array( 'name' => '60 cm',       'time' => '', 'price' => '€170', 'description' => '' ),
                array( 'name' => '70 cm',       'time' => '', 'price' => '€180', 'description' => '' ),
                /* extra thickness — gold badge */
                array( 'name' => 'Extra thickness', 'time' => '', 'price' => '+€20', 'description' => 'gold' ),
            ),
        ),

    );

    update_field( 'price_categories', $cats, $pid );

    update_option( 'smooth_prices_seeded_v1', 1 );

    error_log( 'smooth_prices_seeded_v1: price list seeded for page ID ' . $pid );
} );
