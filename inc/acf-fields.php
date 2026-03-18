<?php
/**
 * ACF Fields Registration — Smooth Studio Theme
 * Все группы полей для всех шаблонов
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
    return;
}

/* =========================================================================
   HELPER: Общие параметры WYSIWYG поля
   ========================================================================= */
function smooth_wysiwyg_field( $key, $label, $name, $toolbar = 'basic', $defaults = '' ) {
    return array(
        'key'           => $key,
        'label'         => $label,
        'name'          => $name,
        'type'          => 'wysiwyg',
        'toolbar'       => $toolbar,  // 'basic' или 'full'
        'media_upload'  => 0,
        'delay'         => 0,
        'default_value' => $defaults,
    );
}


/* =========================================================================
   OPTIONS PAGE — Global Settings
   ========================================================================= */
acf_add_local_field_group( array(
    'key'      => 'group_smooth_options',
    'title'    => 'Глобальные настройки',
    'fields'   => array(

        array( 'key' => 'field_logo_text',     'label' => 'Логотип — основной текст', 'name' => 'logo_text',     'type' => 'text', 'default_value' => 'Smooth' ),
        array( 'key' => 'field_logo_subtitle', 'label' => 'Логотип — подпись',        'name' => 'logo_subtitle', 'type' => 'text', 'default_value' => 'Studio' ),

        array( 'key' => 'field_phone_number',         'label' => 'Телефон',                   'name' => 'phone_number',         'type' => 'text', 'placeholder' => '+357 99 123456' ),
        array( 'key' => 'field_whatsapp_link',        'label' => 'Ссылка WhatsApp',            'name' => 'whatsapp_link',        'type' => 'url',  'placeholder' => 'https://wa.me/35799123456' ),
        array( 'key' => 'field_whatsapp_button_text', 'label' => 'Текст кнопки WhatsApp',      'name' => 'whatsapp_button_text', 'type' => 'text', 'default_value' => 'Message on WhatsApp' ),
        array( 'key' => 'field_instagram_handle',     'label' => 'Instagram — аккаунт',        'name' => 'instagram_handle',     'type' => 'text', 'default_value' => 'smoothstudio.paphos' ),
        array( 'key' => 'field_instagram_url',        'label' => 'Instagram — ссылка',         'name' => 'instagram_url',        'type' => 'url',  'placeholder' => 'https://instagram.com/smoothstudio.paphos' ),
        array( 'key' => 'field_address',              'label' => 'Адрес',                      'name' => 'address',              'type' => 'text', 'default_value' => 'Artemidos 25, Paphos, Cyprus' ),

        array( 'key' => 'field_booking_button_text', 'label' => 'Текст кнопки записи', 'name' => 'booking_button_text', 'type' => 'text', 'default_value' => 'Book Now' ),
        array( 'key' => 'field_booking_link',        'label' => 'Ссылка кнопки записи', 'name' => 'booking_link', 'type' => 'url' ),

        array( 'key' => 'field_copyright_text', 'label' => 'Копирайт (футер)', 'name' => 'copyright_text', 'type' => 'text', 'default_value' => 'Smooth Studio. All rights reserved.' ),
    ),
    'location' => array( array( array( 'param' => 'options_page', 'operator' => '==', 'value' => 'smooth-settings' ) ) ),
) );


