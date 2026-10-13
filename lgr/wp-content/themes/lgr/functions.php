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
    $styles = array(
        'base' => 'assets/css/base.css',
        'layout' => 'assets/css/layout.css',
        'header' => 'assets/css/components/header.css',
        'navigation' => 'assets/css/components/navigation.css',
        'footer' => 'assets/css/components/footer.css',
        'buttons' => 'assets/css/components/buttons.css',
        'hero' => 'assets/css/sections/hero.css',
        'brand-marquee' => 'assets/css/components/brand-marquee.css',
        'nos-produits' => 'assets/css/sections/nos-produits.css',
        'product-grid' => 'assets/css/components/product-grid.css',
        'nos-valeurs' => 'assets/css/sections/nos-valeurs.css',
        'nos-marques' => 'assets/css/sections/nos-marques.css',
        'hero-confitures' => 'assets/css/sections/hero-confitures.css',
        'confitures' => 'assets/css/sections/confitures.css',
        'catalogue' => 'assets/css/components/catalogue.css',
        'section-motion' => 'assets/css/components/section-motion.css',
    );
    $dependencies = array('lgr-fonts', 'lgr-colors');
    foreach ($styles as $name => $path) {
        $handle = 'lgr-' . $name;
        wp_enqueue_style($handle, get_theme_file_uri($path), $dependencies, (string) filemtime(get_theme_file_path($path)));
        $dependencies = array($handle);
    }
    if (is_admin()) {
        $path = 'assets/css/editor.css';
        wp_enqueue_style('lgr-editor', get_theme_file_uri($path), $dependencies, (string) filemtime(get_theme_file_path($path)));
    }
});

add_action('init', function () {
    foreach (array('charcoal' => 'Remplissage — Charcoal', 'rose' => 'Remplissage — Rose', 'vert' => 'Remplissage — Vert', 'brun' => 'Remplissage — Brun') as $name => $label) {
        register_block_style('core/button', array('name' => 'ripple-' . $name, 'label' => $label));
    }
});

// Hide the admin toolbar on the public site; keep it in wp-admin.
add_action('wp_head', function () {
    echo '<noscript><style>.lgr-hero::before,.lgr-hero .hero-photo::before{content:none!important}</style></noscript>';
});
add_filter('show_admin_bar', '__return_false');
add_action('wp_enqueue_scripts', function () {
    $path = 'assets/js/navigation.js';
    wp_enqueue_script('lgr-navigation', get_theme_file_uri($path), array(), (string) filemtime(get_theme_file_path($path)), array('strategy' => 'defer', 'in_footer' => true));
    $path = 'assets/js/buttons.js';
    wp_enqueue_script('lgr-buttons', get_theme_file_uri($path), array(), (string) filemtime(get_theme_file_path($path)), array('strategy' => 'defer', 'in_footer' => true));
    $path = 'assets/js/section-motion.js';
    wp_enqueue_script('lgr-section-motion', get_theme_file_uri($path), array(), (string) filemtime(get_theme_file_path($path)), array('strategy' => 'defer', 'in_footer' => true));
    $path = 'assets/js/catalogue.js';
    wp_enqueue_script('lgr-catalogue', get_theme_file_uri($path), array(), (string) filemtime(get_theme_file_path($path)), array('strategy' => 'defer', 'in_footer' => true));
    $path = 'assets/js/hero.js';
    wp_enqueue_script('lgr-hero', get_theme_file_uri($path), array(), (string) filemtime(get_theme_file_path($path)), array('strategy' => 'defer', 'in_footer' => true));
});
