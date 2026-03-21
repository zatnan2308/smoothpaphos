<?php
/**
 * Template Part: Prices Section
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$label    = 'Prices';
$title    = get_field( 'prices_title' ) ?: 'Services & Prices';

$categories = get_field( 'price_categories' );

if ( empty( $categories ) ) {
    $categories = array(
        array(
            'cat_name'  => 'Massage',
            'cat_items' => array(
                array( 'name' => 'Classic relaxation massage',         'time' => '40 min',  'price' => '35 €' ),
                array( 'name' => 'Classic relaxation massage',         'time' => '60 min',  'price' => '50 €' ),
                array( 'name' => 'Classic relaxation massage',         'time' => '90 min',  'price' => '70 €' ),
                array( 'name' => 'Deep tissue / sport massage',        'time' => '60 min',  'price' => '60 €' ),
                array( 'name' => 'Deep tissue / sport massage',        'time' => '90 min',  'price' => '80 €' ),
                array( 'name' => 'Lymphatic drainage massage',         'time' => '60 min',  'price' => '60 €' ),
                array( 'name' => 'Lymphatic drainage massage',         'time' => '90 min',  'price' => '80 €' ),
                array( 'name' => 'Anti-cellulite massage',             'time' => '40 min',  'price' => '40 €' ),
                array( 'name' => 'Anti-cellulite massage',             'time' => '60 min',  'price' => '55 €' ),
                array( 'name' => "Aphrodite\u{2019}s Touch",              'time' => '90 min',  'price' => '90 €' ),
                array( 'name' => 'Head · neck · shoulders',           'time' => '30 min',  'price' => '25 €' ),
            ),
        ),
        array(
            'cat_name'  => 'Sugaring – Waxing',
            'cat_items' => array(
                array( 'name' => 'Bikini (deep)',     'time' => '',  'price' => '25 €' ),
                array( 'name' => 'Brazilian',          'time' => '',  'price' => '30 €' ),
                array( 'name' => 'Underarms',          'time' => '',  'price' => '10 €' ),
                array( 'name' => 'Half leg',           'time' => '',  'price' => '18 €' ),
                array( 'name' => 'Full leg',           'time' => '',  'price' => '28 €' ),
                array( 'name' => 'Half leg + bikini',  'time' => '',  'price' => '35 €' ),
                array( 'name' => 'Full leg + bikini',  'time' => '',  'price' => '45 €' ),
                array( 'name' => 'Forearms',           'time' => '',  'price' => '12 €' ),
                array( 'name' => 'Upper lip',          'time' => '',  'price' => '8 €' ),
            ),
        ),
        array(
            'cat_name'  => 'Nails',
            'cat_items' => array(
                array( 'name' => 'Manicure (without coating)',   'time' => '',  'price' => '20 €' ),
                array( 'name' => 'Manicure + gel polish',         'time' => '',  'price' => '35 €' ),
                array( 'name' => 'Pedicure (without coating)',   'time' => '',  'price' => '25 €' ),
                array( 'name' => 'Pedicure + gel polish',         'time' => '',  'price' => '40 €' ),
                array( 'name' => 'Gel polish removal',            'time' => '',  'price' => '10 €' ),
                array( 'name' => 'Nail art (per nail)',           'time' => '',  'price' => '2 €' ),
            ),
        ),
        array(
            'cat_name'  => 'Hair',
            'cat_items' => array(
                array( 'name' => 'Blowout',                        'time' => '',  'price' => '20 €' ),
                array( 'name' => 'Haircut (without styling)',     'time' => '',  'price' => '25 €' ),
                array( 'name' => 'Haircut + blowout',             'time' => '',  'price' => '40 €' ),
                array( 'name' => 'Coloring (roots)',              'time' => '',  'price' => 'from 50 €' ),
                array( 'name' => 'Full color',                    'time' => '',  'price' => 'from 70 €' ),
                array( 'name' => 'Highlights',                    'time' => '',  'price' => 'from 80 €' ),
                array( 'name' => 'Keratin treatment',             'time' => '',  'price' => 'from 100 €' ),
                array( 'name' => 'Updo / styling',                'time' => '',  'price' => 'from 30 €' ),
            ),
        ),
    );
}
?>

<section class="prices" id="prices"<?php echo smooth_section_bg( 'prices_section_bg' ); ?>>
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
                        <?php if ( ! empty( $cat['cat_name'] ) ) : ?>
                            <h3 class="price-category-name"><?php echo esc_html( $cat['cat_name'] ); ?></h3>
                        <?php endif; ?>
                        <?php if ( is_array( $cat['cat_items'] ?? null ) ) : ?>
                            <ul class="price-list">
                                <?php foreach ( $cat['cat_items'] as $item ) : ?>
                                    <li class="price-item">
                                        <span class="price-name"><?php echo esc_html( $item['name'] ?? '' ); ?></span>
                                        <?php if ( ! empty( $item['time'] ) ) : ?>
                                            <span class="price-duration"><?php echo esc_html( $item['time'] ); ?></span>
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