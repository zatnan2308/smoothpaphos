<?php
/**
 * Smooth Studio — Mega Menu
 * ACF-поля для управления мегаменю через опции + HTML-builder
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ─── Регистрация полей ACF ──────────────────────────────────────────────── */
add_action( 'acf/init', function () {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( array(
        'key'    => 'group_mega_menu',
        'title'  => 'Мега-меню',
        'fields' => array(

            array(
                'key'          => 'field_mega_menu_columns',
                'label'        => 'Колонки мега-меню',
                'instructions' => 'Чтобы подключить мегаменю к пункту, добавьте CSS-класс <strong>has-mega</strong> в настройках меню (Внешний вид → Меню → Параметры экрана → CSS-классы).',
                'name'         => 'mega_menu_columns',
                'type'         => 'repeater',
                'layout'       => 'block',
                'min'          => 0,
                'max'          => 6,
                'button_label' => '+ Добавить колонку',
                'sub_fields'   => array(

                    /* Иконка */
                    array(
                        'key'           => 'field_mega_col_icon',
                        'label'         => 'Иконка',
                        'name'          => 'mega_col_icon',
                        'type'          => 'select',
                        'choices'       => array(
                            'leaf'          => '🌿 Лист (Массаж)',
                            'scissors'      => '✂️ Ножницы (Волосы)',
                            'sparkles'      => '✨ Искры (Ногти)',
                            'zap'           => '⚡ Молния (Депиляция)',
                            'hand'          => '✋ Рука',
                            'heart'         => '❤️ Сердце',
                            'star'          => '⭐ Звезда',
                            'gem'           => '💎 Кристалл',
                            'smile'         => '😊 Смайл',
                            'shield'        => '🛡 Щит',
                        ),
                        'allow_null'    => 0,
                        'default_value' => 'leaf',
                        'wrapper'       => array( 'width' => '30' ),
                    ),

                    /* Цвет фона иконки */
                    array(
                        'key'            => 'field_mega_col_icon_bg',
                        'label'          => 'Фон иконки',
                        'name'           => 'mega_col_icon_bg',
                        'type'           => 'color_picker',
                        'default_value'  => '#e8e3da',
                        'enable_opacity' => 0,
                        'wrapper'        => array( 'width' => '20' ),
                    ),

                    /* Цвет иконки */
                    array(
                        'key'            => 'field_mega_col_icon_color',
                        'label'          => 'Цвет иконки',
                        'name'           => 'mega_col_icon_color',
                        'type'           => 'color_picker',
                        'default_value'  => '#ffffff',
                        'enable_opacity' => 0,
                        'wrapper'        => array( 'width' => '20' ),
                    ),

                    /* Заголовок */
                    array(
                        'key'     => 'field_mega_col_title',
                        'label'   => 'Заголовок колонки',
                        'name'    => 'mega_col_title',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '30' ),
                    ),

                    /* Список услуг */
                    array(
                        'key'          => 'field_mega_col_services',
                        'label'        => 'Услуги',
                        'name'         => 'mega_col_services',
                        'type'         => 'repeater',
                        'layout'       => 'table',
                        'min'          => 0,
                        'button_label' => '+ Услуга',
                        'sub_fields'   => array(
                            array(
                                'key'     => 'field_mega_svc_label',
                                'label'   => 'Название',
                                'name'    => 'mega_svc_label',
                                'type'    => 'text',
                                'wrapper' => array( 'width' => '55' ),
                            ),
                            array(
                                'key'     => 'field_mega_svc_url',
                                'label'   => 'Ссылка',
                                'name'    => 'mega_svc_url',
                                'type'    => 'url',
                                'wrapper' => array( 'width' => '45' ),
                            ),
                        ),
                    ),

                    /* Ссылка «View Prices» */
                    array(
                        'key'     => 'field_mega_col_prices_url',
                        'label'   => '"View Prices" — ссылка',
                        'name'    => 'mega_col_prices_url',
                        'type'    => 'url',
                        'wrapper' => array( 'width' => '50' ),
                    ),

                    array(
                        'key'           => 'field_mega_col_prices_label',
                        'label'         => '"View Prices" — текст',
                        'name'          => 'mega_col_prices_label',
                        'type'          => 'text',
                        'default_value' => 'View Prices',
                        'wrapper'       => array( 'width' => '50' ),
                    ),

                ),
            ),

        ),
        'location' => array(
            array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'smooth-settings' ) ),
        ),
        'active' => true,
    ) );
} );


/* ─── HTML-builder: возвращает готовую разметку мегаменю ────────────────── */
function smooth_mega_menu_html() {
    if ( ! function_exists( 'get_field' ) ) {
        return '';
    }

    $columns = get_field( 'mega_menu_columns', 'option' );
    if ( empty( $columns ) ) {
        return '';
    }

    $html  = '<div class="mega-menu" role="region" aria-label="Услуги">';
    $html .= '<div class="mega-grid">';

    foreach ( $columns as $col ) {
        $icon_name    = isset( $col['mega_col_icon'] )         ? sanitize_key( $col['mega_col_icon'] )          : 'leaf';
        $icon_bg      = isset( $col['mega_col_icon_bg'] )      ? esc_attr( $col['mega_col_icon_bg'] )           : '#e8e3da';
        $icon_color   = isset( $col['mega_col_icon_color'] )   ? esc_attr( $col['mega_col_icon_color'] )        : '#ffffff';
        $title        = isset( $col['mega_col_title'] )        ? esc_html( $col['mega_col_title'] )             : '';
        $prices_url   = isset( $col['mega_col_prices_url'] )   ? esc_url( $col['mega_col_prices_url'] )         : '#';
        $prices_label = isset( $col['mega_col_prices_label'] ) ? esc_html( $col['mega_col_prices_label'] )      : 'View Prices';

        $html .= '<div class="mega-col">';

        /* Шапка колонки: иконка + заголовок */
        $html .= '<div class="mega-col-head">';
        $html .= '<div class="mega-icon-box" style="background:' . $icon_bg . ';color:' . $icon_color . '">'
               . smooth_icon( $icon_name, 22 )
               . '</div>';
        $html .= '<span class="mega-col-title">' . $title . '</span>';
        $html .= '</div>'; /* .mega-col-head */

        /* Список услуг */
        if ( ! empty( $col['mega_col_services'] ) ) {
            $html .= '<ul class="mega-services">';
            foreach ( $col['mega_col_services'] as $svc ) {
                $svc_url   = isset( $svc['mega_svc_url'] )   ? esc_url( $svc['mega_svc_url'] )     : '#';
                $svc_label = isset( $svc['mega_svc_label'] ) ? esc_html( $svc['mega_svc_label'] ) : '';
                $html .= '<li><a href="' . $svc_url . '">' . $svc_label . '</a></li>';
            }
            $html .= '</ul>';
        }

        /* Ссылка «View Prices» */
        $html .= '<a href="' . $prices_url . '" class="mega-prices-link">'
               . '<span>' . $prices_label . '</span>'
               . smooth_icon( 'arrow-right', 13 )
               . '</a>';

        $html .= '</div>'; /* .mega-col */
    }

    $html .= '</div>'; /* .mega-grid */
    $html .= '</div>'; /* .mega-menu */

    return $html;
}
