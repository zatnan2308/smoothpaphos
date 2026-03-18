<?php
/**
 * Template Part: Prices Section
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$label    = get_field( 'prices_label' ) ?: 'Prices';
$title    = get_field( 'prices_title' ) ?: 'Services & Prices';

$categories = get_field( 'price_categories' );

if ( empty( $categories ) ) {
    $categories = array(
        array(
            'name'  => 'Massage',
            'items' => array(
                array( 'name' => 'Classic relaxation massage',         'duration' => '40 min',  'price' => '35 €' ),
                array( 'name' => 'Classic relaxation massage',         'duration' => '60 min',  'price' => '50 €' ),
                array( 'name' => 'Classic relaxation massage',         'duration' => '90 min',  'price' => '70 €' ),
                array( 'name' => 'Deep tissue / sport massage',        'duration' => '60 min',  'price' => '60 €' ),
                array( 'name' => 'Deep tissue / sport massage',        'duration' => '90 min',  'price' => '80 €' ),
                array( 'name' => 'Lymphatic drainage massage',         'duration' => '60 min',  'price' => '60 €' ),
                array( 'name' => 'Lymphatic drainage massage',         'duration' => '90 min',  'price' => '80 €' ),
                array( 'name' => 'Anti-cellulite massage',             'duration' => '40 min',  'price' => '40 €' ),
                array( 'name' => 'Anti-cellulite massage',             'duration' => '60 min',  'price' => '55 €' ),
                array( 'name' => "Aphrodite\u{2019}s Touch",              'duration' => '90 min',  'price' => '90 €' ),
                array( 'name' => 'Head · neck · shoulders',           'duration' => '30 min',  'price' => '25 €' ),
            ),
        ),
        array(
            'name'  => 'Sugaring – Waxing',
            'items' => array(
                array( 'name' => 'Bikini (deep)',     'duration' => '',  'price' => '25 €' ),
                array( 'name' => 'Brazilian',          'duration' => '',  'price' => '30 €' ),
                array( 'name' => 'Underarms',          'duration' => '',  'price' => '10 €' ),
                array( 'name' => 'Half leg',           'duration' => '',  'price' => '18 €' ),
                array( 'name' => 'Full leg',           'duration' => '',  'price' => '28 €' ),
                array( 'name' => 'Half leg + bikini',  'duration' => '',  'price' => '35 €' ),
                array( 'name' => 'Full leg + bikini',  'duration' => '',  'price' => '45 €' ),
                array( 'name' => 'Forearms',           'duration' => '',  'price' => '12 €' ),
                array( 'name' => 'Upper lip',          'duration' => '',  'price' => '8 €' ),
            ),
        ),        array(
            'name'  => 'Nails',
            'items' => array(
                array( 'name' => 'Manicure (without coating)',   'duration' => '',  'price' => '20 €' ),
                array( 'name' => 'Manicure + gel polish',         'duration' => '',  'price' => '35 €' ),
                array( 'name' => 'Pedicure (without coating)',   'duration' => '',  'price' => '25 €' ),
                array( 'name' => 'Pedicure + gel polish',         'duration' => '',  'price' => '40 €' ),
                array( 'name' => 'Gel polish removal',            'duration' => '',  'price' => '10 €' ),
                array( 'name' => 'Nail art (per nail)',           'duration' => '',  'price' => '2 €' ),
            ),
        ),
        array(
            'name'  => 'Hair',
            'items' => array(
                array( 'name' => 'Blowout',                        'duration' => '',  'price' => '20 €' ),
                array( 'name' => 'Haircut (without styling)',     'duration' => '',  'price' => '25 €' ),
                array( 'name' => 'Haircut + blowout',             'duration' => '',  'price' => '40 €' ),
                array( 'name' => 'Coloring (roots)',              'duration' => '',  'price' => 'from 50 €' ),
                array( 'name' => 'Full color',                    'duration' => '',  'price' => 'from 70 €' ),
                array( 'name' => 'Highlights',                    'duration' => '',  'price' => 'from 80 €' ),
                array( 'name' => 'Keratin treatment',             'duration' => '',  'price' => 'from 100 €' ),
                array( 'name' => 'Updo / styling',                'duration' => '',  'price' => 'from 30 €' ),
            ),
        ),
    );
}?>

<section class="prices" id="prices">
    <div class="container">
        <div class="prices-header">
            <span class="section-label"><?php echo esc_html( $label ); ?></span>
            <?php if ( $title ) : ?>
                <h2 class="prices-title font-serif">
                    <?php echo smooth_heading( $title ); ?>
                </h2>
            <?php endif; ?>
        </div>
        <?php if ( is_array( $categories ) && ! empty( $categories ) ) : ?>
            <div class="prices-grid">
                <?php foreach ( $categories as $cat ) : ?>
                    <div class="price-category">
                        <?php if ( ! empty( $cat['name'] ) ) : ?>
                            <h3 class="price-category-name"><?php echo esc_html( $cat['name'] ); ?></h3>
                        <?php endif; ?>
                        <?php if ( is_array( $cat['items'] ?? null ) ) : ?>
                            <ul class="price-list">
                                <?php foreach ( $cat['items'] as $item ) : ?>
                                    <li class="price-item">
                                        <span class="price-name"><?php echo esc_html( $item['name'] ?? '' ); ?></span>
                                        <?php if ( ! empty( $item['duration'] ) ) : ?>
                                            <span class="price-duration"><?php echo esc_html( $item['duration'] ); ?></span>
                                        <?php endif; ?>
                                        <span class="price-dots"></span>
                                        <span class="price-value"><?php echo esc_html( $item['price'] ?? '' ); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>