/* =========================================================================
   FRONT PAGE — Hero Section
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_hero',
    'title'  => 'Hero секция',
    'fields' => array(
        array( 'key' => 'field_hero_badge',    'label' => 'Бейдж (маленький текст)', 'name' => 'hero_badge',    'type' => 'text', 'default_value' => 'Paphos, Cyprus' ),
        array( 'key' => 'field_hero_title_1',  'label' => 'Заголовок — строка 1',    'name' => 'hero_title_1',  'type' => 'text', 'default_value' => 'Smooth' ),
        array( 'key' => 'field_hero_title_2',  'label' => 'Заголовок — строка 2 (курсив)', 'name' => 'hero_title_2', 'type' => 'text', 'default_value' => 'Experience' ),

        smooth_wysiwyg_field( 'field_hero_description', 'Описание (поддерживает жирный/курсив)', 'hero_description', 'basic',
            '<p>Individually tailored massage — for relaxation, recovery and ease of your body.</p>'
        ),

        array( 'key' => 'field_hero_button_1_text', 'label' => 'Кнопка 1 — текст',  'name' => 'hero_button_1_text', 'type' => 'text', 'default_value' => 'Book via Direct' ),
        array( 'key' => 'field_hero_button_1_link', 'label' => 'Кнопка 1 — ссылка', 'name' => 'hero_button_1_link', 'type' => 'url' ),
        array( 'key' => 'field_hero_button_2_text', 'label' => 'Кнопка 2 — текст',  'name' => 'hero_button_2_text', 'type' => 'text', 'default_value' => 'Our Instagram' ),
        array( 'key' => 'field_hero_button_2_link', 'label' => 'Кнопка 2 — ссылка', 'name' => 'hero_button_2_link', 'type' => 'url' ),

        array( 'key' => 'field_hero_image', 'label' => 'Фото (Hero)', 'name' => 'hero_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium' ),

        array( 'key' => 'field_hero_card_title', 'label' => 'Карточка — заголовок', 'name' => 'hero_card_title', 'type' => 'text', 'default_value' => 'About the master' ),

        smooth_wysiwyg_field( 'field_hero_card_text', 'Карточка — текст', 'hero_card_text', 'basic',
            '<p>Diana — expert with over 5 years of experience.</p>'
        ),
    ),
    'location'   => array( array( array( 'param' => 'page_type', 'operator' => '==', 'value' => 'front_page' ) ) ),
    'menu_order' => 0,
) );


/* =========================================================================
   FRONT PAGE + ABOUT PAGE — Philosophy Section
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_philosophy',
    'title'  => 'Философия / About секция',
    'fields' => array(
        array( 'key' => 'field_philosophy_label', 'label' => 'Метка (маленький текст)', 'name' => 'philosophy_label', 'type' => 'text', 'default_value' => 'Philosophy' ),
        array( 'key' => 'field_philosophy_title', 'label' => 'Заголовок (поддерживает <em> и <strong>)', 'name' => 'philosophy_title', 'type' => 'text', 'default_value' => 'More than ten techniques' ),

        smooth_wysiwyg_field( 'field_philosophy_description', 'Описание', 'philosophy_description', 'full',
            '<p>At Smooth Studio we believe that every massage should be unique. We offer more than ten techniques so that your body feels free and your mind — at peace.</p>'
        ),

        array(
            'key'        => 'field_philosophy_features',
            'label'      => 'Особенности (список)',
            'name'       => 'philosophy_features',
            'type'       => 'repeater',
            'layout'     => 'block',
            'min'        => 0,
            'max'        => 6,
            'sub_fields' => array(
                array(
                    'key'           => 'field_feature_icon',
                    'label'         => 'Иконка',
                    'name'          => 'icon',
                    'type'          => 'select',
                    'choices'       => array(
                        'shield'   => 'Shield (качество)',
                        'map-pin'  => 'Map Pin (локация)',
                        'heart'    => 'Heart (забота)',
                        'star'     => 'Star (звезда)',
                        'clock'    => 'Clock (время)',
                        'check'    => 'Check (галочка)',
                    ),
                    'default_value' => 'shield',
                ),
                array( 'key' => 'field_feature_text', 'label' => 'Текст', 'name' => 'text', 'type' => 'text' ),
            ),
        ),
    ),
    'location'   => array(
        array( array( 'param' => 'page_type',     'operator' => '==', 'value' => 'front_page' ) ),
        array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-about.php' ) ),
    ),
    'menu_order' => 1,
) );


/* =========================================================================
   FRONT PAGE + SERVICES PAGE — Prices Section
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_prices',
    'title'  => 'Цены / Price List',
    'fields' => array(
        array( 'key' => 'field_prices_title', 'label' => 'Заголовок', 'name' => 'prices_title', 'type' => 'text', 'default_value' => 'Price List' ),

        // Nested repeater: категории → позиции
        array(
            'key'        => 'field_price_categories',
            'label'      => 'Категории прайса',
            'name'       => 'price_categories',
            'type'       => 'repeater',
            'layout'     => 'block',
            'min'        => 0,
            'max'        => 20,
            'button_label' => 'Добавить категорию',
            'sub_fields' => array(

                array(
                    'key'           => 'field_cat_name',
                    'label'         => 'Название категории',
                    'name'          => 'cat_name',
                    'type'          => 'text',
                    'placeholder'   => 'Massage / Sugaring & Waxing / Nails / Hair…',
                    'instructions'  => 'Отображается как заголовок блока (золотой фон)',
                ),

                array(
                    'key'          => 'field_cat_items',
                    'label'        => 'Позиции в категории',
                    'name'         => 'cat_items',
                    'type'         => 'repeater',
                    'layout'       => 'table',
                    'min'          => 0,
                    'max'          => 40,
                    'button_label' => 'Добавить позицию',
                    'sub_fields'   => array(
                        array( 'key' => 'field_item_name',  'label' => 'Услуга',           'name' => 'name',        'type' => 'text', 'placeholder' => 'Relax Massage' ),
                        array( 'key' => 'field_item_time',  'label' => 'Время (опц.)',      'name' => 'time',        'type' => 'text', 'placeholder' => '60 min' ),
                        array( 'key' => 'field_item_price', 'label' => 'Цена',              'name' => 'price',       'type' => 'text', 'placeholder' => '€50' ),
                        array( 'key' => 'field_item_desc',  'label' => 'Подпись (опц.)',    'name' => 'description', 'type' => 'text', 'placeholder' => '90 min €70' ),
                    ),
                ),

            ),
        ),

        array( 'key' => 'field_prices_bottom_text', 'label' => 'Примечание внизу', 'name' => 'prices_bottom_text', 'type' => 'text', 'placeholder' => 'All prices include materials' ),
    ),
    'location'   => array(
        array( array( 'param' => 'page_type',     'operator' => '==', 'value' => 'front_page' ) ),
        array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-services.php' ) ),
    ),
    'menu_order' => 2,
) );


/* =========================================================================
   FRONT PAGE + ABOUT PAGE — Master Section
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_master',
    'title'  => 'Мастер секция',
    'fields' => array(
        array( 'key' => 'field_master_label', 'label' => 'Метка (маленький текст)', 'name' => 'master_label', 'type' => 'text', 'default_value' => 'Your Master' ),
        array( 'key' => 'field_master_name',  'label' => 'Имя мастера',             'name' => 'master_name',  'type' => 'text', 'default_value' => 'Diana' ),

        smooth_wysiwyg_field( 'field_master_quote', 'Цитата мастера', 'master_quote', 'basic',
            '<p>At our studio you will feel lightness, recovery and harmony. I will help you recharge after a long day.</p>'
        ),

        array( 'key' => 'field_master_image', 'label' => 'Фото мастера / студии', 'name' => 'master_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium' ),
        array(
            'key'        => 'field_master_stats',
            'label'      => 'Статистика',
            'name'       => 'master_stats',
            'type'       => 'repeater',
            'layout'     => 'table',
            'min'        => 0,
            'max'        => 4,
            'sub_fields' => array(
                array( 'key' => 'field_stat_number', 'label' => 'Число',   'name' => 'number', 'type' => 'text' ),
                array( 'key' => 'field_stat_label',  'label' => 'Подпись', 'name' => 'label',  'type' => 'text' ),
            ),
        ),
    ),
    'location'   => array(
        array( array( 'param' => 'page_type',     'operator' => '==', 'value' => 'front_page' ) ),
        array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-about.php' ) ),
    ),
    'menu_order' => 3,
) );


/* =========================================================================
   FRONT PAGE + SERVICES PAGE — FAQ Section
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_faq',
    'title'  => 'FAQ секция',
    'fields' => array(
        array( 'key' => 'field_faq_title', 'label' => 'Заголовок FAQ', 'name' => 'faq_title', 'type' => 'text', 'default_value' => 'Good to Know' ),
        array(
            'key'        => 'field_faq_items',
            'label'      => 'Вопросы и ответы',
            'name'       => 'faq_items',
            'type'       => 'repeater',
            'layout'     => 'block',
            'min'        => 0,
            'max'        => 15,
            'sub_fields' => array(
                array( 'key' => 'field_faq_question', 'label' => 'Вопрос', 'name' => 'question', 'type' => 'text' ),
                smooth_wysiwyg_field( 'field_faq_answer', 'Ответ (поддерживает форматирование)', 'answer', 'basic' ),
            ),
        ),
        array( 'key' => 'field_contact_title', 'label' => 'Заголовок блока контактов', 'name' => 'contact_title', 'type' => 'text', 'default_value' => 'Get in Touch' ),
    ),
    'location'   => array(
        array( array( 'param' => 'page_type',     'operator' => '==', 'value' => 'front_page' ) ),
        array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-services.php' ) ),
    ),
    'menu_order' => 4,
) );


/* =========================================================================
   ОБЩИЙ PAGE HERO — для всех внутренних страниц (About, Services, Contacts)
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_page_hero',
    'title'  => 'Page Hero (заголовок страницы)',
    'fields' => array(
        array( 'key' => 'field_page_hero_subtitle', 'label' => 'Подзаголовок (маленький текст)', 'name' => 'page_hero_subtitle', 'type' => 'text' ),
        array( 'key' => 'field_page_hero_title',    'label' => 'Заголовок страницы (поддерживает <em> и <strong>)', 'name' => 'page_hero_title', 'type' => 'text' ),
        array( 'key' => 'field_page_hero_image',    'label' => 'Фоновое изображение', 'name' => 'page_hero_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium' ),
    ),
    'location'   => array(
        array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-about.php' ) ),
        array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-services.php' ) ),
        array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-contacts.php' ) ),
    ),
    'menu_order' => 0,
) );


/* =========================================================================
   ABOUT PAGE — Story & Values
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_about_content',
    'title'  => 'About — История и ценности',
    'fields' => array(

        /* -- Story -- */
        array( 'key' => 'field_about_story_label', 'label' => 'Метка истории', 'name' => 'about_story_label', 'type' => 'text', 'default_value' => 'Our Story' ),
        array( 'key' => 'field_about_story_title', 'label' => 'Заголовок истории (поддерживает <em> и <strong>)', 'name' => 'about_story_title', 'type' => 'text', 'default_value' => 'Born from a passion for wellbeing' ),

        smooth_wysiwyg_field( 'field_about_story_content', 'Текст истории', 'about_story_content', 'full',
            '<p>Smooth Studio was created to offer more than just a massage — it is a place where you can truly unwind, restore your energy and reconnect with yourself.</p>'
        ),

        array( 'key' => 'field_about_story_image', 'label' => 'Фото студии / истории', 'name' => 'about_story_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium' ),

        /* -- Values -- */
        array( 'key' => 'field_about_values_title', 'label' => 'Заголовок ценностей', 'name' => 'about_values_title', 'type' => 'text', 'default_value' => 'Our Values' ),
        array(
            'key'        => 'field_about_values',
            'label'      => 'Ценности (список)',
            'name'       => 'about_values',
            'type'       => 'repeater',
            'layout'     => 'block',
            'min'        => 0,
            'max'        => 6,
            'sub_fields' => array(
                array(
                    'key'           => 'field_value_icon',
                    'label'         => 'Иконка',
                    'name'          => 'icon',
                    'type'          => 'select',
                    'choices'       => array(
                        'heart'    => 'Heart',
                        'shield'   => 'Shield',
                        'star'     => 'Star',
                        'check'    => 'Check',
                        'clock'    => 'Clock',
                        'map-pin'  => 'Location',
                    ),
                    'default_value' => 'heart',
                ),
                array( 'key' => 'field_value_title', 'label' => 'Название ценности', 'name' => 'title', 'type' => 'text' ),
                smooth_wysiwyg_field( 'field_value_text', 'Описание', 'text', 'basic' ),
            ),
        ),

        /* -- CTA -- */
        smooth_wysiwyg_field( 'field_about_cta_text', 'CTA — текст (над кнопкой)', 'about_cta_text', 'basic',
            '<p>Ready to experience the difference? Book your session today.</p>'
        ),
        array( 'key' => 'field_about_cta_button_text', 'label' => 'CTA — текст кнопки', 'name' => 'about_cta_button_text', 'type' => 'text', 'default_value' => 'Book a Session' ),
        array( 'key' => 'field_about_cta_button_link', 'label' => 'CTA — ссылка кнопки', 'name' => 'about_cta_button_link', 'type' => 'url' ),
    ),
    'location'   => array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-about.php' ) ) ),
    'menu_order' => 1,
) );


