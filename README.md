# Estatein Theme

A custom WordPress theme built for real estate websites. Features a **Property** Custom Post Type with **ACF** (Advanced Custom Fields) integration, **Tailwind CSS** styling compiled via **Prepros**, and a fully configurable header, footer, and ACF Gutenberg blocks — all without page builders.

---

## Table of Contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Build Setup (Tailwind + Prepros)](#build-setup-tailwind--prepros)
- [Theme Configuration](#theme-configuration)
  - [Theme Options: Header](#theme-options-header)
  - [Theme Options: Footer](#theme-options-footer)
  - [Theme Options: Settings](#theme-options-settings)
- [Navigation Menus](#navigation-menus)
- [ACF Blocks](#acf-blocks)
  - [Full Width Two Column Layout](#full-width-two-column-layout)
- [Property CPT](#property-cpt)
  - [ACF Fields](#acf-fields)
  - [Templates](#templates)
- [Theme Folder Structure](#theme-folder-structure)
- [Development Guidelines](#development-guidelines)
- [Browser Support](#browser-support)
- [License](#license)

---

## Requirements

- **WordPress** 6.0+
- **PHP** 8.0+
- **ACF PRO** (Advanced Custom Fields Pro) 6.0+
- **Node.js** 18+ (for Tailwind CSS compilation)
- **Prepros** (desktop app) for asset compilation — [https://prepros.io](https://prepros.io)

---

## Installation

1. **Clone or download** this repository into your WordPress `wp-content/themes/` directory:

   ```bash
   cd wp-content/themes/
   git clone https://github.com/coricsdev/estatein-theme.git
   ```

2. **Install Node dependencies** (for Tailwind CSS):

   ```bash
   cd estatein-theme
   npm install
   ```

3. **Compile assets** using Prepros (see [Build Setup](#build-setup-tailwind--prepros) below).

4. **Activate the theme** in WordPress Admin → Appearance → Themes.

5. **Install and activate ACF PRO** — the theme registers its field groups via PHP, so no JSON/DB import is needed.

---

## Build Setup (Tailwind + Prepros)

This theme uses **Tailwind CSS** for utility-first styling. Source files live in `assets/src/` and compiled output goes to `assets/dist/`. WordPress only enqueues minified files from `assets/dist/`.

### Source Files

- `assets/src/css/app.css` — Main stylesheet (includes `@tailwind` directives and custom component styles)
- `assets/src/js/app.js` — Main JavaScript entrypoint

### Compiled Output

- `assets/dist/css/app.min.css` — Minified CSS (enqueued by WordPress)
- `assets/dist/js/app.min.js` — Minified JS (enqueued by WordPress)

### Prepros Configuration

Open the theme folder in Prepros and configure:

**CSS:**
| Setting | Value |
|---------|-------|
| Input | `assets/src/css/app.css` |
| Output | `assets/dist/css/app.min.css` |
| Minify | ON |
| Autoprefix | ON |
| Watch | ON |

**JS:**
| Setting | Value |
|---------|-------|
| Input | `assets/src/js/app.js` |
| Output | `assets/dist/js/app.min.js` |
| Minify/Uglify | ON |
| Source Maps | OFF (for production) |
| Watch | ON |

### Tailwind Config

The `tailwind.config.js` scans all PHP and JS files for class usage:

```js
module.exports = {
  content: [
    "./**/*.php",
    "./assets/src/js/**/*.js"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
```

> **Important:** Never enqueue files from `assets/src/` in WordPress. Only `assets/dist/` files are loaded at runtime. If the compiled files are missing, an HTML comment is output for logged-in admins as a reminder to compile.

---

## Theme Configuration

All theme settings are managed via **Theme Options** in the WordPress admin sidebar (dashicon: Appearance).

### Theme Options: Header

**Location:** Theme Options → Header

#### Logo & Branding

| Field | Description |
|-------|-------------|
| Header Logo | Upload a logo image (SVG or PNG recommended). Falls back to site name text. |
| Show Site Tagline | Toggle display of the WordPress tagline next to the logo. |

#### Navigation

| Field | Description |
|-------|-------------|
| Nav Alignment | Left, Center, or Right alignment for the primary menu. |
| Sticky Header | Make the header stick to the top on scroll. |
| Nav CTA Button Label | Text for the navigation call-to-action button (e.g., "Contact Us"). Leave blank to hide. |
| Nav CTA Button URL | URL for the navigation CTA button. |
| Nav Background Color | Background color for the navigation bar. Default: `#1A1A1A`. |

#### Sticky Banner

| Field | Description |
|-------|-------------|
| Enable Banner | Show/hide the announcement banner above the header. |
| Banner Message | Text content (basic HTML allowed: `<strong>`, `<em>`, `<span>`). |
| Text Color | Color picker for banner text. |
| CTA Button Label | Label for the banner's call-to-action link (e.g., "Learn More"). |
| CTA Button URL | URL for the banner CTA. |
| Allow Visitors to Dismiss | Enable the ✕ close button (persists via sessionStorage). |
| Background Type | Solid Color or Background Image. |
| Background Color | Hex color when using Solid Color mode. |
| Background Image | Upload an image when using Background Image mode. |
| Background Position | Center, Top, Bottom, Left, or Right. |

### Theme Options: Footer

**Location:** Theme Options → Footer

#### General

| Field | Description |
|-------|-------------|
| Copyright Text | Custom copyright text (HTML allowed). Leave blank for auto-generated. |
| Footer Tagline | Short tagline displayed in the footer. |
| Footer Logo | Upload a separate footer logo. Falls back to the header logo if empty. |
| Terms & Conditions URL | URL for the Terms & Conditions link. Leave blank to hide. |
| Terms & Conditions Label | Custom label text. Default: "Terms & Conditions". |
| Footer Bottom Bar Background | Background color for the full-width bottom bar. Default: `#141414`. |

#### Social Links

| Field | Description |
|-------|-------------|
| Facebook URL | Full URL to your Facebook page. |
| Instagram URL | Full URL to your Instagram profile. |
| LinkedIn URL | Full URL to your LinkedIn page. |
| X (Twitter) URL | Full URL to your X/Twitter profile. |
| YouTube URL | Full URL to your YouTube channel. |

Social icons only appear when a URL is provided. Icons are rendered as inline SVGs.

### Theme Options: Settings

**Location:** Theme Options → Settings

| Field | Description |
|-------|-------------|
| Google Font | Select a font from the dropdown. Applied site-wide via Google Fonts. Options: Urbanist, Inter, Roboto, Poppins, Playfair Display, or Default (theme CSS). |

---

## Navigation Menus

The theme registers three menu locations:

| Location | Slug | Usage |
|----------|------|-------|
| Primary Menu | `primary` | Main navigation in the header. Displays as horizontal links on desktop, vertical dropdown on mobile with hamburger toggle. |
| Footer Menu | `footer` | Bottom bar legal links (e.g., "Terms & Conditions", "Privacy Policy"). Single depth only. |
| Footer Columns | `footer_columns` | Multi-column footer navigation. **Parent items** render as column headings. **Child items** render as links beneath each heading. |

### Setting Up Footer Columns

1. Go to **Appearance → Menus**.
2. Create a new menu (e.g., "Footer Columns").
3. Add **Custom Links** as parent items (use `#` as URL): Home, About Us, Properties, Services, Contact Us.
4. Add child items under each parent.
5. Assign the menu to the **"Footer Columns"** location.

---

## ACF Blocks

The theme includes custom ACF Gutenberg blocks registered via PHP. No manual field group import is needed — all fields are defined in `inc/acf-fields/`.

### Full Width Two Column Layout

A versatile hero/feature section with a content column and an image column.

**Block name:** `acf/two-column-layout`
**Category:** Estatein

#### Fields

| Tab | Field | Type | Notes |
|-----|-------|------|-------|
| Content | `heading` | Text | Required. The main heading. |
| Content | `description` | Textarea | Supporting description text. |
| CTA Buttons | `buttons` | Repeater (max 2) | Each button has: label, URL, style (Outline/Filled), and open-in-new-tab toggle. |
| Image | `badge_image` | Image (array) | Optional circular badge/spinner that overlaps the image column. Recommended: ~120×120px PNG with transparent background. |
| Image | `image` | Image (array) | The main image for the image column. |
| Image | `image_position` | Select | "Image on Right" or "Image on Left". |
| Stat Boxes | `show_stats` | True/False | Toggle stat boxes visibility. |
| Stat Boxes | `stats` | Repeater (max 6) | Each stat has: value (e.g., "200+") and label (e.g., "Happy Customers"). |
| Settings | `bg_color` | Color Picker | Section background color. Default: `#141414`. |
| Settings | `text_color` | Color Picker | Text color. Default: `#ffffff`. |
| Settings | `section_id` | Text | Optional HTML ID for anchor links. |

#### Responsive Behavior

- **Desktop:** Two equal columns side by side. Badge overlaps the left edge of the image column. Stats display in a horizontal row.
- **Mobile (≤768px):** Image stacks on top, content below. Buttons go full-width. Stats stack vertically. Badge moves to the bottom-left corner of the image.

---

## Property CPT

The theme registers a Custom Post Type for real estate property listings.

- **CPT slug:** `property`
- **Archive URL:** `/properties/`
- **Single template:** `single-property.php`
- **Archive template:** `archive-property.php`

### ACF Fields

The following fields are registered automatically via `inc/acf.php` for the Property post type:

| Field | Type | Description |
|-------|------|-------------|
| `price` | Number | Property price. |
| `address` | Text | Full property address. |
| `bedrooms` | Number | Number of bedrooms. |
| `bathrooms` | Number | Number of bathrooms. |
| `floor_area` | Number | Floor area in sqm. |
| `lot_area` | Number | Lot area in sqm. |
| `gallery` | Gallery (array) | Photo gallery for the property. |
| `map_location` | Google Map | Map pin for the property location. |
| `amenities` | Checkbox | Available amenities: Swimming Pool, Gym, Parking, Garden. |

### Templates

| File | Purpose |
|------|---------|
| `templates/archive-property.php` | Property listing archive page. |
| `templates/single-property.php` | Individual property detail page. |
| `template-parts/property/card.php` | Reusable property card component for archives/grids. |
| `template-parts/property/meta.php` | Property metadata display (beds, baths, area, etc.). |

---

## Theme Folder Structure

```
estatein-theme/
├── style.css                          # Theme metadata (required by WP)
├── functions.php                      # Bootstrap: loads all inc/ modules
├── index.php                          # Fallback template
├── page.php                           # Page template
├── screenshot.png                     # Theme screenshot
├── .gitignore
├── tailwind.config.js                 # Tailwind CSS configuration
├── postcss.config.js                  # PostCSS configuration
├── package.json                       # Node dependencies
│
├── inc/
│   ├── setup.php                      # Theme supports, menus, image sizes
│   ├── enqueue.php                    # Asset enqueuing (dist/ only)
│   ├── helpers.php                    # Utility functions (ACF wrappers, etc.)
│   ├── cpt-property.php               # Property CPT registration
│   ├── acf.php                        # ACF block registration + Property fields
│   ├── theme-options.php              # Admin settings pages (Header, Footer, Settings)
│   └── acf-fields/
│       └── block-two-column.php       # ACF field group for Two Column Layout block
│
├── templates/
│   ├── archive-property.php           # Property archive
│   └── single-property.php            # Single property
│
├── template-parts/
│   ├── blocks/
│   │   └── two-column-layout.php      # ACF block render template
│   ├── property/
│   │   ├── card.php                   # Property card component
│   │   └── meta.php                   # Property meta component
│   └── layout/
│       ├── header.php                 # Site header (banner + nav)
│       └── footer.php                 # Site footer
│
└── assets/
    ├── src/
    │   ├── css/
    │   │   └── app.css                # Source CSS (Tailwind + custom)
    │   └── js/
    │       └── app.js                 # Source JS
    └── dist/
        ├── css/
        │   └── app.min.css            # Compiled & minified CSS
        └── js/
            └── app.min.js             # Compiled & minified JS
```

---

## Development Guidelines

### PHP Standards

- Use `declare(strict_types=1)` in all PHP files.
- Always check `if (!defined('ABSPATH')) { exit; }` at the top.
- Escape all output: `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses_post()`.
- Sanitize all input: `sanitize_text_field()`, `intval()`, `esc_url_raw()`.
- Use nonces for forms and AJAX.
- Prefer `WP_Query` over direct SQL.

### ACF Usage

- Always use `get_field()` with fallback handling for empty values.
- Image fields should return **array** format.
- Use `have_rows()` / `get_sub_field()` for repeater fields.
- All ACF field groups are registered via PHP in `inc/acf-fields/` — no database import needed.

### CSS Architecture

- All styles live in `assets/src/css/app.css` inside `@layer components`.
- Use BEM-style class naming: `.estatein-block__element--modifier`.
- CSS custom properties (`--twocol-bg`, `--twocol-text`) are used for dynamic block colors.
- Mobile styles are in a single `@media (max-width: 768px)` block at the bottom.
- `color-mix()` is used for dynamic transparency based on text color.

### Performance

- Only `assets/dist/` files are enqueued (minified).
- Asset versioning uses `filemtime()` for automatic cache busting.
- JS is loaded in the footer (`true` parameter in `wp_enqueue_script`).
- Avoid jQuery unless explicitly required.
- No heavy assets are loaded site-wide — enqueue only where needed.

---

## Browser Support

- Chrome 90+
- Firefox 90+
- Safari 15+
- Edge 90+
- Mobile Safari (iOS 15+)
- Chrome for Android

> **Note:** The theme uses `color-mix()` in CSS which requires modern browsers. Fallback values are provided via CSS custom properties.

---

## License

This theme is proprietary. All rights reserved.