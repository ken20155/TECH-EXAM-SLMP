# Laravel API Project

## 📌 Overview

This project is a Laravel-based API that provides data endpoints such as users, posts, comments, albums, photos, and todos.

## ⚙️ Requirements

* PHP >= 8.x
* Composer
* MySQL / SQL Server
* Docker (optional)

## 🚀 Installation

```bash
git clone https://github.com/ken20155/TECH-EXAM-SLMP.git
cd TECH-EXAM-SLMP
composer install
cp .env.example .env
php artisan key:generate
```

## 🗄️ Database Setup

Update your `.env` file:

```env
DB_CONNECTION=mysql
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_pass
```

Then run:

```bash
php artisan migrate
php artisan fetch:json
```

## ▶️ Run Application

```bash
php artisan serve
```

App will run at:

```
http://127.0.0.1:8000
```
## 📬 Postman Documentation

You can test the API using the Postman documentation below:

🔗 https://documenter.getpostman.com/view/51987773/2sBXiknqew

### 🔐 Authentication

This API uses **Basic Authentication**:

* **Username:** admin
* **Password:** 123456

Make sure to include the Authorization header when testing endpoints.


## 🔐 Authentication

This project uses **Basic Authentication**.

Example:

```
Authorization: Basic base64(username:password)
```

## 📡 API Endpoints
* `/api/users`
* `/api/posts`
* `/api/comments`
* `/api/albums`
* `/api/photos`
* `/api/todos`

## 🐳 Docker Setup (Optional)

```bash
docker-compose up -d --build
```

## 👨‍💻 Author

Kenneth Tanuron
