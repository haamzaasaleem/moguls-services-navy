<?php
/**
 * Template Name: Grocery and CPG
 *
 * Built from grocery.html by wordpress/build.py.
 */

mm_set_meta( 'Grocery and CPG Fulfillment | Marketplace Moguls Services', 'Expiry date checks at receiving, lot tracking, oldest stock ships first and expiry alerts at 90, 60 and 30 days.' );
get_header();
?>
<main id="main">
<section class="page-hero">
  <div class="wrap">
    <div>
      <div class="tag">Grocery and CPG</div>
      <h1>Built for food and consumables.</h1>
      <p class="lead">We track expiration dates and lot numbers and ship the oldest stock first.</p>
      <div class="btn-row"><a class="btn orange" href="<?php echo esc_url( mm_url( 'quote' ) ); ?>">Get a Quote</a></div>
    </div>
    <div class="tilt" data-tilt="5">
      <div class="tag">One SKU, one lane, oldest at the front</div>
      <div class="fifo" aria-label="Cartons sorted by expiration date, earliest first">
        <div>EXP<br>MAR 27<br>Ships first</div>
        <div>EXP<br>MAY 27</div>
        <div>EXP<br>AUG 27</div>
        <div>EXP<br>NOV 27</div>
      </div>
      <p class="fine">Every pick pulls the carton with the closest date, so nothing ages out on the shelf.</p>
    </div>
  </div>
</section>

<section>
  <div class="wrap split" style="align-items:start">
    <div>
      <h2 class="reveal">How we handle consumables</h2>
      <p class="muted reveal" style="font-size:19px">Amazon and Walmart both reject food that arrives too close to its date. These are the checks that keep yours moving.</p>
    </div>
    <ul class="checks reveal">
      <li><b>Expiry date check at receiving</b><span>Dates are read and recorded on every carton the day it arrives.</span></li>
      <li><b>Lot tracking</b><span>Each lot number is logged, so a recall or a buyer question can be traced to the exact units.</span></li>
      <li><b>Oldest stock ships first</b><span>Picks always pull the earliest date on hand.</span></li>
      <li><b>Variety pack building</b><span>Snack boxes, sampler packs and multipacks built from your single items. <a href="<?php echo esc_url( mm_url( 'bundles' ) ); ?>">See bundle pricing</a></span></li>
      <li><b>Expiry alerts by message</b><span>We message you at 90, 60 and 30 days before stock expires.</span></li>
      <li><b>Photos of received cartons</b><span>You see what arrived, and what condition it arrived in, before anything ships.</span></li>
    </ul>
  </div>
</section>

<section class="band-paper2">
  <div class="wrap split">
    <div class="reveal">
      <div class="tag">Expiry alerts</div>
      <h2>Three heads up messages, not one surprise.</h2>
      <p class="muted">Time to run a promotion, move units to another channel or plan a removal while the stock still has value.</p>
    </div>
    <div class="expiry reveal">
      <div><div class="d">90</div><small>days out</small><p>First notice with units and lot numbers.</p></div>
      <div><div class="d">60</div><small>days out</small><p>Second notice with what is left.</p></div>
      <div><div class="d">30</div><small>days out</small><p>Final notice. Time to act.</p></div>
    </div>
  </div>
</section>

<div class="cta-band">
  <div class="wrap">
    <div>
      <h2>Selling food, snacks or supplements?</h2>
      <p>Tell us your SKU count and how fast it sells.</p>
    </div>
    <a class="btn" href="<?php echo esc_url( mm_url( 'quote' ) ); ?>">Get a Quote</a>
  </div>
</div>
</main>
<?php
get_footer();
