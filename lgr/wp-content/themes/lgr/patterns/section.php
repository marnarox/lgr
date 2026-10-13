<?php
/**
 * Title: Section LGR — fond pleine largeur, contenu centré
 * Slug: lgr/section
 * Categories: featured
 * Description: Section native Gutenberg avec contenu limité par les réglages globaux du thème.
 */
defined('ABSPATH') || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|section-block","bottom":"var:preset|spacing|section-block"}}},"layout":{"type":"default"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--section-block);padding-bottom:var(--wp--preset--spacing--section-block)">
<!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|section-gutter","left":"var:preset|spacing|section-gutter"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-right:var(--wp--preset--spacing--section-gutter);padding-left:var(--wp--preset--spacing--section-gutter)">
<!-- wp:heading -->
<h2 class="wp-block-heading">Titre de la section</h2>
<!-- /wp:heading -->
</div>
<!-- /wp:group -->
</section>
<!-- /wp:group -->
