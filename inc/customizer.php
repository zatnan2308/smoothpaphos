<?php
/**
 * Smooth Studio — WordPress Customizer: Header / Navbar
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/* ─── Helper: hex → rgba ─────────────────────────────────────────────────── */
function smooth_hex_to_rgba( $hex, $opacity = 1 ) {
    $hex = ltrim( $hex, '#' );
    if ( strlen( $hex ) === 3 ) {
        $hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
    }
    $r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );
    return "rgba({$r},{$g},{$b},{$opacity})";
}

/* ─── Register Customizer section & controls ─────────────────────────────── */
add_action( 'customize_register', 'smooth_customizer_register' );

function smooth_customizer_register( $wp_customize ) {

    $wp_customize->add_section( 'smooth_navbar', array(
        'title'    => 'Хэдер / Навигация',
        'priority' => 30,
    ) );

    /* ── Shorthand helpers ── */
    $section = 'smooth_navbar';

    $num = function ( $id, $label, $default, $min, $max, $step = 1 ) use ( $wp_customize, $section ) {
        $wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'absint',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $id, array(
            'label'       => $label,
            'section'     => $section,
            'type'        => 'number',
            'input_attrs' => array( 'min' => $min, 'max' => $max, 'step' => $step ),
        ) );
    };

    $color = function ( $id, $label, $default ) use ( $wp_customize, $section ) {
        $wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $id, array(
            'label'   => $label,
            'section' => $section,
        ) ) );
    };

    $range = function ( $id, $label, $default, $min, $max, $step ) use ( $wp_customize, $section ) {
        $wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $id, array(
            'label'       => $label,
            'section'     => $section,
            'type'        => 'range',
            'input_attrs' => array( 'min' => $min, 'max' => $max, 'step' => $step ),
        ) );
    };

    $text = function ( $id, $label, $default ) use ( $wp_customize, $section ) {
        $wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'refresh',
        ) );
        $wp_customize->add_control( $id, array(
            'label'   => $label,
            'section' => $section,
            'type'    => 'text',
        ) );
    };

    /* ── ① Pill: положение и форма ── */
    $num(  'smooth_nav_top',         'Отступ навбара сверху (px)',        16,  0, 80 );
    $num(  'smooth_nav_pill_radius', 'Скругление пилюли (px)',            56,  0, 100 );
    $num(  'smooth_nav_pill_gap',    'Зазор между секциями пилюли (px)',  24,  0, 80 );
    $num(  'smooth_nav_pill_left',   'Левый внутренний отступ пилюли (px)', 28, 4, 60 );

    /* ── ② Стеклянный эффект (над hero) ── */
    $color( 'smooth_nav_glass_color',   'Стекло — цвет фона',                 '#ffffff' );
    $range( 'smooth_nav_glass_opacity', 'Стекло — прозрачность (0–1)',         '0.18', 0, 1, 0.01 );
    $num(   'smooth_nav_glass_blur',    'Стекло — блюр (px)',                  24, 0, 60 );
    $range( 'smooth_nav_glass_border',  'Стекло — граница, прозрач. (0–1)',   '0.20', 0, 1, 0.01 );

    /* ── ③ При скролле ── */
    $color( 'smooth_nav_scrolled_color',   'При скролле — цвет фона',           '#fcf9f6' );
    $range( 'smooth_nav_scrolled_opacity', 'При скролле — прозрачность (0–1)', '0.88', 0, 1, 0.01 );

    /* ── ④ Логотип ── */
    $num(   'smooth_logo_size',          'Лого — размер шрифта (px)',          20, 10, 60 );
    $color( 'smooth_logo_color',         'Лого — цвет (над hero)',              '#ffffff' );
    $color( 'smooth_logo_scrolled_color','Лого — цвет при скролле',             '#2c2a28' );
    $color( 'smooth_logo_hover_color',   'Лого — цвет при наведении',           '#8b9d83' );

    /* ── ⑤ Ссылки меню ── */
    $num(   'smooth_navlink_size',           'Ссылки — размер шрифта (px)',        11,  7, 24 );
    $num(   'smooth_navlink_gap',            'Ссылки — расстояние между (px)',     32,  8, 80 );
    $color( 'smooth_navlink_color',          'Ссылки — цвет (над hero)',           '#ffffff' );
    $range( 'smooth_navlink_opacity',        'Ссылки — прозрачность (0–1)',        '0.80', 0, 1, 0.01 );
    $color( 'smooth_navlink_scrolled_color', 'Ссылки — цвет при скролле',          '#2c2a28' );
    $color( 'smooth_navlink_hover_color',    'Ссылки — цвет при наведении/активна', '#8b9d83' );

    /* ── ⑥ Кнопка Book Now ── */
    $text(  'smooth_book_text',             'Кнопка Book — текст',                '' );
    $num(   'smooth_book_size',             'Кнопка Book — размер шрифта (px)',   10,  7, 22 );
    $color( 'smooth_book_color',            'Кнопка Book — цвет текста',           '#ffffff' );
    $color( 'smooth_book_hover_color',      'Кнопка Book — цвет текста при наведении', '#ffffff' );
    $color( 'smooth_book_bg',               'Кнопка Book — фон (над hero)',        '#ffffff' );
    $range( 'smooth_book_bg_opacity',       'Кнопка Book — прозрач. фона (0–1)',  '0.20', 0, 1, 0.01 );
    $color( 'smooth_book_hover_bg',         'Кнопка Book — фон при наведении',    '#ffffff' );
    $range( 'smooth_book_hover_bg_opacity', 'Кнопка Book — прозрач. фона при наведении (0–1)', '0.32', 0, 1, 0.01 );
    $color( 'smooth_book_scrolled_bg',      'Кнопка Book — фон при скролле',      '#2c2a28' );
    $color( 'smooth_book_scrolled_hover_bg','Кнопка Book — фон при скролле+наведении', '#8b9d83' );
}

