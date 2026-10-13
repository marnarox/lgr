<?php
/**
 * Title: Bandeau des marques — défilement infini
 * Slug: lgr/brand-marquee
 * Categories: featured
 * Description: Bandeau de 60 px avec les trois marques et leurs pastilles.
 */
defined('ABSPATH') || exit;
?>
<!-- wp:html -->
<div class="lgr-brand-marquee" role="region" aria-label="Nos marques : Célinette - BIO, Les goûts retrouvés, Aux vraies saveurs.">
  <div class="brand-marquee-track" aria-hidden="true">
    <?php for ($group = 0; $group < 2; $group++) : ?>
    <div class="brand-marquee-group">
      <?php for ($repeat = 0; $repeat < 4; $repeat++) : ?>
      <span class="brand-marquee-item"><span class="brand-marquee-dot brand-marquee-dot--celinette"></span>Célinette - BIO</span>
      <span class="brand-marquee-item"><span class="brand-marquee-dot brand-marquee-dot--gout"></span>Les goûts retrouvés</span>
      <span class="brand-marquee-item"><span class="brand-marquee-dot brand-marquee-dot--saveurs"></span>Aux vraies saveurs</span>
      <?php endfor; ?>
    </div>
    <?php endfor; ?>
  </div>
</div>
<!-- /wp:html -->
