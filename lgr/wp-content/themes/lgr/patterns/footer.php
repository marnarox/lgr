<?php
/**
 * Title: Footer LGR
 * Slug: lgr/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Inserter: no
 */
defined('ABSPATH') || exit;
?>
<!-- wp:group {"className":"lgr-footer","layout":{"type":"default"}} -->
<div class="wp-block-group lgr-footer">
<!-- wp:group {"className":"footer-inner","layout":{"type":"default"}} -->
<div class="wp-block-group footer-inner">
<!-- wp:group {"className":"footer-top","layout":{"type":"default"}} -->
<div class="wp-block-group footer-top">
<!-- wp:group {"className":"footer-brand","layout":{"type":"default"}} -->
<div class="wp-block-group footer-brand">
<!-- wp:paragraph {"className":"footer-brand-name"} -->
<p class="footer-brand-name">Les goûts retrouvés</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"footer-tagline"} -->
<p class="footer-tagline">À tartiner, napper ou partager</p>
<!-- /wp:paragraph -->
</div><!-- /wp:group -->
<!-- wp:group {"className":"footer-column","layout":{"type":"default"}} -->
<div class="wp-block-group footer-column">
<!-- wp:paragraph {"className":"footer-label"} -->
<p class="footer-label">COORDONNÉES</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"footer-contact","layout":{"type":"default"}} -->
<div class="wp-block-group footer-contact">
<!-- wp:paragraph -->
<p>Rue de la Brasserie 8/14</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p>4000 Liège</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><a href="tel:+32473830349">+32 473 83 03 49</a></p>
<!-- /wp:paragraph -->
<!-- wp:paragraph -->
<p><a href="mailto:info@lesgoutsretrouves.be">info@lesgoutsretrouves.be</a></p>
<!-- /wp:paragraph -->
</div><!-- /wp:group -->
</div><!-- /wp:group -->
<!-- wp:group {"className":"footer-column","layout":{"type":"default"}} -->
<div class="wp-block-group footer-column">
<!-- wp:paragraph {"className":"footer-label"} -->
<p class="footer-label">SUIVRE</p>
<!-- /wp:paragraph -->
<!-- wp:group {"className":"footer-social","layout":{"type":"default"}} -->
<div class="wp-block-group footer-social">
<?php
$networks = array(
    'Facebook' => array(
        'icon' => 'logo-facebook.svg',
        'links' => array(
            'Les goûts retrouvés' => 'https://www.facebook.com/legoutretrouve/',
            'Aux vraies saveurs' => 'https://www.facebook.com/auxvraiessaveursartisan',
            'Célinette' => 'https://www.facebook.com/confiturescelinette/',
        ),
    ),
    'Instagram' => array(
        'icon' => 'logo-instagram.svg',
        'links' => array(
            'Les goûts retrouvés' => 'https://www.instagram.com/le.gout.retrouve/',
            'Aux vraies saveurs' => 'https://www.instagram.com/auxvraiessaveurs/',
            'Célinette' => 'https://www.instagram.com/confitures_celinette_/',
        ),
    ),
);
foreach ($networks as $network => $data) :
?>
<!-- wp:group {"className":"footer-network","layout":{"type":"default"}} -->
<div class="wp-block-group footer-network">
<?php foreach ($data['links'] as $brand => $url) : ?>
<!-- wp:paragraph -->
<p><a class="footer-social-link" href="<?php echo esc_url($url); ?>" aria-label="<?php echo esc_attr($brand . ' sur ' . $network); ?>"><?php echo esc_html($brand); ?><img src="<?php echo esc_url(get_theme_file_uri('/assets/logo/' . $data['icon'])); ?>" alt="<?php echo esc_attr($network); ?>" width="20" height="20"/></a></p>
<!-- /wp:paragraph -->
<?php endforeach; ?>
</div><!-- /wp:group -->
<?php endforeach; ?>
</div><!-- /wp:group -->
</div><!-- /wp:group -->
</div><!-- /wp:group -->
<!-- wp:separator {"className":"footer-divider"} -->
<hr class="wp-block-separator has-alpha-channel-opacity footer-divider"/>
<!-- /wp:separator -->
<!-- wp:group {"className":"footer-bottom","layout":{"type":"default"}} -->
<div class="wp-block-group footer-bottom">
<!-- wp:paragraph -->
<p>© <?php echo esc_html(wp_date('Y')); ?> Les goûts retrouvés</p>
<!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"footer-legal"} -->
<p class="footer-legal"><a href="<?php echo esc_url(home_url('/mentions-legales/')); ?>">Mentions légales</a> · <a href="<?php echo esc_url(home_url('/politique-de-confidentialite/')); ?>">Politique de confidentialité</a> · <a href="<?php echo esc_url(home_url('/cookies/')); ?>">Cookies</a></p>
<!-- /wp:paragraph -->
</div><!-- /wp:group -->
</div><!-- /wp:group -->
</div><!-- /wp:group -->
