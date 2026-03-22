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
   FRONT PAGE — 🎬 Блок 1 — Hero Слайдер
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_hero',
    'title'  => '🎬 Блок 1 — Hero Слайдер',
    'fields' => array(

        /* ── Таб: Слайды ── */
        array( 'key' => 'tab_hero_slides', 'label' => '🎬 Слайды', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

        array(
            'key'          => 'field_hero_slides',
            'label'        => 'Слайды',
            'name'         => 'hero_slides',
            'type'         => 'repeater',
            'layout'       => 'block',
            'min'          => 0,
            'max'          => 5,
            'button_label' => 'Добавить слайд',
            'instructions' => 'Каждый слайд занимает весь экран. Оставьте пустым — будет использоваться тестовый контент.',
            'sub_fields'   => array(

                array( 'key' => 'field_slide_image',       'label' => 'Фоновое фото',            'name' => 'slide_image',       'type' => 'image',   'return_format' => 'array', 'preview_size' => 'medium' ),
                array( 'key' => 'field_slide_label',       'label' => 'Метка (uppercase, мелко)', 'name' => 'slide_label',       'type' => 'text',    'default_value' => 'Smooth Experience' ),
                array( 'key' => 'field_slide_title_1',     'label' => 'Заголовок — строка 1',     'name' => 'slide_title_1',     'type' => 'text',    'default_value' => 'Your Body,' ),
                array( 'key' => 'field_slide_title_2',     'label' => 'Заголовок — строка 2 (курсив)', 'name' => 'slide_title_2', 'type' => 'text',  'default_value' => 'Your Balance' ),

                smooth_wysiwyg_field(
                    'field_slide_description',
                    'Описание',
                    'slide_description',
                    'basic',
                    '<p>Individually tailored massage — for relaxation, recovery and ease of your body.</p>'
                ),

                array( 'key' => 'field_slide_btn_text', 'label' => 'Кнопка — текст',  'name' => 'slide_btn_text', 'type' => 'text', 'default_value' => 'Book a Session' ),
                array( 'key' => 'field_slide_btn_link', 'label' => 'Кнопка — ссылка', 'name' => 'slide_btn_link', 'type' => 'url' ),
            ),
        ),

        /* ── Таб: Настройки отображения ── */
        array( 'key' => 'field_hero_settings_tab', 'label' => '⚙️ Настройки отображения', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

        array(
            'key'           => 'field_hero_content_width',
            'label'         => 'Ширина блока контента',
            'name'          => 'hero_content_width',
            'type'          => 'select',
            'instructions'  => 'Максимальная ширина текстового блока на слайде',
            'choices'       => array(
                ''     => 'По умолчанию (640px)',
                '480'  => 'Узкий — 480px',
                '560'  => 'Чуть уже — 560px',
                '720'  => 'Широкий — 720px',
                '800'  => 'Очень широкий — 800px',
                'full' => 'На всю ширину',
            ),
            'default_value' => '',
            'allow_null'    => 1,
        ),

        array(
            'key'           => 'field_hero_title_font',
            'label'         => 'Шрифт заголовка',
            'name'          => 'hero_title_font',
            'type'          => 'select',
            'choices'       => array(
                ''     => 'Cormorant Garant (serif, по умолчанию)',
                'sans' => 'Inter (sans-serif)',
            ),
            'default_value' => '',
            'allow_null'    => 1,
        ),

        array(
            'key'           => 'field_hero_title_size',
            'label'         => 'Размер заголовка',
            'name'          => 'hero_title_size',
            'type'          => 'select',
            'instructions'  => 'Размер основного заголовка слайда',
            'choices'       => array(
                ''   => 'Средний (по умолчанию, ~6.5rem)',
                'sm' => 'Маленький (~4.5rem)',
                'lg' => 'Большой (~8rem)',
            ),
            'default_value' => '',
            'allow_null'    => 1,
        ),

        array(
            'key'           => 'field_hero_desc_size',
            'label'         => 'Размер описания',
            'name'          => 'hero_desc_size',
            'type'          => 'select',
            'instructions'  => 'Размер шрифта текста-описания под заголовком',
            'choices'       => array(
                ''   => 'Обычный (по умолчанию, ~15px)',
                'sm' => 'Маленький (~13px)',
                'lg' => 'Большой (~17px)',
            ),
            'default_value' => '',
            'allow_null'    => 1,
        ),

        array(
            'key'           => 'field_hero_btn_style',
            'label'         => 'Стиль кнопки',
            'name'          => 'hero_btn_style',
            'type'          => 'select',
            'instructions'  => 'Цвет и стиль кнопки на слайде',
            'choices'       => array(
                ''              => 'Белая заливка (по умолчанию)',
                'gold'          => 'Золотая заливка',
                'outline-white' => 'Обводка белая',
                'outline-gold'  => 'Обводка золотая',
            ),
            'default_value' => '',
            'allow_null'    => 1,
        ),

        /* ── Таб: Legacy поля ── */
        array( 'key' => 'field_hero_settings_legacy_tab', 'label' => '📦 Legacy поля', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

        array( 'key' => 'field_hero_badge',          'label' => 'Legacy: Badge',        'name' => 'hero_badge',          'type' => 'text' ),
        array( 'key' => 'field_hero_title_1',        'label' => 'Legacy: Title 1',      'name' => 'hero_title_1',        'type' => 'text' ),
        array( 'key' => 'field_hero_title_2',        'label' => 'Legacy: Title 2',      'name' => 'hero_title_2',        'type' => 'text' ),
        smooth_wysiwyg_field( 'field_hero_description', 'Legacy: Description', 'hero_description', 'basic', '' ),
        array( 'key' => 'field_hero_button_1_text',  'label' => 'Legacy: Btn 1 text',   'name' => 'hero_button_1_text',  'type' => 'text' ),
        array( 'key' => 'field_hero_button_1_link',  'label' => 'Legacy: Btn 1 link',   'name' => 'hero_button_1_link',  'type' => 'url' ),
        array( 'key' => 'field_hero_image',          'label' => 'Legacy: Image',        'name' => 'hero_image',          'type' => 'image', 'return_format' => 'array' ),
        array( 'key' => 'field_hero_card_title',     'label' => 'Legacy: Card title',   'name' => 'hero_card_title',     'type' => 'text' ),
        smooth_wysiwyg_field( 'field_hero_card_text', 'Legacy: Card text', 'hero_card_text', 'basic', '' ),
    ),
    'location'   => array(
        array( array( 'param' => 'page_type',     'operator' => '==', 'value' => 'front_page' ) ),
        array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-home.php' ) ),
    ),
    'menu_order' => 0,
) );


/* =========================================================================
   FRONT PAGE + ABOUT PAGE — ✨ Блок 2 — Философия / About
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_philosophy',
    'title'  => '✨ Блок 2 — Философия / About',
    'fields' => array(

        /* ── Таб: Контент ── */
        array( 'key' => 'tab_philosophy_content', 'label' => '📝 Контент', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

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

        /* ── Таб: Оформление ── */
        array( 'key' => 'tab_philosophy_design', 'label' => '🎨 Оформление', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

        array( 'key' => 'field_philosophy_section_bg', 'label' => '🎨 Фон секции «Философия»', 'name' => 'philosophy_section_bg', 'type' => 'color_picker', 'default_value' => '', 'instructions' => 'Цвет фона блока. Пусто = стандартный (#FFFEFD).', 'wrapper' => array( 'width' => '40' ) ),
    ),
    'location'   => array(
        array( array( 'param' => 'page_type',     'operator' => '==', 'value' => 'front_page' ) ),
        array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-about.php' ) ),
    ),
    'menu_order' => 1,
) );


