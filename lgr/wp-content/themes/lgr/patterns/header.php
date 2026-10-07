<?php
/**
 * Title: Header LGR
 * Slug: lgr/header
 * Categories: header
 * Block Types: core/template-part/header
 * Inserter: no
 */
defined('ABSPATH') || exit;
?>
<!-- wp:group {"className":"header-inner","backgroundColor":"cream","style":{"spacing":{"blockGap":"40px","padding":{"top":"8px","bottom":"8px","left":"40px","right":"40px"}}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
<div class="wp-block-group header-inner has-cream-background-color has-background" style="padding-top:8px;padding-right:40px;padding-bottom:8px;padding-left:40px">
<!-- wp:image {"width":"100px","sizeSlug":"full","linkDestination":"custom","className":"brand"} -->
<figure class="wp-block-image size-full is-resized brand"><a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url(get_theme_file_uri('/assets/Logo_GoutRetrouve.svg')); ?>" alt="Le goût retrouvé, artisan confiturier" style="width:100px"/></a></figure>
<!-- /wp:image -->
<!-- wp:navigation {"overlayMenu":"mobile","overlayBackgroundColor":"cream","overlayTextColor":"charcoal","className":"primary-nav","layout":{"type":"flex","justifyContent":"right"},"style":{"spacing":{"blockGap":"40px"}}} -->
<!-- wp:navigation-link <?php echo wp_json_encode(array('label'=>'Les marques','url'=>home_url('/#nos-marques'),'kind'=>'custom')); ?> /-->
<!-- wp:navigation-link <?php echo wp_json_encode(array('label'=>'Nos produits','url'=>home_url('/#nos-produits'),'kind'=>'custom')); ?> /-->
<!-- wp:navigation-link <?php echo wp_json_encode(array('label'=>'Points de vente','url'=>home_url('/#points-de-vente'),'kind'=>'custom')); ?> /-->
<!-- wp:navigation-link <?php echo wp_json_encode(array('label'=>'Professionnels','url'=>home_url('/espace-pro/'),'kind'=>'custom')); ?> /-->
<!-- /wp:navigation -->
</div>
<!-- /wp:group -->
