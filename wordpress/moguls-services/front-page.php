<?php
/**
 * Home page. Built from index.html by wordpress/build.py.
 */

mm_set_meta( 'Marketplace Moguls Services | 3PL Prep and Fulfillment in Bolingbrook, IL', 'Amazon FBA prep, Walmart WFS prep, FBM orders and 2 step dropshipping. Items ship within 24 hours of delivery and the first month of storage is free.' );
get_header();
?>
<main id="main">
<section class="hero">
  <div class="wrap">
    <div>
      <div class="tag"><?php mm_t( 'hero_tag' ); ?></div>
      <h1><?php mm_t( 'hero_title' ); ?> <em><?php mm_t( 'hero_highlight' ); ?></em></h1>
      <p class="lead"><?php mm_t( 'hero_lead' ); ?></p>
      <div class="btn-row">
        <a class="btn orange" href="<?php echo esc_url( mm_url( 'quote' ) ); ?>">Get a Quote</a>
        <a class="btn ghost" href="<?php echo esc_url( mm_url( 'services' ) ); ?>">See our prices</a>
      </div>
      <p class="hero-note">FNSKU labeling <span data-price="fnsku.perItem">$0.75</span> per item. Postage billed at cost.</p>
    </div>
    <div class="stage" data-scene="hero" aria-hidden="true">
      <div class="chip a"><b>24 hrs</b>dock to ship</div>
      <div class="chip b"><b>Month 1</b>storage is free</div>
      <div class="world"></div>
    </div>
  </div>
</section>

<section style="padding-top:8px">
  <div class="wrap">
    <div class="ticket tilt" data-tilt="3">
      <div>
        <div class="big">24<small>hours</small></div>
        <p>From the moment your items are delivered to our warehouse to the moment they ship out.</p>
      </div>
      <div>
        <div class="big">$0<small>month one</small></div>
        <p>Your first month of storage costs nothing. You pay for storage only on stock that stays past 30 days.</p>
      </div>
      <div>
        <div class="big">4<small>channels</small></div>
        <p>Amazon FBA, Walmart WFS, your own FBM orders and 2 step dropshipping, all from one building.</p>
      </div>
    </div>
  </div>
</section>

