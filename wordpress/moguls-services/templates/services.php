<?php
/**
 * Template Name: Services and Pricing
 *
 * Built from services.html by wordpress/build.py.
 */

mm_set_meta( 'Services and Pricing | Marketplace Moguls Services', 'FNSKU labeling, FBM handling tiers, variety pack building, pallet storage and courier drop off. Every rate listed.' );
get_header();
?>
<main id="main">
<section class="page-hero">
  <div class="wrap">
    <div>
      <div class="tag">Services and pricing</div>
      <h1>Plain prices. Per item, per order, per pack.</h1>
      <p class="lead">Every rate we charge is on this page. Shipping postage is billed separately at our cost.</p>
      <div class="btn-row"><a class="btn orange" href="<?php echo esc_url( mm_url( 'quote' ) ); ?>">Get a Quote</a></div>
    </div>
    <table class="rate">
      <thead><tr><th>Jump to</th><th>Starts at</th></tr></thead>
      <tbody>
        <tr><td><a href="#ffbbaa">FBA prep</a></td><td class="p" data-price="fnsku.perItem">$0.75</td></tr>
        <tr><td><a href="#wfs">WFS prep</a></td><td class="p" data-price="wfsPrep.perItem" data-pending="Coming soon">$0.75</td></tr>
        <tr><td><a href="#storage">Pallet storage</a></td><td class="p">Month 1 free</td></tr>
        <tr><td><a href="#fbm">FBM orders</a></td><td class="p" data-price="d.fbmFrom">$2.75</td></tr>
        <tr><td><a href="#two-step">2 step dropshipping</a></td><td class="p" data-price="d.fbmFrom">$2.75</td></tr>
        <tr><td><a href="#bundles">Variety packs and bundles</a></td><td class="p" data-bundle-from>$2.50 + $0.90</td></tr>
        <tr><td><a href="#courier">Courier drop off</a></td><td class="p">Ask us</td></tr>
      </tbody>
    </table>
  </div>
</section>

