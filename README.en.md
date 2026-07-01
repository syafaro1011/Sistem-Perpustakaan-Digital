# Digital Library System

[Bahasa Indonesia](README.md) | [English](README.en.md)

Digital Library System is a web-based application built using the **Laravel 13** framework and **Bootstrap 5**. This application is designed to simplify library administration management, ranging from managing books and members to recording borrowing transactions, returns, and automatic calculation of late fines.

---

## 🚀 Key Features

- **Dynamic Statistics Dashboard**
    - Summary of total titles & book stock, number of members, and categories.
    - Transaction statistics: active, completed, overdue loans, and fine recap (paid & unpaid).
    - Monthly loan trend chart using **Chart.js**.
    - Visualization of book category distribution (doughnut chart).
    - Top 5 Most Popular Books list (most frequently borrowed).
    - Latest borrowing list and list of members with overdue loans.

- **Book & Category Management**
    - Manage book data: Title, Book Code, Author, Publisher, Year of Release, Stock, ISBN, Synopsis, and upload Book Cover.
    - Many-to-Many relationship between Books and Categories.

- **Member Management**
    - Recording member data (Name, Member No., Email, HP No., Address).
    - Configure member status (Active / Inactive).

- **Borrow & Return Transactions**
    - Record borrowing date and return deadline.
    - Record book returns along with book condition upon return (Good / Damaged / Lost).
    - Calculate days of delay automatically.

- **Automatic Fine System**
    - Automatically calculate accumulated late fines based on the number of days late.
    - Record fine payment history (Unpaid / Paid).

- **Activity Log (Audit Trail)**
    - Automatically record system CRUD activity logs using the `spatie/laravel-activitylog` package.

- **Multi-Role Authentication**
    - **Admin**: Has full access to all features including book category management and activity logs.
    - **Staff (Petugas)**: Has access to book management, members, borrowing, returns, and fines.

---

## 🛠️ Technology Stack

- **Backend**: PHP 8.3+ & Laravel 13
- **Database**: MySQL / MariaDB
- **Frontend**: Bootstrap 5, Bootstrap Icons, & Chart.js (via CDN)
- **Library/Package**:
    - `laravel/breeze` (Authentication starter kit)
    - `spatie/laravel-activitylog` (Activity logging)

---

## ⚙️ Installation & Setup

Follow the steps below to run the project in your local environment:

### 1. Clone the Repository

```bash
git clone https://github.com/username/Sistem-Perpustakaan-Digital.git
cd Sistem-Perpustakaan-Digital
```

### 2. Install Composer Dependencies

```bash
composer install
```

### 3. Configure Environment File

Copy the `.env.example` file to `.env`:

```bash
copy .env.example .env
```

Open the newly created `.env` file and adjust your database configuration:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3006
DB_DATABASE=sistem_perpustakaan_digital
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Migrations and Seeders

Run this command to create the tables along with the initial data (seeders):

```bash
php artisan migrate --seed
```

### 6. Set Up Storage Link

Use this command to create a symbolic link so that uploaded book covers are publicly accessible:

```bash
php artisan storage:link
```

### 7. Run Local Server

```bash
php artisan serve
```

Open your browser and navigate to `http://127.0.0.1:8000`.

---

## 🔑 Default Account Credentials

Here are the default credentials created by the seeder for testing:

### 1. Admin Account
- **Email**: `admin@perpustakaan.com`
- **Password**: `password`

### 2. Staff (Petugas) Account
- **Email**: `petugas@perpustakaan.com`
- **Password**: `password`

