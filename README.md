<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About MDM System

This is a Master Data Management (MDM) System built with **Laravel** and **MySQL**. It allows users to manage **Brands, Categories, and Items** with full CRUD operations and authentication.

### Key Features

- User Authentication (Login / Registration)
- Admin Dashboard for managing data
- CRUD operations for Brands, Categories, and Items
- Responsive UI with Bootstrap
- Role-based views (Admin/User)

## Installation

1. Clone the repository:
```bash
git clone <your-git-repo-link>
cd mdm-system
```
2. Install dependencies:
```bash
composer install
npm install
npm run dev
```
3. Configure `.env` file with database credentials
4. Generate app key:
```bash
php artisan key:generate
```
5. Run migrations:
```bash
php artisan migrate
```
6. Start the server:
```bash
php artisan serve
```




