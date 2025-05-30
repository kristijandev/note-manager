# 📝 Note Management App

A simple Laravel + Vue.js app for managing notes related to users. Supports both local and Docker development environments.

---

## 🔧 Tech Stack

- Laravel 10+
- Vue.js 3 (SPA)
- Tailwind CSS
- Axios
- MySQL
- Docker (optional)

---

## 🚀 Local Development Setup (without Docker)

### ✅ Prerequisites

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL

### 📦 Installation

```bash
git clone https://your-repo-url.git
cd note-management-app

cp .env.example .env
composer install
php artisan key:generate

npm install
npm run dev

php artisan migrate
php artisan serve
```
## 🐳 Docker Setup

### ✅ Prerequisites

- Docker
- Docker Compose

### 📁 Setup and Run

1. Copy the example environment file:

```bash
cp .env.example .env
```
2. Build and start the containers:
```bash
docker-compose up --build -d
```
3. Access the Laravel container to install dependencies and run migrations:

```bash
docker exec -it laravel-app bash
composer install
php artisan migrate
npm install
npm run build
exit
```
4. Your app should now be accessible at:

    - Laravel API: http://localhost:9000
    - MySQL server is available on port 3306 with credentials set in .env
