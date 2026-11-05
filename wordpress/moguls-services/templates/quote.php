<?php
/**
 * Template Name: Get a Quote
 *
 * Built from quote.html by wordpress/build.py.
 */

mm_set_meta( 'Get a Quote | Marketplace Moguls Services', 'Request a 3PL quote for FBA prep, WFS prep, storage, FBM orders, bundles and 2 step dropshipping.' );
get_header();
?>
<main id="main">
<section class="page-hero">
  <div class="wrap" style="grid-template-columns:1fr">
    <div>
      <div class="tag">Get a quote and contact</div>
      <h1>Tell us what you sell.</h1>
      <p class="lead">Fill in what you know and leave the rest blank. Every request comes straight to our inbox and we reply with real numbers.</p>
    </div>
  </div>
</section>

<section style="padding-top:48px">
  <div class="wrap contact-grid">
    <form class="form" data-form>
      <input type="hidden" name="form_type" value="quote">
      <div class="hp" aria-hidden="true"><label>Website <input name="website" tabindex="-1" autocomplete="off"></label></div>
      <div class="grid2">
        <div class="field"><label for="f-name">Name <span class="req">*</span></label><input id="f-name" name="name" required autocomplete="name"></div>
        <div class="field"><label for="f-email">Email <span class="req">*</span></label><input id="f-email" name="email" type="email" required autocomplete="email"></div>
        <div class="field"><label for="f-phone">Phone</label><input id="f-phone" name="phone" type="tel" autocomplete="tel"></div>
        <div class="field"><label for="f-company">Company</label><input id="f-company" name="company" autocomplete="organization"></div>
      </div>
      <div class="field">
        <span class="label">Marketplaces you sell on</span>
        <div class="opts">
          <label><input type="checkbox" name="marketplaces[]" value="Amazon"> Amazon</label>
          <label><input type="checkbox" name="marketplaces[]" value="Walmart"> Walmart</label>
          <label><input type="checkbox" name="marketplaces[]" value="Shopify"> Shopify</label>
          <label><input type="checkbox" name="marketplaces[]" value="eBay"> eBay</label>
          <label><input type="checkbox" name="marketplaces[]" value="TikTok Shop"> TikTok Shop</label>
          <label><input type="checkbox" name="marketplaces[]" value="Other"> Other</label>
        </div>
      </div>
      <div class="grid2">
        <div class="field"><label for="f-units">Monthly units</label><input id="f-units" name="monthly_units" type="number" min="0" placeholder="2000"></div>
        <div class="field"><label for="f-orders">Or daily orders</label><input id="f-orders" name="daily_orders" type="number" min="0" placeholder="60"></div>
      </div>
      <div class="field">
        <span class="label">Services needed</span>
        <div class="opts">
          <label><input type="checkbox" name="services[]" value="FBA prep"> FBA prep</label>
          <label><input type="checkbox" name="services[]" value="WFS prep"> WFS prep</label>
          <label><input type="checkbox" name="services[]" value="Pallet storage"> Pallet storage</label>
          <label><input type="checkbox" name="services[]" value="FBM orders"> FBM orders</label>
          <label><input type="checkbox" name="services[]" value="2 step dropshipping"> 2 step dropshipping</label>
          <label><input type="checkbox" name="services[]" value="Variety packs and bundles"> Variety packs and bundles</label>
          <label><input type="checkbox" name="services[]" value="Courier drop off"> Courier drop off</label>
        </div>
      </div>
      <div class="field"><label for="f-msg">Message</label><textarea id="f-msg" name="message" placeholder="What you sell, how it arrives (parcels or pallets), anything special about it."></textarea></div>
      <button class="btn orange" type="submit">Send my request</button>
      <div class="form-msg" role="status"></div>
    </form>

    <aside class="contact-card">
      <h3>Warehouse</h3>
      <dl>
        <dt>Address</dt>
        <dd data-setting="address"><?php mm_s( 'address' ); ?></dd>
        <dt data-if-setting="phone">Phone</dt>
        <dd data-if-setting="phone"><a href="<?php echo esc_attr( mm_tel_href() ); ?>" data-setting-href="phone" data-setting="phone"><?php mm_s( 'phone' ); ?></a></dd>
        <dt>Email</dt>
        <dd><a href="<?php echo esc_attr( mm_mailto_href() ); ?>" data-setting-href="contactEmail" data-setting="contactEmail"><?php mm_s( 'contactEmail' ); ?></a></dd>
        <dt data-if-setting="hours">Hours</dt>
        <dd data-if-setting="hours" data-setting="hours"><?php mm_s( 'hours' ); ?></dd>
      </dl>
      <h4 style="margin-top:36px">What happens next</h4>
      <ol class="muted" style="padding-left:20px">
        <li>We read your request and check your products.</li>
        <li>You get a written quote by email.</li>
        <li>Send your first shipment. It ships within 24 hours of arrival.</li>
      </ol>
    </aside>
  </div>
</section>
</main>
<?php
get_footer();
