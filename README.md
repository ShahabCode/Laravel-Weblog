<div align="center">

# 📝 Laravel Weblog

A modern blog platform built with **Laravel 13** and **Tailwind CSS**, fully RTL and in Persian, using the Vazirmatn font.

[![Laravel](https://img.shields.io/badge/Laravel-13.8-FF2D20?style=flat&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=flat&logo=php&logoColor=white)](https://www.php.net)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-06B6D4?style=flat&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=flat&logo=alpine.js&logoColor=black)](https://alpinejs.dev)

</div>

---

## 📋 Table of Contents

- [About](#-about)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Requirements](#-requirements)
- [Installation](#-installation)
- [Project Structure](#-project-structure)
- [User Roles](#-user-roles)
- [Routes](#-routes)
- [Roadmap](#-roadmap)

---

## 📖 About

**Laravel Weblog** lets users write posts, organize them into categories, and publish through an admin-approval workflow. The UI is fully Persian, RTL, and responsive.

---

## ✨ Features

| # | Feature | Description |
|---|---------|--------------|
| 📰 | **Post Management** | Create, edit, delete, and view posts with image upload |
| 🗂️ | **Categories** | Organize and browse posts by topic |
| 🔍 | **Search** | Quick search across post titles and content, from the header |
| ✅ | **Admin Approval** | Posts by regular users require admin approval before publishing |
| 👁️ | **View Counter** | Automatic view tracking per post |
| 📄 | **Pagination** | Smart pagination on the home page, post list, and "my posts" |
| 🔐 | **Authentication** | Registration, login, and profile management (Laravel Breeze) |
| 📱 | **Responsive Design** | Consistent experience across desktop, tablet, and mobile |
| 🎨 | **Persian RTL UI** | Vazirmatn font and full RTL layout across the site |
| 🧭 | **Shared Header/Footer** | Consistent navigation, search, and quick links on every page |

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|------------|
| Backend | Laravel 13.8 (PHP 8.3) |
| Frontend | Blade, Tailwind CSS 3, Alpine.js |
| Database | MySQL (MariaDB) |
| Font | [Vazirmatn](https://github.com/rastikerdar/vazirmatn) |
| Icons | Font Awesome 6 |
| Auth | Laravel Breeze |
| Build Tool | Vite |

---

## ⚙️ Requirements

- PHP >= 8.2
- Composer
- Node.js >= 18 and npm
- MySQL or MariaDB (e.g. via XAMPP)

---

## 🚀 Installation

```bash
# 1) Clone the project
git clone https://github.com/your-username/laravel-weblog.git
cd laravel-weblog

# 2) Install PHP dependencies
composer install

# 3) Install Node dependencies
npm install

# 4) Set up environment file
cp .env.example .env
php artisan key:generate
```

Then edit `.env` with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel-weblog
DB_USERNAME=root
DB_PASSWORD=
```

```bash
# 5) Run migrations
php artisan migrate

# 6) Seed default categories
php artisan db:seed --class=CategorySeeder

# 7) Create the storage symlink (for uploaded images)
php artisan storage:link

# 8) Run the app (two separate terminals)
php artisan serve
npm run dev
```

Visit:

```
http://127.0.0.1:8000
```

### 👤 Creating an Admin User

After registering a user through the site, grant admin access via Tinker:

```bash
php artisan tinker
```

```php
$u = App\Models\User::find(1);
$u->is_admin = true;
$u->save();
```

---

## 📁 Project Structure

```
laravel-weblog/
├── app/
│   ├── Http/Controllers/
│   │   ├── PostController.php
│   │   └── CategoryController.php
│   └── Models/
│       ├── Post.php
│       ├── Category.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── CategorySeeder.php
├── resources/
│   ├── css/app.css
│   └── views/
│       ├── components/
│       │   ├── site-header.blade.php
│       │   └── site-footer.blade.php
│       ├── posts/
│       ├── categories/
│       ├── dashboard.blade.php
│       └── welcome.blade.php
└── routes/
    └── web.php
```

---

## 👥 User Roles

| Role | Permissions |
|------|-------------|
| 👤 **Guest** | View published posts, search, browse categories |
| ✍️ **Member** | Create, edit, and delete own posts (pending admin approval) |
| 🛡️ **Admin** | Approve/publish pending posts, view all posts (published and pending) |

---

## 🧭 Routes

| Method | Path | Description |
|--------|------|--------------|
| GET | `/` | Home page |
| GET | `/posts` | List all posts + search |
| GET | `/posts/{slug}` | View a single post |
| GET | `/posts/create` | Create post form |
| GET | `/posts/{post}/edit` | Edit post form |
| POST | `/posts/{post}/approve` | Approve and publish a post *(admin only)* |
| GET | `/categories/{slug}` | Posts in a category |
| GET | `/dashboard` | User dashboard |

---

## ⭐ Support
If you like this project, give it a **star** on GitHub! 🌟