<!-- Animated warehouse line (SVG + CSS, no video file). -->
<section class="video-band" data-anim>
  <div class="wrap">
    <div class="video-frame">
      <svg class="wh-scene" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMid slice" role="img" aria-label="Animated small warehouse: a worker shelves stock with a hand truck while boxes slide along a packing table, get scanned and labeled, and go out the door.">
        <defs>
          <linearGradient id="wh-cone" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#d1a545" stop-opacity=".14"/><stop offset="1" stop-color="#d1a545" stop-opacity="0"/></linearGradient>
          <g id="wh-carton"><rect x="0" y="-46" width="62" height="46" fill="#c9a56a" stroke="#8a6a35" stroke-width="2"/><rect x="26" y="-46" width="10" height="46" fill="#dcc082"/></g>
          <g id="wh-stock"><rect x="0" y="-38" width="50" height="38" fill="#c9a56a" stroke="#8a6a35" stroke-width="2"/><rect x="20" y="-38" width="10" height="38" fill="#dcc082"/></g>
        </defs>
        <pattern id="wh-grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M40 0H0V40" fill="none" stroke="#d5cebf" stroke-width="2"/></pattern>
        <rect width="1600" height="900" fill="#fcf9ea"/>
        <rect width="1600" height="160" fill="#f2eedd"/>
        <path d="M0 160H1600" stroke="#d5ceb2" stroke-width="4"/>
        <rect y="640" width="1600" height="260" fill="#f2eedd"/>
        <rect y="640" width="1600" height="260" fill="url(#wh-grid)"/>
        <path d="M0 640H1600" stroke="#d5ceb2" stroke-width="4"/>
        <path d="M560 690H1240" stroke="#b8892d" stroke-width="14" stroke-dasharray="14 14" opacity=".85"/>
        <g class="wh-lamps">
          <polygon points="470,190 530,190 680,640 320,640" fill="url(#wh-cone)"/>
          <polygon points="870,190 930,190 1080,640 720,640" fill="url(#wh-cone)"/>
          <path d="M500 160V176M900 160V176" stroke="#0d1c42" stroke-width="4"/>
          <rect x="460" y="176" width="80" height="16" fill="#0d1c42"/><rect x="860" y="176" width="80" height="16" fill="#0d1c42"/>
        </g>

        <!-- step pills -->
        <g class="wh-pills" font-size="22">
          <g><rect class="wh-p wh-p1" x="300" y="58" width="210" height="44" rx="22"/><text x="405" y="87">1  Receive</text></g>
          <g><rect class="wh-p wh-p2" x="540" y="58" width="210" height="44" rx="22"/><text x="645" y="87">2  Shelve</text></g>
          <g><rect class="wh-p wh-p3" x="780" y="58" width="210" height="44" rx="22"/><text x="885" y="87">3  Label</text></g>
          <g><rect class="wh-p wh-p4" x="1020" y="58" width="210" height="44" rx="22"/><text x="1125" y="87">4  Ship</text></g>
        </g>

        <!-- two small shelving units -->
        <g class="wh-rack">
          <path d="M246 380H404M246 470H404M246 560H404M426 380H584M426 470H584M426 560H584" stroke="#b8892d" stroke-width="8"/>
          <use href="#wh-stock" x="256" y="376"/><use href="#wh-stock" x="318" y="376"/><use href="#wh-stock" x="436" y="376"/><use href="#wh-stock" x="500" y="376"/>
          <use href="#wh-stock" x="256" y="466"/><use href="#wh-stock" x="436" y="466"/><use href="#wh-stock" x="500" y="466"/>
          <use href="#wh-stock" x="436" y="556"/><use href="#wh-stock" x="500" y="556"/><use href="#wh-stock" x="340" y="636"/>
          <g class="wh-slot"><use href="#wh-stock" x="290" y="556"/></g>
          <path d="M248 360V640M402 360V640M428 360V640M582 360V640" stroke="#0d1c42" stroke-width="8"/>
        </g>

        <!-- worker with a hand truck -->
        <g class="wh-fork">
          <path d="M128 520L192 512" stroke="#e0ac82" stroke-width="12" stroke-linecap="round"/>
          <path d="M88 600L78 636M116 600L130 636" stroke="#0d1c42" stroke-width="16" stroke-linecap="round"/>
          <rect x="80" y="500" width="46" height="104" rx="12" fill="#0d1c42"/><rect x="90" y="502" width="26" height="100" rx="6" fill="#b8892d"/><rect x="90" y="556" width="26" height="5" fill="#fcf9ea"/>
          <rect x="97" y="482" width="12" height="20" fill="#e0ac82"/><circle cx="103" cy="466" r="20" fill="#e0ac82"/><path d="M83 463a20 20 0 0 1 40 0q-20-11-40 0z" fill="#2b1d14"/>
          <path d="M188 500L214 634H262" fill="none" stroke="#0d1c42" stroke-width="6" stroke-linecap="round"/>
          <use href="#wh-stock" x="212" y="630"/><g class="wh-carry"><use href="#wh-stock" x="212" y="592"/></g>
          <circle cx="214" cy="636" r="12" fill="#38476e" stroke="#0d1c42" stroke-width="4"/>
        </g>

        <!-- roll-up door -->
        <g class="wh-dock">
          <rect x="1250" y="330" width="190" height="310" fill="#1d2d57"/>
          <rect x="1250" y="330" width="190" height="90" fill="#e6debd"/><path d="M1250 350H1440M1250 372H1440M1250 394H1440" stroke="#c9bf98" stroke-width="3"/>
          <rect x="1236" y="322" width="14" height="318" fill="#0d1c42"/><rect x="1440" y="322" width="14" height="318" fill="#0d1c42"/><rect x="1236" y="316" width="218" height="12" fill="#b8892d"/>
          <text class="wh-sign" x="1345" y="306" font-size="22">OUTBOUND</text>
          <circle class="wh-led" cx="1345" cy="440" r="8"/>
        </g>

        <!-- packer standing behind the table -->
        <g class="wh-packer">
          <rect x="872" y="432" width="60" height="116" rx="14" fill="#0d1c42"/><rect x="886" y="434" width="32" height="112" rx="7" fill="#b8892d"/><rect x="886" y="490" width="32" height="5" fill="#fcf9ea"/>
          <rect x="895" y="412" width="14" height="22" fill="#8d5a3b"/><circle cx="902" cy="394" r="22" fill="#8d5a3b"/><path d="M880 391a22 22 0 0 1 44 0q-22-12-44 0z" fill="#111"/>
        </g>

        <!-- packing table with rollers -->
        <g class="wh-belt">
          <path d="M680 554V640M1150 554V640" stroke="#0d1c42" stroke-width="10"/>
          <rect x="640" y="540" width="560" height="16" fill="#182649" stroke="#0d1c42" stroke-width="3"/>
          <path class="wh-run" d="M650 548H1190" stroke="#38476e" stroke-width="6" stroke-dasharray="16 24"/>
        </g>

        <!-- boxes on the table; each gets its label when scanned -->
        <g class="wh-boxes">
          <g class="wh-box" style="animation-delay:0s"><use href="#wh-carton" x="650" y="540"/><g class="wh-lbl" style="animation-delay:0s"><rect x="656" y="518" width="20" height="14" fill="#fff"/><path d="M659 521v8M663 521v8M666 521v8M670 521v8M673 521v8" stroke="#0d1c42" stroke-width="1.5"/></g></g>
          <g class="wh-box" style="animation-delay:-3s"><use href="#wh-carton" x="650" y="540"/><g class="wh-lbl" style="animation-delay:-3s"><rect x="656" y="518" width="20" height="14" fill="#fff"/><path d="M659 521v8M663 521v8M666 521v8M670 521v8M673 521v8" stroke="#0d1c42" stroke-width="1.5"/></g></g>
          <g class="wh-box" style="animation-delay:-6s"><use href="#wh-carton" x="650" y="540"/><g class="wh-lbl" style="animation-delay:-6s"><rect x="656" y="518" width="20" height="14" fill="#fff"/><path d="M659 521v8M663 521v8M666 521v8M670 521v8M673 521v8" stroke="#0d1c42" stroke-width="1.5"/></g></g>
          <g class="wh-box" style="animation-delay:-9s"><use href="#wh-carton" x="650" y="540"/><g class="wh-lbl" style="animation-delay:-9s"><rect x="656" y="518" width="20" height="14" fill="#fff"/><path d="M659 521v8M663 521v8M666 521v8M670 521v8M673 521v8" stroke="#0d1c42" stroke-width="1.5"/></g></g>
        </g>

        <!-- packer's arm and handheld scanner -->
        <g class="wh-arch">
          <path d="M880 450L866 470" stroke="#8d5a3b" stroke-width="13" stroke-linecap="round"/>
          <path class="wh-beam" d="M870 474L870 492" stroke="#f3c45a" stroke-width="5"/>
          <rect x="856" y="460" width="28" height="14" rx="3" fill="#fcf9ea" stroke="#0d1c42" stroke-width="2"/>
        </g>
      </svg>
      <div class="video-caption">
        <div class="tag">Inside the warehouse</div>
        <h2>Racked, labeled and moving.</h2>
      </div>
      <button class="video-toggle" type="button">Pause</button>
    </div>
  </div>
