<?php
/**
 * ACF Options Page — Global Settings
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'acf_add_options_page' ) ) {

    acf_add_options_page( array(
        'page_title' => 'Smooth Studio — Настройки',
        'menu_title' => 'Smooth Settings',
        'menu_slug'  => 'smooth-settings',
        'capability' => 'manage_options',
        'redirect'   => false,
        'icon_url'   => 'dashicons-palmtree',
        'position'   => 2,
    ) );

}