<section>
  <div class="wrap">

    <div class="price-block" id="fba">
      <div class="side">
        <div class="tag">01 Amazon</div>
        <h2>FBA prep</h2>
        <p>We put your FNSKU label on every item, make up two packs, and pack cartons to Amazon's inbound rules before they ship to the fulfillment center.</p>
      </div>
      <div>
        <table class="rate">
          <thead><tr><th>Service</th><th>Price</th></tr></thead>
          <tbody>
            <tr><td>FNSKU labeling, single item</td><td class="p"><span data-price="fnsku.perItem">$0.75</span> per item</td></tr>
            <tr><td>Two pack (two units sold as one)</td><td class="p"><span data-price="d.twoPack">$1.15</span> per pack</td></tr>
          </tbody>
        </table>
        <p class="fine">A two pack is <span data-price="fnsku.twoPackAdd">$0.40</span> more than a single item label.</p>
      </div>
    </div>

    <div class="price-block" id="wfs">
      <div class="side">
        <div class="tag">02 Walmart</div>
        <h2>WFS prep</h2>
        <p>Labeling and packing for Walmart Fulfillment Services, shipped to the Walmart warehouse on your inbound plan.</p>
      </div>
      <div>
        <div class="price-line">
          <span class="amt" data-price="wfsPrep.perItem" data-pending="Price coming soon">$0.75</span>
          <span class="muted" data-text="wfsPrep.unit">per item</span>
        </div>
        <p class="fine" data-text="wfsPrep.note"></p>
        <a class="btn ghost" href="<?php echo esc_url( mm_url( 'quote' ) ); ?>">Get a WFS quote</a>
      </div>
    </div>

    <div class="price-block" id="storage">
      <div class="side">
        <div class="tag">03 Storage</div>
        <h2>Pallet storage</h2>
        <p>Racked pallet storage in our Bolingbrook warehouse. The first month on every new shipment is free.</p>
      </div>
      <div>
        <div class="price-line">
          <span class="amt">$0</span><span class="muted">for the first month</span>
        </div>
        <div class="price-line">
          <span class="amt" data-price="palletStorage.perPalletMonth" data-pending="Price coming soon">$52.00</span>
          <span class="muted" data-text="palletStorage.unit">per pallet per month</span>
        </div>
        <p class="fine" data-text="palletStorage.note"></p>
      </div>
    </div>

    <div class="price-block" id="fbm">
      <div class="side">
        <div class="tag">04 Merchant fulfilled</div>
        <h2>FBM orders</h2>
        <p>We pick, pack and ship your orders to the buyer. The more orders a day, the lower the handling fee. The same rates apply to 2 step dropshipping.</p>
      </div>
      <div>
        <div class="table-scroll">
          <table class="rate" data-table="fulfillment">
            <thead><tr><th>Daily orders</th><th>First item</th><th>Each extra item</th></tr></thead>
            <tbody>
              <tr><td>0 to 50 orders a day</td><td class="p">$2.75</td><td class="p">$0.50</td></tr>
              <tr><td>51 to 100 orders a day</td><td class="p">$2.50</td><td class="p">$0.50</td></tr>
              <tr><td>101 to 500 orders a day</td><td class="p">$2.25</td><td class="p">$0.40</td></tr>
              <tr><td>501 to 1,000 orders a day</td><td class="p">$1.85</td><td class="p">$0.30</td></tr>
            </tbody>
          </table>
        </div>
        <p class="fine">Handling fee is per order. Shipping postage is charged separately at cost.</p>
      </div>
    </div>

    <div class="price-block" id="two-step">
      <div class="side">
        <div class="tag">05 Dropship</div>
        <h2>2 step dropshipping</h2>
        <p>Your supplier ships to us instead of to your customer. We inspect the goods, remove supplier paperwork, repack and ship each order under your name.</p>
      </div>
      <div>
        <div class="price-line">
          <span class="muted">Starting at</span>
          <span class="amt" data-price="d.fbmFrom">$2.75</span>
          <span class="muted">per order, plus postage at cost</span>
        </div>
        <p class="fine">Your rate depends on daily order volume and the inspection you need.</p>
        <a class="btn orange" href="<?php echo esc_url( mm_url( 'quote' ) ); ?>">Get a 2 step quote</a>
      </div>
    </div>

    <div class="price-block" id="bundles">
      <div class="side">
        <div class="tag">06 Bundles</div>
        <h2>Variety packs and bundles</h2>
        <p>We assemble, seal and label finished packs from your single items. Each pack has a base price plus a building fee that grows with the number of items.</p>
        <p><a href="<?php echo esc_url( mm_url( 'bundles' ) ); ?>">How bundle building works</a></p>
      </div>
      <div>
        <table class="rate" data-table="bundles">
          <thead><tr><th>Items in the pack</th><th>Price per pack</th></tr></thead>
          <tbody>
            <tr><td>2 items</td><td class="p">$2.50 + $0.90</td></tr>
            <tr><td>3 to 4 items</td><td class="p">$2.50 + $1.25</td></tr>
            <tr><td>5 to 6 items</td><td class="p">$2.50 + $1.60</td></tr>
            <tr><td>7 or more items</td><td class="p"><a href="<?php echo esc_url( mm_url( 'quote' ) ); ?>">Custom quote</a></td></tr>
          </tbody>
        </table>
        <p class="fine" data-text="bundleBase.note"></p>
      </div>
    </div>

    <div class="price-block" id="courier">
      <div class="side">
        <div class="tag">07 Outbound</div>
        <h2>Courier drop off</h2>
        <p>We drop off to OnTrac and all other couriers, so your parcels get moving without waiting on a pickup.</p>
      </div>
      <div>
<ul class="carriers" aria-label="Couriers we drop off to">
  <li><img src="<?php echo esc_url( mm_asset( 'assets/img/couriers/ontrac.svg' ) ); ?>" alt="OnTrac" width="110" height="42" loading="lazy"></li>
  <li><img src="<?php echo esc_url( mm_asset( 'assets/img/couriers/ups.svg' ) ); ?>" alt="UPS" width="110" height="42" loading="lazy"></li>
  <li><img src="<?php echo esc_url( mm_asset( 'assets/img/couriers/fedex.svg' ) ); ?>" alt="FedEx" width="110" height="42" loading="lazy"></li>
  <li><img src="<?php echo esc_url( mm_asset( 'assets/img/couriers/usps.svg' ) ); ?>" alt="USPS" width="110" height="42" loading="lazy"></li>
  <li><img src="<?php echo esc_url( mm_asset( 'assets/img/couriers/dhl.svg' ) ); ?>" alt="DHL" width="110" height="42" loading="lazy"></li>
  <li class="more">and other regional couriers</li>
</ul>
        <div style="height:24px"></div>
        <table class="rate" data-table="extras">
          <thead><tr><th>Service</th><th>Price</th></tr></thead>
          <tbody></tbody>
        </table>
        <p class="fine">Carrier names and logos belong to their owners and are shown only to say which couriers we drop off to.</p>
      </div>
    </div>

  </div>
</section>

<div class="cta-band">
  <div class="wrap">
    <div>
      <h2>Not sure which rate fits your products?</h2>
      <p>Run your numbers in the calculator or send us a quick note.</p>
    </div>
    <div class="btn-row">
      <a class="btn" href="<?php echo esc_url( mm_url( 'quote' ) ); ?>">Get a Quote</a>
      <a class="btn light" href="<?php echo esc_url( mm_url( 'calculator' ) ); ?>">Cost Calculator</a>
    </div>
  </div>
</div>
</main>
<?php
get_footer();