</section>

<section style="padding-top:24px">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>One warehouse, four ways out</h2>
      <p class="muted">Tell us where the stock needs to go. We prep it to that marketplace's rules and get it moving.</p>
    </div>
    <div class="channels">
      <div class="channel reveal">
        <span class="code">AMAZON</span>
        <h3>FBA prep</h3>
        <p>FNSKU labels, two packs, bundles and cartons packed to Amazon's inbound rules, then sent to the fulfillment center.</p>
        <a href="<?php echo esc_url( mm_url( 'services' ) ); ?>#ffbbaa">FBA rates</a>
      </div>
      <div class="channel reveal">
        <span class="code">WALMART</span>
        <h3>WFS prep</h3>
        <p>Items labeled and packed for Walmart Fulfillment Services and sent to the Walmart warehouse on your shipment plan.</p>
        <a href="<?php echo esc_url( mm_url( 'services' ) ); ?>#wfs">WFS rates</a>
      </div>
      <div class="channel reveal">
        <span class="code">MERCHANT</span>
        <h3>FBM orders</h3>
        <p>We pick, pack and ship your Amazon, Walmart and web store orders straight to the buyer, with tracking uploaded.</p>
        <a href="<?php echo esc_url( mm_url( 'services' ) ); ?>#fbm">FBM rates</a>
      </div>
      <div class="channel reveal">
        <span class="code">DROPSHIP</span>
        <h3>2 step dropshipping</h3>
        <p>Your supplier ships to us. We check the goods, repack them and send each order on to your customer.</p>
        <a href="<?php echo esc_url( mm_url( 'services' ) ); ?>#two-step">2 step rates</a>
      </div>
    </div>
  </div>
