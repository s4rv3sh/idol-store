# Idol Painting Online Store

A simple e-commerce web application for buying **Indian idol paintings** (Lord Ganesha, Krishna, Lakshmi, Shiva, Durga, Kali, etc.). Built with **PHP**, **CSS**, and **MySQL** (phpMyAdmin).

## Features

- Browse paintings by category (Ganesha, Krishna, Lakshmi, Shiva, Durga & Kali)
- Product detail page with add-to-cart
- Shopping cart with quantity update and remove
- Checkout with customer name, email, phone, and address
- Orders saved in database
- Responsive layout and Indian-themed styling

## Requirements

- PHP 7.4+ (with PDO MySQL)
- MySQL / MariaDB (e.g. XAMPP, WAMP, or standalone)
- Web server (Apache with mod_rewrite optional, or PHP built-in server)

## Setup

### 1. Database (phpMyAdmin)

1. Open **phpMyAdmin** in your browser.
2. Go to **Import** or **SQL** tab.
3. Run the schema first:
   - Open `sql/schema.sql`, copy its contents, and execute in phpMyAdmin.
4. Then run the sample data:
   - Open `sql/sample_data.sql`, copy its contents, and execute in phpMyAdmin.

This creates the database `idol_painting_store` and tables: `users`, `categories`, `products`, `orders`, `order_items`, plus sample categories and paintings.

### 2. PHP configuration

Edit `config/database.php` and set your MySQL credentials:

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'idol_painting_store');
define('DB_USER', 'root');      // your MySQL username
define('DB_PASS', '');         // your MySQL password
```

If the project is not in the document root (e.g. `http://localhost/idol-painting-store/`), set the base URL in `config/config.php`:

```php
define('SITE_URL', '/idol-painting-store/');
```

### 3. Run the site

- **XAMPP/WAMP:** Copy the project folder into `htdocs` (XAMPP) or `www` (WAMP), then open `http://localhost/idol-painting-store/` in the browser.
- **PHP built-in server:** From the project root run:
  ```bash
  php -S localhost:8000
  ```
  Then open `http://localhost:8000` and set `SITE_URL` to `''` in `config/config.php`.

### 4. Product images (optional)

Sample products reference image paths like `images/ganesha1.jpg`. If those files are missing, the site shows a placeholder. To use real images, add your image files under the `images/` folder and keep the same filenames, or update the `image_path` in the `products` table via phpMyAdmin.

## Project structure

```
idol-painting-store/
├── config/
│   ├── config.php      # Site name, URL, session
│   └── database.php    # MySQL connection
├── includes/
│   ├── header.php      # Common header and nav
│   └── footer.php      # Common footer
├── css/
│   └── style.css       # All styles
├── images/
│   └── placeholder.svg # Fallback when product image missing
├── sql/
│   ├── schema.sql      # Create DB and tables
│   └── sample_data.sql # Categories and sample products
├── index.php           # Home + featured products
├── products.php        # All paintings + category filter
├── product.php        # Single product + add to cart
├── cart.php           # Cart view and update
├── checkout.php       # Checkout form and place order
└── README.md
```

## License

Free to use and modify for learning or commercial use.
