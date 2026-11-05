<?php
/**
 * Template Name: Cost Calculator
 *
 * Built from calculator.html by wordpress/build.py.
 */

mm_set_meta( 'Cost Calculator | Marketplace Moguls Services', 'Compare prep and fulfillment cost per unit for Amazon FBA, Walmart WFS, FBM and 2 step dropshipping.' );
get_header();
?>
<main id="main">
<section class="page-hero" style="padding-bottom:40px">
  <div class="wrap" style="grid-template-columns:1fr">
    <div>
      <div class="tag">Cost calculator</div>
      <h1>Cost per unit, side by side.</h1>
      <p class="lead">Enter your product details and see what prep and fulfillment would cost for FBA, WFS, FBM and 2 step, using our current prices.</p>
    </div>
  </div>
</section>

<section style="padding-top:48px">
  <div class="wrap calc">
    <form id="calc-form" class="form" onsubmit="return false">
      <div class="box-preview" aria-hidden="true">
        <div class="world"></div>
        <div class="readout"></div>
      </div>
      <div class="field"><label for="c-weight">Weight per unit (lb)</label><input id="c-weight" name="weight" type="number" min="0" step="0.1" value="1.5"></div>
      <div class="field">
        <span class="label">Size per unit (inches, L x W x H)</span>
        <div class="dims">
          <input aria-label="Length in inches" name="length" type="number" min="0" step="0.1" value="10">
          <input aria-label="Width in inches" name="width" type="number" min="0" step="0.1" value="8">
          <input aria-label="Height in inches" name="height" type="number" min="0" step="0.1" value="4">
        </div>
      </div>
      <div class="field"><label for="c-pack">Items per pack</label><input id="c-pack" name="perPack" type="number" min="1" step="1" value="1"></div>
      <div class="grid2">
        <div class="field"><label for="c-daily">Daily orders</label><input id="c-daily" name="daily" type="number" min="0" step="1" value="40"></div>
        <div class="field"><label for="c-monthly">Monthly units</label><input id="c-monthly" name="monthly" type="number" min="0" step="1" value="1200"></div>
      </div>
    </form>

    <div>
      <div class="results" id="calc-results" aria-live="polite"></div>
      <p class="estimate-note">These are estimates and marketplace fees can change. Shipping postage for FBM and 2 step is billed at cost and is not included above.</p>
      <div class="calc-extra" id="calc-extra"></div>
      <p class="fine">How it works: FBA and WFS show prep per finished unit. A pack of 2 adds the two pack fee and packs of 3 or more add the bundle building fee. FBM and 2 step show the handling fee per order for the daily volume you entered, with one pack per order.</p>

      <form id="exact-quote" class="form" style="margin-top:32px">
        <h3>Want an exact number?</h3>
        <p class="muted">We will check your product and reply with a firm quote. Your inputs above are sent with your email.</p>
        <input type="hidden" name="form_type" value="calculator">
        <div class="hp" aria-hidden="true"><label>Website <input name="website" tabindex="-1" autocomplete="off"></label></div>
        <div class="grid2">
          <div class="field"><label for="q-name">Your name</label><input id="q-name" name="name" autocomplete="name"></div>
          <div class="field"><label for="q-email">Email <span class="req">*</span></label><input id="q-email" name="email" type="email" required autocomplete="email"></div>
        </div>
        <button class="btn orange" type="submit">Request Exact Quote</button>
        <div class="form-msg" role="status"></div>
      </form>
    </div>
  </div>
</section>
</main>
<?php
get_footer();
