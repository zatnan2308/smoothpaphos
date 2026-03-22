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

            array( 'key' => 'field_footer_cta_anchor', 'label' => '⚓ Якорь CTA-секции (id)', 'name' => 'footer_cta_anchor', 'type' => 'text', 'default_value' => 'booking', 'placeholder' => 'booking', 'instructions' => 'ID для якорных ссылок в меню. Пример: booking → ссылка #booking', 'wrapper' => array( 'width' => '33' ) ),

            /* ── Таб 1: CTA-секция ── */
            array( 'key' => 'field_footer_tab_cta', 'label' => '📣 CTA-секция', 'name' => '', 'type' => 'tab', 'placement' => 'top' ),

            array(
                'key'           => 'field_footer_cta_heading',
                'label'         => 'Заголовок — первая строка',
                'name'          => 'footer_cta_heading',
                'type'          => 'text',
                'default_value' => 'Ready to feel',
                'instructions'  => 'Обычный текст (не курсив)',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_footer_cta_heading_em',
                'label'         => 'Заголовок — вторая строка (курсив)',
                'name'          => 'footer_cta_heading_em',
                'type'          => 'text',
                'default_value' => 'completely renewed?',
                'instructions'  => 'Выводится курсивом',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_footer_cta_desc',
                'label'         => 'Описание под заголовком',
                'name'          => 'footer_cta_desc',
                'type'          => 'textarea',
                'rows'          => 2,
                'default_value' => 'Join our community of beauty and wellness lovers. We\'re here to help you shine.',
            ),
            array(
                'key'           => 'field_footer_cta_btn_text',
                'label'         => 'Кнопка — текст',
                'name'          => 'footer_cta_btn_text',
                'type'          => 'text',
                'default_value' => 'Book Appointment',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'     => 'field_footer_cta_btn_url',
                'label'   => 'Кнопка — ссылка',
                'name'    => 'footer_cta_btn_url',
                'type'    => 'url',
                'wrapper' => array( 'width' => '50' ),
            ),

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
