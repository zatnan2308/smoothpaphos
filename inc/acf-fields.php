<?php
/**
 * ACF Fields Registration
 * All custom fields for Smooth Studio theme
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
}

/* =========================================================================
   OPTIONS PAGE — Global Settings
   ========================================================================= */
acf_add_local_field_group( array(
    'key'      => 'group_smooth_options',
    'title'    => 'Глобальные настройки',
    'fields'   => array(

        /* --- Logo --- */
        array(
            'key'   => 'field_logo_text',
            'label' => 'Логотип — основной текст',
            'name'  => 'logo_text',
            'type'  => 'text',
            'default_value' => 'Smooth',
        ),
        array(
            'key'   => 'field_logo_subtitle',
            'label' => 'Логотип — подпись',
            'name'  => 'logo_subtitle',
            'type'  => 'text',
            'default_value' => 'Studio',
        ),

        /* --- Contacts --- */
        array(
            'key'   => 'field_phone_number',
            'label' => 'Телефон',
            'name'  => 'phone_number',
            'type'  => 'text',
            'placeholder' => '+357 99 123456',
        ),
        array(
            'key'   => 'field_whatsapp_link',
            'label' => 'Ссылка WhatsApp',
            'name'  => 'whatsapp_link',
            'type'  => 'url',
            'placeholder' => 'https://wa.me/35799123456',
        ),
        array(
            'key'   => 'field_whatsapp_button_text',
            'label' => 'Текст кнопки WhatsApp',
            'name'  => 'whatsapp_button_text',
            'type'  => 'text',
            'default_value' => 'Написать в WhatsApp',
        ),
        array(
            'key'   => 'field_instagram_handle',
            'label' => 'Instagram — аккаунт',
            'name'  => 'instagram_handle',
            'type'  => 'text',
            'default_value' => 'smoothstudio.paphos',
        ),
        array(
            'key'   => 'field_instagram_url',
            'label' => 'Instagram — ссылка',
            'name'  => 'instagram_url',
            'type'  => 'url',
            'placeholder' => 'https://instagram.com/smoothstudio.paphos',
        ),
        array(
            'key'   => 'field_address',
            'label' => 'Адрес',
            'name'  => 'address',
            'type'  => 'text',
            'default_value' => 'Artemidos 25, Paphos',
        ),

        /* --- Booking --- */
        array(
            'key'   => 'field_booking_button_text',
            'label' => 'Текст кнопки записи',
            'name'  => 'booking_button_text',
            'type'  => 'text',
            'default_value' => 'Запись',
        ),
        array(
            'key'   => 'field_booking_link',
            'label' => 'Ссылка кнопки записи',
            'name'  => 'booking_link',
            'type'  => 'url',
        ),

        /* --- Footer --- */
        array(
            'key'   => 'field_copyright_text',
            'label' => 'Копирайт (футер)',
            'name'  => 'copyright_text',
            'type'  => 'text',
            'default_value' => '2024 Smooth Studio. All rights reserved.',
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'options_page',
                'operator' => '==',
                'value'    => 'smooth-settings',
            ),
        ),
    ),
) );


