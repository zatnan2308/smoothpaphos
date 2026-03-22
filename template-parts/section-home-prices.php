<?php
/**
 * Template Part: Home Page Price List
 * Минималистичный блок цен на главной странице
 * Дизайн: sticky sidebar + строки услуг + маркеры (gold, label:, dark:)
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$hp_label      = get_field( 'prices_section_label' ) ?: 'Service Menu';
$hp_title_1    = get_field( 'prices_title' )          ?: 'Curated';
$hp_title_2    = get_field( 'prices_title_2' )        ?: 'Wellness';
$hp_desc       = get_field( 'prices_section_desc' )   ?: 'A minimalist approach to beauty and relaxation. Discover our precise, result-driven treatments in an atmosphere of absolute serenity.';
$hp_categories = get_field( 'price_categories' );

?>
<section class="home-prices"<?php echo smooth_section_bg( 'prices_section_bg' ); ?>>

    <!-- ── Заголовок блока ── -->
    <header class="home-prices__header">
        <span class="home-prices__label"><?php echo esc_html( $hp_label ); ?></span>
        <h2 class="home-prices__title">
            <?php echo esc_html( $hp_title_1 ); ?><br>
            <em><?php echo esc_html( $hp_title_2 ); ?></em>
        </h2>
        <?php if ( $hp_desc ) : ?>
            <p class="home-prices__desc"><?php echo esc_html( $hp_desc ); ?></p>
        <?php endif; ?>
    </header>

    <!-- ── Категории ── -->
    <div class="home-prices__wrap">

        <?php if ( $hp_categories ) : ?>
            <?php foreach ( $hp_categories as $cat ) :

                $cat_name  = $cat['cat_name']        ?? '';
                $cat_desc  = $cat['cat_description'] ?? '';
                $cat_items = $cat['cat_items']        ?? array();

            ?>
            <section class="hp-cat">

                <!-- Боковая колонка (sticky) -->
                <div class="hp-cat__sidebar">
                    <div class="hp-cat__sidebar-inner">
                        <h3 class="hp-cat__name"><?php echo esc_html( $cat_name ); ?></h3>
                        <?php if ( $cat_desc ) : ?>
                            <p class="hp-cat__desc"><?php echo esc_html( $cat_desc ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Список услуг -->
                <div class="hp-cat__list">
                    <?php foreach ( $cat_items as $item ) :

                        $i_name   = trim( $item['name']        ?? '' );
                        $i_time   = trim( $item['time']        ?? '' );
                        $i_price  = trim( $item['price']       ?? '' );
                        $i_marker = strtolower( trim( $item['description'] ?? '' ) );

                        /* ── Sub-category gold label: marker = "label:Packages & Face" ── */
                        if ( str_starts_with( $i_marker, 'label:' ) ) :
                            $label_text = trim( substr( $item['description'], 6 ) );
                    ?>
                        <div class="hp-sublabel"><?php echo esc_html( $label_text ); ?></div>

                    <?php

                        /* ── Dark banner block: marker = "dark:Hands + Legs + Bikini" ── */
                        elseif ( str_starts_with( $i_marker, 'dark:' ) ) :
                            $dark_sub = trim( substr( $item['description'], 5 ) );
                    ?>
                        <div class="hp-dark">
                            <div class="hp-dark__info">
                                <span class="hp-dark__name"><?php echo esc_html( $i_name ); ?></span>
                                <?php if ( $dark_sub ) : ?>
                                    <span class="hp-dark__sub"><?php echo esc_html( $dark_sub ); ?></span>
                                <?php endif; ?>
                            </div>
                            <span class="hp-dark__price"><?php echo esc_html( $i_price ); ?></span>
                        </div>

                    <?php

                        /* ── Regular row (optional gold price: marker = "gold") ── */
                        else :
                            $is_gold = ( $i_marker === 'gold' );
                    ?>
                        <div class="hp-row<?php echo $is_gold ? ' hp-row--gold' : ''; ?>">
                            <div class="hp-row__info">
                                <span class="hp-row__name"><?php echo esc_html( $i_name ); ?></span>
                                <?php if ( $i_time ) : ?>
                                    <span class="hp-row__time"><?php echo esc_html( $i_time ); ?></span>
                                <?php endif; ?>
                            </div>
                            <span class="hp-row__price"><?php echo esc_html( $i_price ); ?></span>
                        </div>

                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>

            </section>
            <?php endforeach; ?>

        <?php else : ?>

            <!-- Fallback: заполнитель если данные не введены -->
            <p class="home-prices__empty">Добавьте категории прайс-листа в разделе «💰 Прайс-лист» в настройках страницы.</p>

        <?php endif; ?>

    </div><!-- /.home-prices__wrap -->

</section>