</section>

<div class="cta-band">
  <div class="wrap">
    <div>
      <h2>Send us your SKU list and monthly volume.</h2>
      <p>We reply with a written quote built on the prices on this site.</p>
    </div>
    <a class="btn" href="<?php echo esc_url( mm_url( 'quote' ) ); ?>">Get a Quote</a>
  </div>
</div>

<section class="on-dark">
  <div class="wrap">
    <div class="section-head">
      <div>
        <div class="tag">Services</div>
        <h2>What we handle on the floor</h2>
      </div>
      <p class="muted">Seven services, one team. Pick the ones you need and skip the rest.</p>
    </div>
    <div class="aisles">
      <a class="aisle" href="<?php echo esc_url( mm_url( 'services' ) ); ?>#ffbbaa"><span class="num">01</span><div><h3>FBA prep</h3><p>FNSKU labeling at <span data-price="fnsku.perItem">$0.75</span> per item, plus two packs and carton prep for Amazon.</p></div></a>
      <a class="aisle" href="<?php echo esc_url( mm_url( 'services' ) ); ?>#wfs"><span class="num">02</span><div><h3>WFS prep</h3><p>Labeling and packing to Walmart's inbound requirements.</p></div></a>
      <a class="aisle" href="<?php echo esc_url( mm_url( 'services' ) ); ?>#storage"><span class="num">03</span><div><h3>Pallet storage</h3><p>Racked pallet storage with your first month free.</p></div></a>
      <a class="aisle" href="<?php echo esc_url( mm_url( 'services' ) ); ?>#fbm"><span class="num">04</span><div><h3>FBM orders</h3><p>Pick, pack and ship for your own orders. Handling <span data-price="d.fbmFrom">$2.75</span> per order, with lower rates at higher volume.</p></div></a>
      <a class="aisle" href="<?php echo esc_url( mm_url( 'services' ) ); ?>#two-step"><span class="num">05</span><div><h3>2 step dropshipping</h3><p>We receive from your supplier, inspect, repack and ship to the end customer.</p></div></a>
      <a class="aisle" href="<?php echo esc_url( mm_url( 'bundles' ) ); ?>"><span class="num">06</span><div><h3>Variety packs and bundles</h3><p>Single items turned into ready to sell packs from <span data-bundle-from>$2.50 + $0.90</span> per pack.</p></div></a>
      <a class="aisle" href="<?php echo esc_url( mm_url( 'services' ) ); ?>#courier"><span class="num">07</span><div><h3>Courier drop off</h3><p>We drop off to OnTrac and every other courier you use.</p></div></a>
    </div>
  </div>
</section>

<section>
  <div class="wrap">
    <div class="section-head reveal">
      <h2>How your inventory moves</h2>
      <p class="muted">No waiting in a receiving queue for a week. This is the normal path for every shipment.</p>
    </div>
    <ol class="timeline reveal">
      <li><span class="when">Day 0</span><h4>Delivered</h4><p>Your freight or parcels arrive at our Bolingbrook dock.</p></li>
      <li><span class="when">Day 0</span><h4>Checked in</h4><p>We count cartons, note any damage and send you photos.</p></li>
      <li><span class="when">Within 24 hours</span><h4>Prepped</h4><p>Labels, two packs and bundles done to the destination's rules.</p></li>
      <li><span class="when">Within 24 hours</span><h4>Shipped</h4><p>Out to Amazon, Walmart or your customer, with tracking sent to you.</p></li>
    </ol>
  </div>
</section>

<section style="padding-top:0">
  <div class="wrap">
    <div class="section-head reveal">
      <div>
        <div class="tag">Courier drop off</div>
        <h2>We hand your parcels to the couriers you already use</h2>
      </div>
      <p class="muted">We drop off to OnTrac, UPS, FedEx, USPS, DHL and other couriers, so your parcels get moving without waiting on a pickup.</p>
    </div>
