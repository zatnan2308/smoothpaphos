<?php
/**
 * Template Part: Prices Section — Category-based layout
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$title      = get_field( 'prices_title' ) ?: 'Price List';
$categories = get_field( 'price_categories' );
$note       = get_field( 'prices_bottom_text' ) ?: '';
?>

<section class="prices" id="prices">
    <div class="container">

        <div class="prices-header">
            <h2 class="prices-title font-serif"><?php echo esc_html( $title ); ?></h2>
        </div>

        <?php if ( is_array( $categories ) && ! empty( $categories ) ) : ?>
            <div class="prices-grid">
                <?php foreach ( $categories as $cat ) :
                    $cat_name  = $cat['cat_name'] ?? '';
                    $cat_items = $cat['cat_items'] ?? array();
                    if ( empty( $cat_name ) && empty( $cat_items ) ) continue;
                ?>
                    <div class="price-category">
                        <?php if ( $cat_name ) : ?>
                            <span class="price-category-name"><?php echo esc_html( $cat_name ); ?></span>
                        <?php endif; ?>

                        <?php if ( is_array( $cat_items ) && ! empty( $cat_items ) ) : ?>
                            <div class="price-items-list">
                                <?php foreach ( $cat_items as $item ) :
                                    $name  = $item['name']  ?? '';
                                    $time  = $item['time']  ?? '';
                                    $price = $item['price'] ?? '';
                                    $desc  = $item['description'] ?? '';
                                ?>
                                    <div class="price-item">
                                        <div class="price-info">
                                            <span class="price-name"><?php echo esc_html( $name ); ?></span>
                                            <?php if ( $time ) : ?>
                                                <span class="price-time"><?php echo esc_html( $time ); ?></span>
                                            <?php endif; ?>
                                            <span class="price-dots" aria-hidden="true"></span>
                                        </div>
                                        <span class="price-value"><?php echo esc_html( $price ); ?></span>
                                    </div>
                                    <?php if ( $desc ) : ?>
                                        <p class="price-desc"><?php echo esc_html( $desc ); ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ( $note ) : ?>
            <p class="prices-note"><?php echo esc_html( $note ); ?></p>
        <?php endif; ?>

    </div>
</section>