/* =========================================================================
   SERVICES PAGE — Intro & Categories
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_services_content',
    'title'  => 'Services — Введение и категории',
    'fields' => array(

        array( 'key' => 'field_services_intro_label', 'label' => 'Метка', 'name' => 'services_intro_label', 'type' => 'text', 'default_value' => 'What We Offer' ),
        array( 'key' => 'field_services_intro_title', 'label' => 'Заголовок (поддерживает <em> и <strong>)', 'name' => 'services_intro_title', 'type' => 'text', 'default_value' => 'Techniques tailored to you' ),

        smooth_wysiwyg_field( 'field_services_intro_content', 'Описание услуг', 'services_intro_content', 'full',
            '<p>Every treatment at Smooth Studio is customised to your needs. We combine the best massage techniques to help you relax, recover and feel your best.</p>'
        ),

        array(
            'key'        => 'field_services_categories',
            'label'      => 'Категории услуг',
            'name'       => 'services_categories',
            'type'       => 'repeater',
            'layout'     => 'block',
            'min'        => 0,
            'max'        => 8,
            'sub_fields' => array(
                array(
                    'key'           => 'field_service_cat_icon',
                    'label'         => 'Иконка',
                    'name'          => 'icon',
                    'type'          => 'select',
                    'choices'       => array(
                        'heart'    => 'Heart',
                        'shield'   => 'Shield',
                        'star'     => 'Star',
                        'clock'    => 'Clock',
                        'check'    => 'Check',
                        'map-pin'  => 'Location',
                    ),
                    'default_value' => 'star',
                ),
                array( 'key' => 'field_service_cat_name', 'label' => 'Название категории', 'name' => 'name', 'type' => 'text' ),
                smooth_wysiwyg_field( 'field_service_cat_desc', 'Описание категории', 'description', 'basic' ),
            ),
        ),
    ),
    'location'   => array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-services.php' ) ) ),
    'menu_order' => 1,
) );


/* =========================================================================
   CONTACTS PAGE — Intro, Map, Hours
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_contacts_content',
    'title'  => 'Contacts — Контент страницы',
    'fields' => array(

        array( 'key' => 'field_contacts_intro_title', 'label' => 'Заголовок (поддерживает <em> и <strong>)', 'name' => 'contacts_intro_title', 'type' => 'text', 'default_value' => 'Get in Touch' ),

        smooth_wysiwyg_field( 'field_contacts_intro_content', 'Описание / приветствие', 'contacts_intro_content', 'full',
            '<p>We are always happy to hear from you. Drop us a message on WhatsApp or visit us at the studio in Paphos.</p>'
        ),

        array( 'key' => 'field_contacts_map_url', 'label' => 'Google Maps — embed URL (iframe src)', 'name' => 'contacts_map_url', 'type' => 'url', 'placeholder' => 'https://www.google.com/maps/embed?pb=...' ),

        array(
            'key'        => 'field_contacts_hours',
            'label'      => 'Часы работы',
            'name'       => 'contacts_hours',
            'type'       => 'repeater',
            'layout'     => 'table',
            'min'        => 0,
            'max'        => 7,
            'sub_fields' => array(
                array( 'key' => 'field_hours_day',  'label' => 'День',  'name' => 'day',  'type' => 'text', 'placeholder' => 'Monday – Friday' ),
                array( 'key' => 'field_hours_time', 'label' => 'Время', 'name' => 'time', 'type' => 'text', 'placeholder' => '10:00 – 20:00' ),
            ),
        ),
    ),
    'location'   => array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-contacts.php' ) ) ),
    'menu_order' => 1,
) );
