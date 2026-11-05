# WordPress theme

`moguls-services.zip` is the whole site as a WordPress theme.

## Install

1. In WordPress go to **Appearance > Themes > Add New > Upload Theme**, choose `moguls-services.zip` and click **Install Now**, then **Activate**.
2. Open the dashboard once after activating. The theme creates the pages (Services and Pricing, Variety Packs, Grocery and CPG, Cost Calculator, Get a Quote) and sets a Home page as the front page.
3. Go to **Settings > Permalinks** and pick **Post name**, so the page links read like `/get-a-quote/`.

## What you can change, and where

| Dashboard menu | What it controls |
| --- | --- |
| **Moguls Settings** | The email that receives form submissions (several addresses can be separated with commas), the "send from" address, business name, public email, phone, address, hours, and every price including calculator settings |
| **Appearance > Customize > Moguls Services** | Header and footer logos, footer text, home page headline and intro, leadership names, titles, photos and CEO message, and the home page popup on or off |
| **Form Requests** | A copy of every quote, variety pack and calculator request, with the customer's email and whether the email went out |

Empty prices show "Price coming soon", "Custom quote" or "Ask us", the same as the static site.

## Forms and email

All three forms (Get a Quote, Variety Packs and the calculator's exact quote) post to WordPress, which emails the request to the address in **Moguls Settings > Form email**. Reply in your mail app and the reply goes to the customer. Every request is also saved under **Form Requests**, so nothing is lost if an email fails.

The default for both the form inbox and the public email is `info@mogulsservices.com`.

WordPress sends mail through the host's PHP mail by default, which often lands in spam or is blocked. For reliable delivery, install the free **WP Mail SMTP** plugin and connect it to the mailbox for info@mogulsservices.com (Google Workspace, Microsoft 365 or your host's SMTP). Use its "Send a test email" button to check.

## Rebuilding after changes to the static pages

The page templates are generated from the static HTML files in the repository root. After editing those, run this from the repository root to update the theme and the zip:

```
python3 wordpress/build.py
```

The hand written parts (`functions.php`, `inc/`, `assets/admin/`, `index.php`, `page.php`, `single.php`, `style.css`) are not overwritten. Text that is edited in WordPress (Customizer and Moguls Settings) is stored in the database and is kept when you upload a new zip.