/* =========================================================================
   FRONT PAGE — 💆 Блок 3 — Меню услуг (заменяет Price List на главной)
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_svc_menu',
    'title'  => '💆 Блок 3 — Меню услуг',
    'fields' => array(

        /* ── Таб: Шапка блока ── */
        array( 'key' => 'tab_svc_menu_header', 'label' => '📋 Шапка блока', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

        array( 'key' => 'field_svc_menu_label',       'label' => 'Метка (маленький текст)',        'name' => 'svc_menu_label',       'type' => 'text', 'default_value' => 'SERVICE MENU' ),
        array( 'key' => 'field_svc_menu_title_1',     'label' => 'Заголовок — строка 1',           'name' => 'svc_menu_title_1',     'type' => 'text', 'default_value' => 'Wide range of' ),
        array( 'key' => 'field_svc_menu_title_2',     'label' => 'Заголовок — строка 2 (курсив)',  'name' => 'svc_menu_title_2',     'type' => 'text', 'default_value' => 'procedures' ),
        array( 'key' => 'field_svc_menu_description', 'label' => 'Описание (справа от заголовка)', 'name' => 'svc_menu_description', 'type' => 'textarea', 'rows' => 3, 'default_value' => 'We have gathered the best care techniques so you can find everything you need in one place. The art of caring for your body.' ),
        array( 'key' => 'field_svc_menu_link_text',   'label' => 'Ссылка — текст',                 'name' => 'svc_menu_link_text',   'type' => 'text', 'default_value' => 'FULL PRICE LIST' ),
        array( 'key' => 'field_svc_menu_link_url',    'label' => 'Ссылка — URL',                   'name' => 'svc_menu_link_url',    'type' => 'url' ),

        /* ── Таб: Категории ── */
        array( 'key' => 'tab_svc_menu_cats', 'label' => '🗂️ Категории', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

        array(
            'key'          => 'field_svc_menu_categories',
            'label'        => 'Категории услуг',
            'name'         => 'svc_menu_categories',
            'type'         => 'repeater',
            'layout'       => 'block',
            'min'          => 0,
            'max'          => 8,
            'button_label' => 'Добавить категорию',
            'instructions' => 'Четные категории — фото слева, нечётные — фото справа.',
            'sub_fields'   => array(
                array( 'key' => 'field_svc_cat_icon',  'label' => 'Иконка (emoji)',     'name' => 'cat_icon',  'type' => 'text', 'default_value' => '🧘', 'instructions' => 'Вставьте emoji: 🧘 💅 🪒 💆' ),
                array( 'key' => 'field_svc_cat_name',  'label' => 'Название категории', 'name' => 'cat_name',  'type' => 'text', 'placeholder' => 'Massage' ),
                array(
                    'key'          => 'field_svc_cat_description',
                    'label'        => 'Описание категории (курсив под названием)',
                    'name'         => 'cat_description',
                    'type'         => 'textarea',
                    'rows'         => 2,
                    'placeholder'  => 'The art of touch for complete restoration of strength and inner harmony.',
                    'instructions' => 'Короткое описание, отображается курсивом под названием раздела.',
                ),
                array( 'key' => 'field_svc_cat_image', 'label' => 'Фото категории',    'name' => 'cat_image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium' ),
                array(
                    'key'          => 'field_svc_cat_link_url',
                    'label'        => 'Ссылка кнопки «Записаться»',
                    'name'         => 'cat_link_url',
                    'type'         => 'url',
                    'placeholder'  => '#booking',
                    'instructions' => 'URL для кнопки «ЗАПИСАТЬСЯ НА ПРОЦЕДУРУ». По умолчанию — #booking.',
                ),
                array(
                    'key'          => 'field_svc_cat_services',
                    'label'        => 'Список услуг (каждая с новой строки)',
                    'name'         => 'cat_services',
                    'type'         => 'textarea',
                    'rows'         => 8,
                    'instructions' => "Каждая услуга — отдельная строка. Делятся на 2 колонки автоматически.\nОберните в **двойные звёздочки** для выделения жирным курсивом: **Anti-cellulite Package**",
                    'placeholder'  => "Relax Massage\nDeep Tissue Massage\n**Anti-cellulite Package**",
                ),
            ),
        ),

        /* ── Таб: Оформление ── */
        array( 'key' => 'tab_svc_menu_design', 'label' => '🎨 Оформление', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

        array( 'key' => 'field_svc_menu_section_bg', 'label' => '🎨 Фон секции «Меню услуг»', 'name' => 'svc_menu_section_bg', 'type' => 'color_picker', 'default_value' => '', 'instructions' => 'Цвет фона блока. Пусто = стандартный (#FFFEFD).', 'wrapper' => array( 'width' => '40' ) ),
    ),
    'location'   => array(
        array( array( 'param' => 'page_type',     'operator' => '==', 'value' => 'front_page' ) ),
        array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-home.php' ) ),
    ),
    'menu_order' => 2,
) );


