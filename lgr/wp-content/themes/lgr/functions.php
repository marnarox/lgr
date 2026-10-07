<?php
defined('ABSPATH') || exit;

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('html5', array('search-form', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('responsive-embeds');
});

add_action('enqueue_block_assets', function () {
    wp_enqueue_style('lgr-fonts', content_url('/fonts/fonts.css'), array(), '1.0');
    wp_enqueue_style('lgr-colors', content_url('/design-tokens/colors.css'), array(), '1.0');
    wp_enqueue_style('lgr-theme', get_stylesheet_uri(), array('lgr-fonts', 'lgr-colors'), (string) filemtime(get_stylesheet_directory() . '/style.css'));
});