<ul class="carriers" aria-label="Couriers we drop off to">
  <li><img src="<?php echo esc_url( mm_asset( 'assets/img/couriers/ontrac.svg' ) ); ?>" alt="OnTrac" width="110" height="42" loading="lazy"></li>
  <li><img src="<?php echo esc_url( mm_asset( 'assets/img/couriers/ups.svg' ) ); ?>" alt="UPS" width="110" height="42" loading="lazy"></li>
  <li><img src="<?php echo esc_url( mm_asset( 'assets/img/couriers/fedex.svg' ) ); ?>" alt="FedEx" width="110" height="42" loading="lazy"></li>
  <li><img src="<?php echo esc_url( mm_asset( 'assets/img/couriers/usps.svg' ) ); ?>" alt="USPS" width="110" height="42" loading="lazy"></li>
  <li><img src="<?php echo esc_url( mm_asset( 'assets/img/couriers/dhl.svg' ) ); ?>" alt="DHL" width="110" height="42" loading="lazy"></li>
  <li class="more">and other regional couriers</li>
</ul>
  </div>
</section>

<section class="band-paper2">
  <div class="wrap">
    <div class="section-head reveal">
      <h2>Prices you can check before you call</h2>
      <p class="muted">Every rate is listed. Shipping postage is passed through at cost.</p>
    </div>
    <div class="snap tilt" data-tilt="3">
      <div>
        <div class="from">FNSKU labeling</div>
        <div class="amt" data-price="fnsku.perItem">$0.75</div>
        <div class="unit">per item. Two pack <span data-price="d.twoPack">$1.15</span></div>
      </div>
      <div>
        <div class="from">FBM handling</div>
        <div class="amt" data-price="d.fbmFrom">$2.75</div>
        <div class="unit">per order, first item</div>
      </div>
      <div>
        <div class="from">Variety packs from</div>
        <div class="amt" data-bundle-from>$2.50 + $0.90</div>
        <div class="unit">per pack: base plus building fee</div>
      </div>
    </div>
    <div class="btn-row" style="margin-top:32px">
      <a class="btn" href="<?php echo esc_url( mm_url( 'services' ) ); ?>">Full price list</a>
      <a class="btn ghost" href="<?php echo esc_url( mm_url( 'calculator' ) ); ?>">Estimate your cost</a>
    </div>
  </div>
</section>

<section class="on-dark leaders" id="leadership">
  <div class="wrap">
    <div class="leaders-head reveal">
      <div class="tag">Leadership</div>
      <h2><?php mm_t( 'lead_heading' ); ?></h2>
    </div>
    <div class="leader-grid">
<?php foreach ( array( 1, 2 ) as $mm_i ) : ?>
      <figure class="leader reveal">
        <img src="<?php echo esc_url( mm_mod( 'leader' . $mm_i . '_photo' ) ); ?>" alt="<?php echo esc_attr( mm_mod( 'leader' . $mm_i . '_name' ) . ', ' . mm_mod( 'leader' . $mm_i . '_title' ) ); ?>" width="600" height="750" loading="lazy">
        <figcaption><b><?php mm_t( 'leader' . $mm_i . '_name' ); ?></b><span><?php mm_t( 'leader' . $mm_i . '_title' ); ?></span></figcaption>
      </figure>
<?php endforeach; ?>
    </div>
    <div class="ceo-quote reveal">
      <div class="tag"><?php mm_t( 'msg_tag' ); ?></div>
      <h3><?php mm_t( 'msg_heading' ); ?></h3>
      <blockquote>
<?php mm_paragraphs( mm_mod( 'msg_body' ) ); ?>
      </blockquote>
      <div class="sign"><?php mm_t( 'msg_sign' ); ?></div>
    </div>
  </div>
</section>

<section>
  <div class="wrap split">
    <div class="reveal">
      <div class="tag">Next step</div>
      <h2>Ready when your stock is.</h2>
      <p class="muted" style="font-size:19px">Tell us what you sell, where it goes and how much moves each month. We will send back a quote you can hold us to.</p>
    </div>
    <div class="btn-row reveal">
      <a class="btn orange" href="<?php echo esc_url( mm_url( 'quote' ) ); ?>">Get a Quote</a>
      <a class="btn ghost" href="<?php echo esc_attr( mm_tel_href() ); ?>" data-setting-href="phone">Call <span data-setting="phone"><?php mm_s( 'phone' ); ?></span></a>
    </div>
  </div>
</section>
</main>
<?php
get_footer();
