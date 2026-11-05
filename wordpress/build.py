#!/usr/bin/env python3
"""Build the WordPress theme from the static site.

Run from the repository root:  python3 wordpress/build.py

It copies the site's CSS, scripts, images and default data into
wordpress/moguls-services/, turns each static page into a WordPress template
(header.php, footer.php, front-page.php, templates/*.php), and writes
wordpress/moguls-services.zip, ready for Appearance > Themes > Add New > Upload.

The hand written parts of the theme (functions.php, inc/, assets/admin/,
index.php, page.php, style.css) are not touched.
"""
import os, re, shutil, sys, zipfile

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
THEME = os.path.join(ROOT, "wordpress", "moguls-services")

PAGES = {
    # key: (static file, template file, template name or None for the front page)
    "index": ("index.html", "front-page.php", None),
    "services": ("services.html", "templates/services.php", "Services and Pricing"),
    "bundles": ("bundles.html", "templates/bundles.php", "Variety Pack and Bundle Building"),
    "grocery": ("grocery.html", "templates/grocery.php", "Grocery and CPG"),
    "calculator": ("calculator.html", "templates/calculator.php", "Cost Calculator"),
    "quote": ("quote.html", "templates/quote.php", "Get a Quote"),
}
KEYS = "|".join(PAGES)


def read(name):
    with open(os.path.join(ROOT, name), encoding="utf-8") as f:
        return f.read()


def write(rel, text):
    path = os.path.join(THEME, rel)
    os.makedirs(os.path.dirname(path), exist_ok=True)
    with open(path, "w", encoding="utf-8") as f:
        f.write(text)


def php_str(s):
    return "'" + s.replace("\\", "\\\\").replace("'", "\\'") + "'"


def between(text, start, end, include_end=True):
    i = text.index(start)
    j = text.index(end, i)
    return text[i : j + (len(end) if include_end else 0)]


def replace_once(text, old, new):
    if old not in text:
        sys.exit("build.py: could not find this text in the page, update the script:\n" + old[:200])
    return text.replace(old, new, 1)


def convert(html):
    """Rewrite paths, links and business details for WordPress."""
    html = re.sub(r'(src|href|poster)="assets/([^"]*)"',
                  lambda m: '%s="<?php echo esc_url( mm_asset( %s ) ); ?>"' % (m.group(1), php_str("assets/" + m.group(2))), html)
    html = re.sub(r'href="(%s)\.html(#[^"]*)?"' % KEYS,
                  lambda m: 'href="<?php echo esc_url( mm_url( \'%s\' ) ); ?>%s"' % (m.group(1), m.group(2) or ""), html)
    html = re.sub(r'href="mailto:[^"]*"(\s+data-setting-href="contactEmail")',
                  r'href="<?php echo esc_attr( mm_mailto_href() ); ?>"\1', html)
    html = re.sub(r'href="tel:[^"]*"(\s+data-setting-href="phone")',
                  r'href="<?php echo esc_attr( mm_tel_href() ); ?>"\1', html)
    html = re.sub(r'(data-setting="(\w+)"[^>]*>)[^<]*(<)', r"\1<?php mm_s( '\2' ); ?>\3", html)
    html = re.sub(r"<span data-year>\d*</span>", "<span data-year><?php echo esc_html( wp_date( 'Y' ) ); ?></span>", html)
    return html


def meta(html):
    title = re.search(r"<title>(.*?)</title>", html, re.S).group(1).strip()
    desc = re.search(r'<meta name="description" content="([^"]*)"', html).group(1)
    return title.replace("&amp;", "&"), desc.replace("&amp;", "&")


def home_customizable(main):
    """Swap the home page text that is editable in the Customizer."""
    main = replace_once(main, '<div class="tag">3PL warehouse in Bolingbrook, Illinois</div>',
                        "<div class=\"tag\"><?php mm_t( 'hero_tag' ); ?></div>")
    main = replace_once(main, "<h1>Delivered to us today. <em>Shipped within 24 hours.</em></h1>",
                        "<h1><?php mm_t( 'hero_title' ); ?> <em><?php mm_t( 'hero_highlight' ); ?></em></h1>")
    lead = re.search(r'<p class="lead">We prep and ship.*?</p>', main, re.S).group(0)
    main = replace_once(main, lead, "<p class=\"lead\"><?php mm_t( 'hero_lead' ); ?></p>")
    main = replace_once(main, "<h2>The people behind your fulfillment</h2>", "<h2><?php mm_t( 'lead_heading' ); ?></h2>")
    block = between(main, '<div class="leader-grid">', '<div class="sign">')
    block = main[main.index(block) : main.index("</div>", main.index('<div class="sign">')) + len("</div>")]
    leaders = """<div class="leader-grid">
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
      <div class="sign"><?php mm_t( 'msg_sign' ); ?></div>"""
    return main.replace(block, leaders, 1)


