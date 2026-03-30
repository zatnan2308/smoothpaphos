<?php
/**
 * Smooth Studio — Footer ACF Fields
 * CTA-секция + 4 колонки футера
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'acf/init', function () {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( array(
        'key'    => 'group_footer_settings',
        'title'  => 'Футер',
        'fields' => array(

            /* ── Таб 2: Контакты (колонка 1) ── */
            array( 'key' => 'field_footer_tab_contact', 'label' => '📍 Контакты', 'name' => '', 'type' => 'tab', 'placement' => 'top' ),

            array(
                'key'     => 'field_footer_email',
                'label'   => 'Email',
                'name'    => 'footer_email',
                'type'    => 'email',
                'wrapper' => array( 'width' => '50' ),
            ),

            /* ── Таб 3: Колонка 2 ── */
            array( 'key' => 'field_footer_tab_col2', 'label' => '🔗 Колонка 2 (ссылки)', 'name' => '', 'type' => 'tab', 'placement' => 'top' ),

            array(
                'key'           => 'field_footer_col2_title',
                'label'         => 'Заголовок колонки',
                'name'          => 'footer_col2_title',
                'type'          => 'text',
                'default_value' => 'Explore',
            ),
            array(
                'key'          => 'field_footer_col2_links',
                'label'        => 'Ссылки',
                'name'         => 'footer_col2_links',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => '+ Ссылка',
                'sub_fields'   => array(
                    array( 'key' => 'field_footer_col2_label', 'label' => 'Текст', 'name' => 'label', 'type' => 'text',    'wrapper' => array( 'width' => '55' ) ),
                    array( 'key' => 'field_footer_col2_url',   'label' => 'URL',   'name' => 'url',   'type' => 'url',     'wrapper' => array( 'width' => '45' ) ),
                ),
            ),

            /* ── Таб 4: Колонка 3 ── */
            array( 'key' => 'field_footer_tab_col3', 'label' => '💆 Колонка 3 (ссылки)', 'name' => '', 'type' => 'tab', 'placement' => 'top' ),

            array(
                'key'           => 'field_footer_col3_title',
                'label'         => 'Заголовок колонки',
                'name'          => 'footer_col3_title',
                'type'          => 'text',
                'default_value' => 'Treatments',
            ),
            array(
                'key'          => 'field_footer_col3_links',
                'label'        => 'Ссылки',
                'name'         => 'footer_col3_links',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => '+ Ссылка',
                'sub_fields'   => array(
                    array( 'key' => 'field_footer_col3_label', 'label' => 'Текст', 'name' => 'label', 'type' => 'text', 'wrapper' => array( 'width' => '55' ) ),
                    array( 'key' => 'field_footer_col3_url',   'label' => 'URL',   'name' => 'url',   'type' => 'url',  'wrapper' => array( 'width' => '45' ) ),
                ),
            ),

            /* ── Таб 5: Часы работы (колонка 4) ── */
            array( 'key' => 'field_footer_tab_hours', 'label' => '🕐 Часы работы', 'name' => '', 'type' => 'tab', 'placement' => 'top' ),

            array(
                'key'           => 'field_footer_hours_title',
                'label'         => 'Заголовок колонки',
                'name'          => 'footer_hours_title',
                'type'          => 'text',
                'default_value' => 'Working Hours',
            ),
            array(
                'key'          => 'field_footer_hours',
                'label'        => 'Расписание',
                'name'         => 'footer_hours',
                'type'         => 'repeater',
                'layout'       => 'table',
                'button_label' => '+ Строка',
                'sub_fields'   => array(
                    array(
                        'key'     => 'field_footer_hours_day',
                        'label'   => 'День',
                        'name'    => 'day',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '35' ),
                    ),
                    array(
                        'key'     => 'field_footer_hours_time',
                        'label'   => 'Время',
                        'name'    => 'hours_time',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '40' ),
                    ),
                    array(
                        'key'         => 'field_footer_hours_closed',
                        'label'       => 'Выходной',
                        'name'        => 'is_closed',
                        'type'        => 'true_false',
                        'ui'          => 1,
                        'default_value' => 0,
                        'wrapper'     => array( 'width' => '25' ),
                    ),
                ),
            ),

        ),
        'location' => array(
            array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'smooth-settings' ) ),
        ),
        'active' => true,
        'menu_order' => 10,
    ) );
} );
