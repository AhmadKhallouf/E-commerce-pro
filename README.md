<div align="center">

# E‑commerce Pro

**Full‑stack Laravel e‑commerce store with Stripe checkout, cash on delivery, and an admin control panel.**

[![Laravel](https://img.shields.io/badge/Laravel-9.x-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

*A portfolio‑grade project demonstrating authentication, payments integration, role‑based areas, and operational tooling for running an online shop.*

</div>

---

## Overview

This application is a **complete shopping experience** for customers and a **dedicated back office** for administrators. Customers can browse a catalog, manage a cart with **flexible quantities** (single items or larger volumes), and complete checkout either **online via Stripe** or **cash on delivery**. The storefront includes a **public comments area with replies** so users can share feedback. Administrators use a **separate dashboard** to manage categories, products, orders, and fulfillment—including **PDF order exports** for records or shipping.

---

## Why this project exists

Built as a **learning and demonstration codebase**, it shows how common e‑commerce concerns fit together in **Laravel**: verified user accounts, payment flows, order lifecycle, inventory presentation (including sale pricing), and admin workflows suitable for a small or medium online business.

---

## Key features

### Storefront (customer)

| Area | What it does |
|------|----------------|
| **Catalog & discovery** | Home page with featured sections, paginated product listing, and authenticated product search across title, description, price, and category. |
| **Product detail** | Images, category, description, stock quantity, regular price, and optional **discount price** when on sale. |
| **Cart** | Add items with **quantity**; line totals respect discounted unit price when applicable; merge quantities when adding the same product again. |
| **Checkout** | **Stripe** card payment (server‑side charge flow) **or** **cash on delivery**; orders created from cart with payment and delivery status. |
| **Orders** | View personal order history and cancel pending orders when needed. |
| **Community** | **Comments** on the main page plus **threaded replies** for discussion. |

### Admin control panel

| Area | What it does |
|------|----------------|
| **Dashboard** | At‑a‑glance metrics: total products, orders, customers (non‑admin users), revenue sum, delivered vs pending orders. |
| **Categories** | Create and delete product categories. |
| **Products** | Create, list, update, and delete products with **image uploads**, pricing, discount pricing, quantity, and category assignment. |
| **Orders** | List all orders; **mark orders delivered** (updates delivery and payment flags); **search** orders by customer name, phone, product title, or status fields; **download PDF** with order details. |

### Account & security

- **Laravel Jetstream** UI stack with **Fortify** authentication.
- **Email verification** for registered users (`MustVerifyEmail`).
- Optional **two‑factor authentication** and **API tokens** (Sanctum) via Jetstream where enabled.
- **Role‑based landing**: users with `user_type = admin` are sent to the admin dashboard after login; others see the storefront.

---

## Screenshots

Assets are in [`public/docs/screenshots/`](public/docs/screenshots/) (also available at `/docs/screenshots/…` when the app is served from `public/`).

### Storefront

| | |
| --- | --- |
| ![Home — hero area](public/docs/screenshots/storefront-home-hero.png) | ![Home — slider](public/docs/screenshots/storefront-home-slider.png) |
| *Home — hero* | *Home — featured slider* |
| ![Home — product section](public/docs/screenshots/storefront-home-productarea.png) | ![Catalog](public/docs/screenshots/storefront-catalog.png) |
| *Home — products* | *Catalog / listing* |
| ![Product detail](public/docs/screenshots/storefront-prduct-detail.png) | ![Shopping cart](public/docs/screenshots/storefront-cart.png) |
| *Product detail & quantity* | *Cart* |
| ![Search results](public/docs/screenshots/storefront-search.png) | ![Comments & replies](public/docs/screenshots/storefront-home-comments.png) |
| *Product search* | *Comments* |

### Checkout & orders

| | |
| --- | --- |
| ![Stripe checkout](public/docs/screenshots/storefront-checkout-stripe.png) | ![Cash on delivery](public/docs/screenshots/storefront-checkoout-cod.png) |
| *Stripe payment* | *Cash on delivery* |
| ![My orders](public/docs/screenshots/storefront-my-orders.png) | ![Comments — alternate view](public/docs/screenshots/storefront-home-comments2.png) |
| *Order history* | *Comments (alternate view)* |

### Authentication (Jetstream)

| | |
| --- | --- |
| ![Login](public/docs/screenshots/auth-login.png) | ![Register](public/docs/screenshots/auth-register.png) |
| *Login* | *Register* |

### Admin control panel

| | |
| --- | --- |
| ![Admin dashboard](public/docs/screenshots/admin-dashboard.png) | ![Categories](public/docs/screenshots/admin-categories.png) |
| *Dashboard & KPIs* | *Categories* |
| ![Add product](public/docs/screenshots/admin-product-create.png) | ![Product list](public/docs/screenshots/admin-product-list.png) |
| *Add product* | *Product list* |
| ![Orders](public/docs/screenshots/admin-orders.png) | ![Order search](public/docs/screenshots/admin-order-search.png) |
| *Orders* | *Order search* |
| ![Order PDF](public/docs/screenshots/admin-order-pdf.png) | ![Order PDF — alternate](public/docs/screenshots/admin-order-pdf2.png) |
| *Order PDF export* | *PDF detail (alternate)* |

*Extra captures* (`*2` variants, alternate angles) are in the same folder if you want to swap any image above.

---

## Tech stack

| Layer | Technologies |
|--------|----------------|
| **Backend** | Laravel 9, PHP 8+, Eloquent ORM, session/auth middleware |
| **Auth & UI scaffold** | Laravel Jetstream, Livewire 2, Laravel Fortify, Laravel Sanctum |
| **Payments** | Stripe PHP SDK (`stripe/stripe-php`) — Charges API |
| **PDF** | barryvdh/laravel-dompdf |
| **Frontend (shop)** | Blade, Bootstrap‑based template (`public/home`), jQuery |
| **Frontend (admin)** | Blade, Corona‑style admin theme (`public/admin`) |
| **Frontend (Jetstream)** | Vite, Tailwind CSS, Alpine.js |
| **Database** | MySQL (default configuration) |

---

## Architecture (high level)

```mermaid
flowchart LR
  subgraph customer [Customer]
    Browse[Browse / Search]
    Cart[Cart]
    Pay[Stripe or COD]
    Comments[Comments / Replies]
  end
  subgraph admin [Administrator]
    Dash[Dashboard KPIs]
    CRUD[Categories / Products]
    Orders[Orders / PDF / Delivered]
  end
  Browse --> Cart
  Cart --> Pay
  Pay --> Orders
  CRUD --> Browse
```

- **Routes** in `routes/web.php` wire **HomeController** (store, cart, checkout, comments, search) and **adminController** (admin CRUD and orders).
- **Images** for products are stored under `public/ProductImage`.
- **Orders** persist payment method outcome (`Paid` vs `cash on delivery`) and delivery state (`pending`, `delivered`, or user‑cancelled message).

---

## Getting started

### Requirements

- PHP **≥ 8.0.2** with common extensions (openssl, pdo, mbstring, tokenizer, xml, ctype, json)
- **Composer**
- **Node.js** + npm (for Vite / Jetstream assets)
- **MySQL** (or adapt `.env` for your database)

### Installation

```bash
git clone <your-repository-url>
cd E-commerce-pro
composer install
cp .env.example .env
php artisan key:generate
```

Configure **database** credentials in `.env`, then:

```bash
php artisan migrate
npm install
npm run build
php artisan serve
```

### Stripe (online payments)

Add your secret key to `.env`:

```env
STRIPE_SECRET=sk_test_...
```

Use Stripe **test** keys in development. The app uses the Stripe **Charges** API with a token from the payment form (`stripePost` in `HomeController`).

### Creating an admin user

Users default to `user_type = user` in the database. To access the **admin dashboard**, set **`user_type`** to **`admin`** for your user row (e.g. via your DB client or a one‑off tinker command) after registering.

---

## Project layout (not exhaustive)

| Path | Role |
|------|------|
| `app/Http/Controllers/HomeController.php` | Store, cart, Stripe/COD, orders, comments, search |
| `app/Http/Controllers/adminController.php` | Admin categories, products, orders, PDF |
| `resources/views/home/` | Storefront Blade views |
| `resources/views/admin/` | Admin panel Blade views |
| `database/migrations/` | Schema for users, products, carts, orders, comments, replies |

---

## Testing

```bash
php artisan test
```

---

## License

This project is open‑sourced under the [MIT license](https://opensource.org/licenses/MIT).

---

<div align="center">

**Built with Laravel — demonstrating real‑world e‑commerce patterns end to end.**

</div>