/* ─── Вывод CSS-переменных через wp_add_inline_style (после smooth.css) ───── */
add_action( 'wp_enqueue_scripts', 'smooth_customizer_css', 20 );

function smooth_customizer_css() {
    // Проверяем что основная таблица стилей темы уже зарегистрирована
    if ( ! wp_style_is( 'smooth-style', 'enqueued' ) ) {
        return;
    }

    /* ── Пилюля ── */
    $nav_top     = absint( get_theme_mod( 'smooth_nav_top',         16 ) );
    $pill_radius = absint( get_theme_mod( 'smooth_nav_pill_radius', 56 ) );
    $pill_gap    = absint( get_theme_mod( 'smooth_nav_pill_gap',    24 ) );
    $pill_left   = absint( get_theme_mod( 'smooth_nav_pill_left',   28 ) );

    /* ── Стекло ── */
    $glass_color   = sanitize_hex_color( get_theme_mod( 'smooth_nav_glass_color',   '#ffffff' ) ) ?: '#ffffff';
    $glass_opacity = (float) get_theme_mod( 'smooth_nav_glass_opacity', '0.18' );
    $glass_blur    = absint( get_theme_mod( 'smooth_nav_glass_blur', 24 ) );
    $glass_border  = (float) get_theme_mod( 'smooth_nav_glass_border', '0.20' );

    /* ── При скролле ── */
    $scrolled_color   = sanitize_hex_color( get_theme_mod( 'smooth_nav_scrolled_color',   '#fcf9f6' ) ) ?: '#fcf9f6';
    $scrolled_opacity = (float) get_theme_mod( 'smooth_nav_scrolled_opacity', '0.88' );

    /* ── Логотип ── */
    $logo_size     = absint( get_theme_mod( 'smooth_logo_size',          20 ) );
    $logo_color    = sanitize_hex_color( get_theme_mod( 'smooth_logo_color',          '#ffffff' ) ) ?: '#ffffff';
    $logo_scrolled = sanitize_hex_color( get_theme_mod( 'smooth_logo_scrolled_color', '#2c2a28' ) ) ?: '#2c2a28';
    $logo_hover    = sanitize_hex_color( get_theme_mod( 'smooth_logo_hover_color',    '#8b9d83' ) ) ?: '#8b9d83';

    /* ── Ссылки меню ── */
    $link_size     = absint( get_theme_mod( 'smooth_navlink_size',           11 ) );
    $link_gap      = absint( get_theme_mod( 'smooth_navlink_gap',            32 ) );
    $link_color    = sanitize_hex_color( get_theme_mod( 'smooth_navlink_color',          '#ffffff' ) ) ?: '#ffffff';
    $link_opacity  = (float) get_theme_mod( 'smooth_navlink_opacity', '0.80' );
    $link_scrolled = sanitize_hex_color( get_theme_mod( 'smooth_navlink_scrolled_color', '#2c2a28' ) ) ?: '#2c2a28';
    $link_hover    = sanitize_hex_color( get_theme_mod( 'smooth_navlink_hover_color',    '#8b9d83' ) ) ?: '#8b9d83';

    /* ── Кнопка Book ── */
    $book_size          = absint( get_theme_mod( 'smooth_book_size',            10 ) );
    $book_color         = sanitize_hex_color( get_theme_mod( 'smooth_book_color',         '#ffffff' ) ) ?: '#ffffff';
    $book_hover_color   = sanitize_hex_color( get_theme_mod( 'smooth_book_hover_color',   '#ffffff' ) ) ?: '#ffffff';
    $book_bg            = sanitize_hex_color( get_theme_mod( 'smooth_book_bg',            '#ffffff' ) ) ?: '#ffffff';
    $book_bg_opacity    = (float) get_theme_mod( 'smooth_book_bg_opacity',       '0.20' );
    $book_hover_bg      = sanitize_hex_color( get_theme_mod( 'smooth_book_hover_bg',      '#ffffff' ) ) ?: '#ffffff';
    $book_hover_opacity = (float) get_theme_mod( 'smooth_book_hover_bg_opacity', '0.32' );
    $book_scrolled_bg   = sanitize_hex_color( get_theme_mod( 'smooth_book_scrolled_bg',       '#2c2a28' ) ) ?: '#2c2a28';
    $book_scrolled_h    = sanitize_hex_color( get_theme_mod( 'smooth_book_scrolled_hover_bg', '#8b9d83' ) ) ?: '#8b9d83';

    /* ── Вычисленные rgba ── */
    $glass_bg_rgba     = smooth_hex_to_rgba( $glass_color,   $glass_opacity );
    $glass_border_rgba = smooth_hex_to_rgba( '#ffffff',       $glass_border );
    $scrolled_bg_rgba  = smooth_hex_to_rgba( $scrolled_color, $scrolled_opacity );
    $link_color_rgba   = smooth_hex_to_rgba( $link_color,     $link_opacity );
    $book_bg_rgba      = smooth_hex_to_rgba( $book_bg,        $book_bg_opacity );
    $book_hover_rgba   = smooth_hex_to_rgba( $book_hover_bg,  $book_hover_opacity );

    /* ── Строим CSS и вставляем inline сразу после smooth.css ── */
    $css = "
:root {
    --nav-top:                {$nav_top}px;
    --nav-pill-radius:        {$pill_radius}px;
    --nav-pill-gap:           {$pill_gap}px;
    --nav-pill-left:          {$pill_left}px;
    --nav-glass-bg:           {$glass_bg_rgba};
    --nav-glass-blur:         {$glass_blur}px;
    --nav-glass-border:       {$glass_border_rgba};
    --nav-scrolled-bg:        {$scrolled_bg_rgba};
    --logo-size:              {$logo_size}px;
    --logo-color:             {$logo_color};
    --logo-scrolled-color:    {$logo_scrolled};
    --logo-hover-color:       {$logo_hover};
    --navlink-size:           {$link_size}px;
    --navlink-gap:            {$link_gap}px;
    --navlink-color:          {$link_color_rgba};
    --navlink-scrolled-color: {$link_scrolled};
    --navlink-hover-color:    {$link_hover};
    --book-size:              {$book_size}px;
    --book-color:             {$book_color};
    --book-hover-color:       {$book_hover_color};
    --book-bg:                {$book_bg_rgba};
    --book-hover-bg:          {$book_hover_rgba};
    --book-scrolled-bg:       {$book_scrolled_bg};
    --book-scrolled-hover-bg: {$book_scrolled_h};
}";

    wp_add_inline_style( 'smooth-style', $css );
}

/* ─── Enqueue live-preview script in Customizer ──────────────────────────── */
add_action( 'customize_preview_init', 'smooth_customizer_preview_js' );

function smooth_customizer_preview_js() {
    wp_enqueue_script(
        'smooth-customizer-preview',
        SMOOTH_URI . '/assets/js/customizer-preview.js',
        array( 'customize-preview', 'jquery' ),
        SMOOTH_VERSION,
        true
    );
}