/* =========================================================================
   FRONT PAGE — Hero Section
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_hero',
    'title'  => 'Hero секция',
    'fields' => array(
        array(
            'key'   => 'field_hero_badge',
            'label' => 'Бейдж (маленький текст сверху)',
            'name'  => 'hero_badge',
            'type'  => 'text',
            'default_value' => 'Paphos, Cyprus',
        ),
        array(
            'key'   => 'field_hero_title_1',
            'label' => 'Заголовок — строка 1',
            'name'  => 'hero_title_1',
            'type'  => 'text',
            'default_value' => 'Smooth',
        ),
        array(
            'key'   => 'field_hero_title_2',
            'label' => 'Заголовок — строка 2 (курсив)',
            'name'  => 'hero_title_2',
            'type'  => 'text',
            'default_value' => 'Experience',
        ),
        array(
            'key'   => 'field_hero_description',
            'label' => 'Описание',
            'name'  => 'hero_description',
            'type'  => 'textarea',
            'rows'  => 3,
            'default_value' => 'Массаж подбирается индивидуально — для расслабления, восстановления и лёгкости вашего тела.',
        ),
        array(
            'key'   => 'field_hero_button_1_text',
            'label' => 'Кнопка 1 — текст',
            'name'  => 'hero_button_1_text',
            'type'  => 'text',
            'default_value' => 'Записаться в Direct',
        ),
        array(
            'key'   => 'field_hero_button_1_link',
            'label' => 'Кнопка 1 — ссылка',
            'name'  => 'hero_button_1_link',
            'type'  => 'url',
        ),
        array(
            'key'   => 'field_hero_button_2_text',
            'label' => 'Кнопка 2 — текст',
            'name'  => 'hero_button_2_text',
            'type'  => 'text',
            'default_value' => 'Наш Instagram',
        ),
        array(
            'key'   => 'field_hero_button_2_link',
            'label' => 'Кнопка 2 — ссылка',
            'name'  => 'hero_button_2_link',
            'type'  => 'url',
        ),
        array(
            'key'           => 'field_hero_image',
            'label'         => 'Фото (Hero)',
            'name'          => 'hero_image',
            'type'          => 'image',
            'return_format' => 'array',
            'preview_size'  => 'medium',
        ),
        array(
            'key'   => 'field_hero_card_title',
            'label' => 'Карточка — заголовок',
            'name'  => 'hero_card_title',
            'type'  => 'text',
            'default_value' => 'О мастере',
        ),
        array(
            'key'   => 'field_hero_card_text',
            'label' => 'Карточка — текст',
            'name'  => 'hero_card_text',
            'type'  => 'textarea',
            'rows'  => 2,
            'default_value' => 'Диана — эксперт с опытом более 5 лет.',
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'page_type',
                'operator' => '==',
                'value'    => 'front_page',
            ),
        ),
    ),
    'menu_order' => 0,
) );


/* =========================================================================
   FRONT PAGE — Philosophy Section
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_philosophy',
    'title'  => 'Философия секция',
    'fields' => array(
        array(
            'key'   => 'field_philosophy_label',
            'label' => 'Метка (маленький текст)',
            'name'  => 'philosophy_label',
            'type'  => 'text',
            'default_value' => 'Философия',
        ),
        array(
            'key'   => 'field_philosophy_title',
            'label' => 'Заголовок',
            'name'  => 'philosophy_title',
            'type'  => 'text',
            'default_value' => 'Более десяти техник',
        ),
        array(
            'key'   => 'field_philosophy_description',
            'label' => 'Описание',
            'name'  => 'philosophy_description',
            'type'  => 'textarea',
            'rows'  => 4,
            'default_value' => 'В Smooth Studio мы верим, что каждый массаж должен быть уникальным. Мы предлагаем более десяти техник, чтобы тело чувствовало себя свободно, а разум — спокойно.',
        ),
        array(
            'key'        => 'field_philosophy_features',
            'label'      => 'Особенности',
            'name'       => 'philosophy_features',
            'type'       => 'repeater',
            'layout'     => 'block',
            'min'        => 0,
            'max'        => 6,
            'sub_fields' => array(
                array(
                    'key'          => 'field_feature_icon',
                    'label'        => 'Иконка',
                    'name'         => 'icon',
                    'type'         => 'select',
                    'choices'      => array(
                        'shield'   => 'Shield (качество)',
                        'map-pin'  => 'Map Pin (локация)',
                        'heart'    => 'Heart (забота)',
                        'star'     => 'Star (звезда)',
                        'clock'    => 'Clock (время)',
                        'check'    => 'Check (галочка)',
                    ),
                    'default_value' => 'shield',
                ),
                array(
                    'key'   => 'field_feature_text',
                    'label' => 'Текст',
                    'name'  => 'text',
                    'type'  => 'text',
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'page_type',
                'operator' => '==',
                'value'    => 'front_page',
            ),
        ),
    ),
    'menu_order' => 1,
) );


/* =========================================================================
   FRONT PAGE — Prices Section
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_prices',
    'title'  => 'Цены секция',
    'fields' => array(
        array(
            'key'   => 'field_prices_title',
            'label' => 'Заголовок',
            'name'  => 'prices_title',
            'type'  => 'text',
            'default_value' => 'Price List',
        ),
        array(
            'key'        => 'field_price_list',
            'label'      => 'Прайс-лист',
            'name'       => 'price_list',
            'type'       => 'repeater',
            'layout'     => 'table',
            'min'        => 0,
            'max'        => 30,
            'sub_fields' => array(
                array(
                    'key'   => 'field_price_name',
                    'label' => 'Название',
                    'name'  => 'name',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_price_time',
                    'label' => 'Время',
                    'name'  => 'time',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_price_value',
                    'label' => 'Цена',
                    'name'  => 'price',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_price_desc',
                    'label' => 'Описание (необязат.)',
                    'name'  => 'description',
                    'type'  => 'text',
                ),
            ),
        ),
        array(
            'key'   => 'field_prices_bottom_text',
            'label' => 'Текст внизу',
            'name'  => 'prices_bottom_text',
            'type'  => 'text',
            'default_value' => 'Scroll for more',
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'page_type',
                'operator' => '==',
                'value'    => 'front_page',
            ),
        ),
    ),
    'menu_order' => 2,
) );


/* =========================================================================
   FRONT PAGE — Master Section
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_master',
    'title'  => 'Мастер секция',
    'fields' => array(
        array(
            'key'   => 'field_master_label',
            'label' => 'Метка (маленький текст)',
            'name'  => 'master_label',
            'type'  => 'text',
            'default_value' => 'Ваш мастер',
        ),
        array(
            'key'   => 'field_master_name',
            'label' => 'Имя мастера',
            'name'  => 'master_name',
            'type'  => 'text',
            'default_value' => 'Diana',
        ),
        array(
            'key'   => 'field_master_quote',
            'label' => 'Цитата',
            'name'  => 'master_quote',
            'type'  => 'textarea',
            'rows'  => 3,
            'default_value' => 'В нашей студии вы почувствуете легкость, восстановление и гармонию. Я помогу вам перезагрузиться после трудового дня.',
        ),
        array(
            'key'           => 'field_master_image',
            'label'         => 'Фото мастера / студии',
            'name'          => 'master_image',
            'type'          => 'image',
            'return_format' => 'array',
            'preview_size'  => 'medium',
        ),
        array(
            'key'        => 'field_master_stats',
            'label'      => 'Статистика',
            'name'       => 'master_stats',
            'type'       => 'repeater',
            'layout'     => 'table',
            'min'        => 0,
            'max'        => 4,
            'sub_fields' => array(
                array(
                    'key'   => 'field_stat_number',
                    'label' => 'Число',
                    'name'  => 'number',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_stat_label',
                    'label' => 'Подпись',
                    'name'  => 'label',
                    'type'  => 'text',
                ),
            ),
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'page_type',
                'operator' => '==',
                'value'    => 'front_page',
            ),
        ),
    ),
    'menu_order' => 3,
) );


/* =========================================================================
   FRONT PAGE — FAQ & Contacts Section
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_faq',
    'title'  => 'FAQ секция',
    'fields' => array(
        array(
            'key'   => 'field_faq_title',
            'label' => 'Заголовок FAQ',
            'name'  => 'faq_title',
            'type'  => 'text',
            'default_value' => 'Важно знать',
        ),
        array(
            'key'        => 'field_faq_items',
            'label'      => 'Вопросы и ответы',
            'name'       => 'faq_items',
            'type'       => 'repeater',
            'layout'     => 'block',
            'min'        => 0,
            'max'        => 15,
            'sub_fields' => array(
                array(
                    'key'   => 'field_faq_question',
                    'label' => 'Вопрос',
                    'name'  => 'question',
                    'type'  => 'text',
                ),
                array(
                    'key'   => 'field_faq_answer',
                    'label' => 'Ответ',
                    'name'  => 'answer',
                    'type'  => 'textarea',
                    'rows'  => 3,
                ),
            ),
        ),
        array(
            'key'   => 'field_contact_title',
            'label' => 'Заголовок блока контактов',
            'name'  => 'contact_title',
            'type'  => 'text',
            'default_value' => 'На связи',
        ),
    ),
    'location' => array(
        array(
            array(
                'param'    => 'page_type',
                'operator' => '==',
                'value'    => 'front_page',
            ),
        ),
    ),
    'menu_order' => 4,
) );
