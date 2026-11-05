<?php
/**
 * Site footer and the home page popup. Built from the static site by wordpress/build.py.
 */
?>
<footer class="site-footer">
  <div class="wrap">
    <div class="cols">
      <div>
        <img src="<?php echo esc_url( mm_mod( 'logo_footer' ) ); ?>" alt="<?php echo esc_attr( mm_setting( 'businessName' ) ); ?>" width="1000" height="315" loading="lazy">
        <p><?php mm_t( 'footer_blurb' ); ?></p>
      </div>
      <div>
        <h4>Pages</h4>
        <ul>
          <li><a href="<?php echo esc_url( mm_url( 'services' ) ); ?>">Services and Pricing</a></li>
          <li><a href="<?php echo esc_url( mm_url( 'bundles' ) ); ?>">Variety Pack and Bundle Building</a></li>
          <li><a href="<?php echo esc_url( mm_url( 'grocery' ) ); ?>">Grocery and CPG</a></li>
          <li><a href="<?php echo esc_url( mm_url( 'calculator' ) ); ?>">Cost Calculator</a></li>
          <li><a href="<?php echo esc_url( mm_url( 'quote' ) ); ?>">Get a Quote and Contact</a></li>
        </ul>
      </div>
      <div>
        <h4>Warehouse</h4>
        <ul>
          <li data-setting="address"><?php mm_s( 'address' ); ?></li>
          <li data-if-setting="phone"><a href="<?php echo esc_attr( mm_tel_href() ); ?>" data-setting-href="phone" data-setting="phone"><?php mm_s( 'phone' ); ?></a></li>
          <li><a href="<?php echo esc_attr( mm_mailto_href() ); ?>" data-setting-href="contactEmail" data-setting="contactEmail"><?php mm_s( 'contactEmail' ); ?></a></li>
          <li data-if-setting="hours" data-setting="hours"><?php mm_s( 'hours' ); ?></li>
        </ul>
        <p style="margin-top:20px"><a class="btn orange" href="<?php echo esc_url( mm_url( 'quote' ) ); ?>">Get a Quote</a></p>
      </div>
    </div>
    <div class="base">
      <span>&copy; <span data-year><?php echo esc_html( wp_date( 'Y' ) ); ?></span> <?php mm_s( 'businessName' ); ?></span>
      <span>Amazon FBA &middot; Walmart WFS &middot; FBM &middot; 2 step dropshipping</span>
      <span>Developed by <a href="https://cybersialabs.com" target="_blank" rel="noopener">Cybersialabs.com</a></span>
    </div>
  </div>
</footer>
<?php if ( is_front_page() && mm_mod( 'popup_on' ) ) : ?>
<div class="promo" id="promo" role="dialog" aria-modal="true" aria-labelledby="promo-title" hidden>
  <div class="promo-card">
    <button class="promo-x" type="button" data-promo-close aria-label="Close">&times;</button>
    <img class="promo-logo" src="<?php echo esc_url( mm_mod( 'logo_header' ) ); ?>" alt="<?php echo esc_attr( mm_setting( 'businessName' ) ); ?>" width="1000" height="315">
    <h2 id="promo-title" class="sr-only">Quick facts</h2>
    <ul class="promo-list">
      <li>
        <span class="ic"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></span>
        <span>Ships within <b>24 hours</b> of delivery to our dock</span>
      </li>
      <li>
        <span class="ic"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 8l-9-5-9 5v8l9 5 9-5z"/><path d="M3 8l9 5 9-5M12 13v8"/></svg></span>
        <span>First month of storage <b>free</b></span>
      </li>
      <li>
        <span class="ic"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
        <span>Bolingbrook, IL</span>
      </li>
    </ul>
    <div class="btn-row">
      <a class="btn orange" href="<?php echo esc_url( mm_url( 'quote' ) ); ?>">Get a Quote</a>
      <button class="btn ghost" type="button" data-promo-close>Close</button>
    </div>
  </div>
</div>
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
