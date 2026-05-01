# SecondHandCarMarketplace

A role-based second-hand car marketplace built with HTML/CSS/JavaScript (frontend), PHP (backend), and MySQL (database).

## Project Overview

This project provides a basic marketplace flow for:

- User registration and login with roles (`admin`, `customer`, `seller`)
- Seller and customer data management
- Car listing creation with image upload
- Admin car management (view, edit, delete)
- Booking and payment flow
- Maintenance record upload and viewing

## Tech Stack

- Frontend: HTML, CSS, vanilla JavaScript
- Backend: PHP (procedural + MySQLi)
- Database: MySQL

## Repository Structure

```text
.
|-- frontend/
|   |-- index.html
|   |-- login.html
|   |-- register.html
|   |-- admin_dashboard.html
|   |-- customer_dashboard.html
|   |-- seller_dashboard.html
|   |-- add_car.html
|   |-- add_customer.html
|   |-- add_seller.html
|   |-- add_maintenance.html
|   |-- booking.html
|   |-- payment.html
|   |-- viewcar.html
|   |-- view_sellers.html
|   |-- view_maintenance.html
|   |-- backend/
|   |   |-- db.php
|   |   |-- login.php
|   |   |-- register.php
|   |   |-- addcar.php
|   |   |-- addseller.php
|   |   |-- add_customer.php
|   |   |-- add_maintenance.php
|   |   |-- add_bookings.php
|   |   |-- add_payments.php
|   |   |-- add_transactions.php
|   |   |-- get_cars.php
|   |   |-- get_car_price.php
|   |   |-- view_cars.php
|   |   |-- view_sellers.php
|   |   |-- view_customers.php
|   |   |-- view_maintenance.php
|   |   |-- view_bookings.php
|   |   |-- edit_car.php
|   |   |-- delete_car.php
|   |-- images/
|-- images/                      (uploaded car images)
`-- README.md
```

## Core Functional Flow

1. Users register via `frontend/register.html` and authenticate via `frontend/login.html`.
2. Based on role, users are redirected to dedicated dashboards.
3. Sellers/admin can add cars using `frontend/add_car.html` -> `frontend/backend/addcar.php`.
4. Customers browse cars in `frontend/viewcar.html` and can book from `frontend/booking.html`.
5. Booking redirects to `frontend/payment.html` for payment entry.
6. Maintenance records can be added and viewed using maintenance pages/endpoints.

## Backend Endpoints (Current)

- Auth: `frontend/backend/register.php`, `frontend/backend/login.php`
- Car management: `frontend/backend/addcar.php`, `frontend/backend/get_cars.php`, `frontend/backend/view_cars.php`, `frontend/backend/edit_car.php`, `frontend/backend/delete_car.php`, `frontend/backend/get_car_price.php`
- People management: `frontend/backend/addseller.php`, `frontend/backend/add_customer.php`, `frontend/backend/view_sellers.php`, `frontend/backend/view_customers.php`
- Booking and payments: `frontend/backend/add_bookings.php`, `frontend/backend/add_payments.php`, `frontend/backend/add_transactions.php`, `frontend/backend/view_bookings.php`
- Maintenance: `frontend/backend/add_maintenance.php`, `frontend/backend/view_maintenance.php`

## Database Configuration

Database connection is defined in `frontend/backend/db.php`:

- Host: `localhost`
- DB Name: `dbmsproject`
- User: `root`
- Password: empty by default
- Port: `3307`

Update these values to match your local MySQL setup.

## Expected Database Tables

Based on backend queries, the application expects at least these tables:

- `users`
- `Cars` / `cars`
- `Sellers`
- `Customers` / `customers`
- `bookings`
- `Payments`
- `Transactions`
- `MaintenanceRecords`

Note: table naming in code is not fully consistent (`Cars` vs `cars`, `Customers` vs `customers`). If your MySQL setup is case-sensitive, normalize table names or adjust queries.

## Local Setup

1. Install and start Apache + MySQL (XAMPP/WAMP/LAMP or equivalent).
2. Place this project in your web server root, or configure a virtual host.
3. Create a MySQL database named `dbmsproject`.
4. Create required tables and columns matching backend SQL usage.
5. Update `frontend/backend/db.php` with your DB credentials and port.
6. Ensure these writable folders exist:
	- `images/` (project root)
	- `uploads/maintenance/`
7. Open the app in browser from:
	- `frontend/index.html` (if served with PHP-capable server path)

## Notes

- This is a server-rendered/static-page hybrid project (no build step required).
- Some endpoints use direct SQL string interpolation and can be improved with prepared statements for better security.
- `view_bookings.php` currently references columns (`name`, `pickup`, `dropoff`) that should match your actual schema.
