<?php
defined('ABSPATH') || exit;

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('html5', array('search-form', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('responsive-embeds');
});

add_action('enqueue_block_assets', function () {
    wp_enqueue_style('lgr-fonts', content_url('/fonts/fonts.css'), array(), '1.0');
    wp_enqueue_style('lgr-colors', content_url('/design-tokens/colors.css'), array(), (string) filemtime(WP_CONTENT_DIR . '/design-tokens/colors.css'));
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
        'hero-pro' => 'assets/css/sections/hero-pro.css',
        'nos-atouts' => 'assets/css/sections/nos-atouts.css',
        'contact-pro' => 'assets/css/sections/contact-pro.css',
        'confitures' => 'assets/css/sections/confitures.css',
        'catalogue' => 'assets/css/components/catalogue.css',
        'section-dots' => 'assets/css/components/section-dots.css',
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

// Catalogue: landscape sources fill portrait cards with object-fit: cover.
// Browser sizes="auto" only measures the element width, so its chosen thumbnail
// can be too small after cropping, particularly on high-density displays.
// Keep the image selected in Gutenberg; use its src without responsive downsizing.
add_filter('render_block_core/image', function ($content, $block) {
    $classes = preg_split('/\s+/', $block['attrs']['className'] ?? '');
    if (!in_array('lgr-catalogue-photo', $classes, true)) {
        return $content;
    }
    $html = new WP_HTML_Tag_Processor($content);
    while ($html->next_tag('IMG')) {
        $html->set_attribute('data-lgr-catalogue-source', 'original');
        $html->remove_attribute('srcset');
        $html->remove_attribute('sizes');
    }
    return $html->get_updated_html();
}, 20, 2);

// the_content adds srcset again after blocks render; limit this correction to
// images marked by the catalogue block above. Stored block markup is unchanged.
add_filter('wp_content_img_tag', function ($image) {
    $html = new WP_HTML_Tag_Processor($image);
    if ($html->next_tag('IMG') && $html->get_attribute('data-lgr-catalogue-source') === 'original') {
        $html->remove_attribute('srcset');
        $html->remove_attribute('sizes');
    }
    return $html->get_updated_html();
}, 20);

add_action('wp_enqueue_scripts', function () {
    $path = 'assets/js/navigation.js';
    wp_enqueue_script('lgr-navigation', get_theme_file_uri($path), array(), (string) filemtime(get_theme_file_path($path)), array('strategy' => 'defer', 'in_footer' => true));
    $path = 'assets/js/buttons.js';
    wp_enqueue_script('lgr-buttons', get_theme_file_uri($path), array(), (string) filemtime(get_theme_file_path($path)), array('strategy' => 'defer', 'in_footer' => true));
    $path = 'assets/js/section-motion.js';
    wp_enqueue_script('lgr-section-motion', get_theme_file_uri($path), array(), (string) filemtime(get_theme_file_path($path)), array('strategy' => 'defer', 'in_footer' => true));
    $path = 'assets/js/catalogue.js';
    wp_enqueue_script('lgr-catalogue', get_theme_file_uri($path), array(), (string) filemtime(get_theme_file_path($path)), array('strategy' => 'defer', 'in_footer' => true));
    $path = 'assets/js/section-dots.js';
    wp_enqueue_script('lgr-section-dots', get_theme_file_uri($path), array(), (string) filemtime(get_theme_file_path($path)), array('strategy' => 'defer', 'in_footer' => true));
    $path = 'assets/js/brand-backgrounds.js';
    wp_enqueue_script('lgr-brand-backgrounds', get_theme_file_uri($path), array(), (string) filemtime(get_theme_file_path($path)), array('strategy' => 'defer', 'in_footer' => true));
    $path = 'assets/js/brand-marquee.js';
    wp_enqueue_script('lgr-brand-marquee', get_theme_file_uri($path), array(), (string) filemtime(get_theme_file_path($path)), array('strategy' => 'defer', 'in_footer' => true));
    $path = 'assets/js/hero.js';
    wp_enqueue_script('lgr-hero', get_theme_file_uri($path), array(), (string) filemtime(get_theme_file_path($path)), array('strategy' => 'defer', 'in_footer' => true));
});