def build_header(index):
    loader = between(index, '<div class="loader"', "<header", include_end=False)
    header = between(index, '<header class="site-header">', "</header>")
    header = convert(header).replace(' aria-current="page"', "")
    header = re.sub(r"(<a href=\"<\?php echo esc_url\( mm_url\( '(\w+)' \) \); \?>\")>",
                    r"\1<?php mm_current( '\2' ); ?>>", header)
    header = re.sub(r'<img src="[^"]*logo\.png[^"]*" alt="[^"]*"',
                    "<img src=\"<?php echo esc_url( mm_mod( 'logo_header' ) ); ?>\" alt=\"<?php echo esc_attr( mm_setting( 'businessName' ) ); ?>\"", header, count=1)
    head = """<?php
/**
 * Site header: loading screen and top menu. Built from the static site by wordpress/build.py.
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
"""
    loader = re.sub(r'(class="loader-logo" src=")[^"]*(")', r"\1<?php echo esc_url( mm_mod( 'logo_header' ) ); ?>\2", convert(loader))
    write("header.php", head + loader + header + "\n")


def build_footer(index):
    footer = convert(between(index, '<footer class="site-footer">', "</footer>"))
    footer = re.sub(r'<img src="[^"]*logo-light\.png[^"]*" alt="[^"]*"',
                    "<img src=\"<?php echo esc_url( mm_mod( 'logo_footer' ) ); ?>\" alt=\"<?php echo esc_attr( mm_setting( 'businessName' ) ); ?>\"", footer, count=1)
    blurb = re.search(r'(loading="lazy">\s*)<p>(.*?)</p>', footer, re.S)
    footer = footer.replace(blurb.group(0), blurb.group(1) + "<p><?php mm_t( 'footer_blurb' ); ?></p>", 1)
    footer = replace_once(footer, "</span> Marketplace Moguls Services</span>", "</span> <?php mm_s( 'businessName' ); ?></span>")
    promo = convert(between(index, '<div class="promo"', "<script", include_end=False)).rstrip()
    promo = re.sub(r'(class="promo-logo" src=")[^"]*(")', r"\1<?php echo esc_url( mm_mod( 'logo_header' ) ); ?>\2", promo)
    promo = promo.replace('alt="Moguls Services"', "alt=\"<?php echo esc_attr( mm_setting( 'businessName' ) ); ?>\"")
    out = """<?php
/**
 * Site footer and the home page popup. Built from the static site by wordpress/build.py.
 */
?>
%s
<?php if ( is_front_page() && mm_mod( 'popup_on' ) ) : ?>
%s
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>
""" % (footer, promo)
    write("footer.php", out)


def build_pages():
    for key, (src, dest, name) in PAGES.items():
        html = read(src)
        main = between(html, '<main id="main">', "</main>")
        gap = html[html.index("</main>") + 7 : html.index("<footer")]
        if gap.strip():
            sys.exit("build.py: %s has content between </main> and <footer>, update the script." % src)
        main = convert(main)
        if key == "index":
            main = home_customizable(main)
        title, desc = meta(html)
        doc = "/**\n * Template Name: %s\n *\n * Built from %s by wordpress/build.py.\n */" % (name, src) if name else \
              "/**\n * Home page. Built from %s by wordpress/build.py.\n */" % src
        out = "<?php\n%s\n\nmm_set_meta( %s, %s );\nget_header();\n?>\n%s\n<?php\nget_footer();\n" % (doc, php_str(title), php_str(desc), main)
        write(dest, out)


def copy_assets():
    for d in ("assets/css", "assets/js", "assets/img"):
        target = os.path.join(THEME, d)
        if os.path.isdir(target):
            shutil.rmtree(target)
        shutil.copytree(os.path.join(ROOT, d), target, ignore=shutil.ignore_patterns(".DS_Store", "admin.js"))
    os.makedirs(os.path.join(THEME, "data"), exist_ok=True)
    for f in ("prices.json", "settings.json"):
        shutil.copy(os.path.join(ROOT, "data", f), os.path.join(THEME, "data", f))


def make_zip():
    out = os.path.join(ROOT, "wordpress", "moguls-services.zip")
    with zipfile.ZipFile(out, "w", zipfile.ZIP_DEFLATED) as z:
        for base, _, files in os.walk(THEME):
            for f in sorted(files):
                if f == ".DS_Store":
                    continue
                full = os.path.join(base, f)
                z.write(full, os.path.relpath(full, os.path.dirname(THEME)))
    return out


if __name__ == "__main__":
    index = read("index.html")
    copy_assets()
    build_header(index)
    build_footer(index)
    build_pages()
    print("Theme built:", THEME)
    print("Zip:", make_zip())
