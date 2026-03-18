<?php
/**
 * Template Part: Prices Section
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$title       = get_field( 'prices_title' ) ?: 'Price List';
$price_list  = get_field( 'price_list' );
$bottom_text = get_field( 'prices_bottom_text' ) ?: '';
?>

<section class="prices" id="prices">
    <div class="container">

        <!-- Header -->
        <div class="prices-header">
            <h2 class="prices-title"><?php echo esc_html( $title ); ?></h2>
        </div>

        <?php if ( is_array( $price_list ) && ! empty( $price_list ) ) : ?>
            <?php
            $total  = count( $price_list );
            $half   = (int) ceil( $total / 2 );
            $col1   = array_slice( $price_list, 0, $half );
            $col2   = array_slice( $price_list, $half );
            ?>
            <div class="prices-grid">
                <!-- Column 1 -->
                <div class="prices-column">
                    <?php foreach ( $col1 as $item ) : ?>
                        <div class="price-item">
                            <div class="price-info">
                                <h4 class="price-name font-serif"><?php echo esc_html( $item['name'] ?? '' ); ?></h4>
                                <?php if ( ! empty( $item['description'] ) ) : ?>
                                    <p class="price-desc"><?php echo esc_html( $item['description'] ); ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="price-meta">
                                <span class="price-time"><?php echo esc_html( $item['time'] ?? '' ); ?></span>
                                <span class="price-value font-serif"><?php echo esc_html( $item['price'] ?? '' ); ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Column 2 -->
                <?php if ( $col2 ) : ?>
                    <div class="prices-column">
                        <?php foreach ( $col2 as $item ) : ?>
                            <div class="price-item">
                                <div class="price-info">
                                    <h4 class="price-name font-serif"><?php echo esc_html( $item['name'] ?? '' ); ?></h4>
                                    <?php if ( ! empty( $item['description'] ) ) : ?>
                                        <p class="price-desc"><?php echo esc_html( $item['description'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                                <div class="price-meta">
                                    <span class="price-time"><?php echo esc_html( $item['time'] ?? '' ); ?></span>
                                    <span class="price-value font-serif"><?php echo esc_html( $item['price'] ?? '' ); ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ( $bottom_text ) : ?>
            <div class="prices-footer">
                <div class="prices-scroll">
                    <span><?php echo esc_html( $bottom_text ); ?></span>
                    <div class="prices-scroll-line"></div>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>