/* =========================================================================
   SERVICES PAGE — 💰 Прайс-лист
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_prices',
    'title'  => '💰 Прайс-лист',
    'fields' => array(

        /* ── Таб: Позиции ── */
        array( 'key' => 'tab_prices_items', 'label' => '📋 Позиции прайс-листа', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

        /* ── Заголовок блока (для главной страницы) ── */
        array( 'key' => 'field_prices_section_label', 'label' => 'Метка (маленький текст над заголовком)', 'name' => 'prices_section_label', 'type' => 'text', 'default_value' => 'Service Menu', 'wrapper' => array( 'width' => '33' ) ),
        array( 'key' => 'field_prices_title',         'label' => 'Заголовок — строка 1',                  'name' => 'prices_title',         'type' => 'text', 'default_value' => 'Curated',      'wrapper' => array( 'width' => '33' ) ),
        array( 'key' => 'field_prices_title_2',       'label' => 'Заголовок — строка 2 (курсив)',          'name' => 'prices_title_2',       'type' => 'text', 'default_value' => 'Wellness',     'wrapper' => array( 'width' => '33' ) ),
        array( 'key' => 'field_prices_section_desc',  'label' => 'Описание под заголовком',                'name' => 'prices_section_desc',  'type' => 'textarea', 'rows' => 3, 'default_value' => 'A minimalist approach to beauty and relaxation. Discover our precise, result-driven treatments in an atmosphere of absolute serenity.' ),

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
                    'key'          => 'field_cat_description_price',
                    'label'        => 'Описание категории (боковая колонка)',
                    'name'         => 'cat_description',
                    'type'         => 'textarea',
                    'rows'         => 2,
                    'placeholder'  => 'Body and face therapies designed to relieve tension…',
                    'instructions' => 'Краткое описание, отображается под названием категории в блоке Price на главной.',
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
                        array( 'key' => 'field_item_name',  'label' => 'Услуга',      'name' => 'name',        'type' => 'text', 'placeholder' => 'Relax Massage' ),
                        array( 'key' => 'field_item_time',  'label' => 'Время (опц.)', 'name' => 'time',        'type' => 'text', 'placeholder' => '60 min' ),
                        array( 'key' => 'field_item_price', 'label' => 'Цена',         'name' => 'price',       'type' => 'text', 'placeholder' => '€50' ),
                        array(
                            'key'          => 'field_item_desc',
                            'label'        => 'Тип/маркер (опц.)',
                            'name'         => 'description',
                            'type'         => 'text',
                            'placeholder'  => 'gold / label:Packages & Face / dark:Subtitle',
                            'instructions' => "Специальные маркеры:\ngold — золотая цена\nlabel:Текст — золотой разделитель-подзаголовок (поле Название = пусто)\ndark:Подзаголовок — тёмный блок-пакет (напр. «Hands + Legs + Bikini»)",
                        ),
                    ),
                ),

            ),
        ),

        array( 'key' => 'field_prices_bottom_text', 'label' => 'Примечание внизу', 'name' => 'prices_bottom_text', 'type' => 'text', 'placeholder' => 'All prices include materials' ),

        /* ── Таб: Оформление ── */
        array( 'key' => 'tab_prices_design', 'label' => '🎨 Оформление', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

        array( 'key' => 'field_prices_section_bg', 'label' => '🎨 Фон секции «Прайс-лист»', 'name' => 'prices_section_bg', 'type' => 'color_picker', 'default_value' => '', 'instructions' => 'Цвет фона блока. Пусто = стандартный (#FFFEFD).', 'wrapper' => array( 'width' => '40' ) ),
    ),
    'location'   => array(
        array( array( 'param' => 'page_type',     'operator' => '==', 'value' => 'front_page' ) ),
        array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-services.php' ) ),
    ),
    'menu_order' => 2,
) );


/* =========================================================================
   FRONT PAGE + ABOUT PAGE — 👩 Блок 4 — Мастер
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_master',
    'title'  => '👩 Блок 4 — Мастер',
    'fields' => array(

        /* ── Таб: Контент ── */
        array( 'key' => 'tab_master_content', 'label' => '📝 Контент', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

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

        /* ── Таб: Оформление ── */
        array( 'key' => 'tab_master_design', 'label' => '🎨 Оформление', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

        array( 'key' => 'field_master_section_bg', 'label' => '🎨 Фон секции «Мастер»', 'name' => 'master_section_bg', 'type' => 'color_picker', 'default_value' => '', 'instructions' => 'Цвет фона блока. Пусто = стандартный (#FFFEFD).', 'wrapper' => array( 'width' => '40' ) ),
    ),
    'location'   => array(
        array( array( 'param' => 'page_type',     'operator' => '==', 'value' => 'front_page' ) ),
        array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-about.php' ) ),
    ),
    'menu_order' => 3,
) );


/* =========================================================================
   FRONT PAGE + SERVICES PAGE — ❓ Блок 5 — FAQ + Контакты
   ========================================================================= */
acf_add_local_field_group( array(
    'key'    => 'group_faq',
    'title'  => '❓ Блок 5 — FAQ + Контакты',
    'fields' => array(

        /* ── Таб: FAQ ── */
        array( 'key' => 'tab_faq_items', 'label' => '❓ FAQ', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

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

        /* ── Таб: Блок контактов ── */
        array( 'key' => 'tab_faq_contacts', 'label' => '📞 Блок контактов', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

        array( 'key' => 'field_contact_title', 'label' => 'Заголовок блока контактов', 'name' => 'contact_title', 'type' => 'text', 'default_value' => 'Get in Touch' ),

        /* ── Таб: Оформление ── */
        array( 'key' => 'tab_faq_design', 'label' => '🎨 Оформление', 'name' => '', 'type' => 'tab', 'placement' => 'top', 'endpoint' => 0 ),

        array( 'key' => 'field_faq_section_bg', 'label' => '🎨 Фон секции «FAQ + Контакты»', 'name' => 'faq_section_bg', 'type' => 'color_picker', 'default_value' => '', 'instructions' => 'Цвет фона блока. Пусто = стандартный (#FFFEFD).', 'wrapper' => array( 'width' => '40' ) ),
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
        array( 'key' => 'field_page_hero_section_bg', 'label' => '🎨 Фон Page Hero', 'name' => 'page_hero_section_bg', 'type' => 'color_picker', 'default_value' => '', 'instructions' => 'Цвет фона шапки страницы. Пусто = стандартный (#FFFEFD).', 'wrapper' => array( 'width' => '40' ) ),
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
        /* ── Фон секций About ── */
        array( 'key' => 'field_about_story_section_bg',  'label' => '🎨 Фон «История»',  'name' => 'about_story_section_bg',  'type' => 'color_picker', 'default_value' => '', 'instructions' => 'Фон блока «Our Story». Пусто = #FFFEFD.', 'wrapper' => array( 'width' => '33' ) ),
        array( 'key' => 'field_about_values_section_bg', 'label' => '🎨 Фон «Ценности»', 'name' => 'about_values_section_bg', 'type' => 'color_picker', 'default_value' => '', 'instructions' => 'Фон блока «Our Values». Пусто = #FFFEFD.', 'wrapper' => array( 'width' => '33' ) ),
        array( 'key' => 'field_about_cta_section_bg',   'label' => '🎨 Фон «CTA»',       'name' => 'about_cta_section_bg',   'type' => 'color_picker', 'default_value' => '', 'instructions' => 'Фон CTA-блока. Пусто = #FFFEFD.', 'wrapper' => array( 'width' => '33' ) ),
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
        /* ── Фон секций Services ── */
        array( 'key' => 'field_services_intro_section_bg',      'label' => '🎨 Фон «Введение»',  'name' => 'services_intro_section_bg',      'type' => 'color_picker', 'default_value' => '', 'instructions' => 'Фон блока «Введение». Пусто = #FFFEFD.', 'wrapper' => array( 'width' => '50' ) ),
        array( 'key' => 'field_services_cats_section_bg',       'label' => '🎨 Фон «Категории»', 'name' => 'services_cats_section_bg',       'type' => 'color_picker', 'default_value' => '', 'instructions' => 'Фон блока «Категории услуг». Пусто = #FFFEFD.', 'wrapper' => array( 'width' => '50' ) ),
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
        array( 'key' => 'field_contacts_section_bg', 'label' => '🎨 Фон страницы контактов', 'name' => 'contacts_section_bg', 'type' => 'color_picker', 'default_value' => '', 'instructions' => 'Цвет фона блока контактов. Пусто = стандартный (#FFFEFD).', 'wrapper' => array( 'width' => '40' ) ),
    ),
    'location'   => array( array( array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-contacts.php' ) ) ),
    'menu_order' => 1,
) );
