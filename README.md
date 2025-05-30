# 📝 Note Management App

A full-stack Note Management system built using **Laravel 10+** for the backend (REST API) and **Vue.js 3** for the frontend (SPA). The app allows users to create and view notes, with each note linked to a specific user. Designed to run in both **local** and **Dockerized** development environments.

---

## 🔧 Tech Stack

- **Backend**: Laravel 10+ (PHP 8.2+)
- **Frontend**: Vue.js 3 (Composition API)
- **HTTP Client**: Axios
- **Styling**: Tailwind CSS
- **Database**: MySQL
- **DevOps**: Docker & Docker Compose (optional)

---

## ⚙️ Features

### ✅ Core Functionality
- List all users with their notes
- List all notes with associated user data
- Create new notes (with validation)
- SPA routing with login and dashboard views
- Token-based auth via `localStorage`
- Frontend form validation
- Note filtering by user
- Logout mechanism
- Basic responsive UI using Tailwind

---

## 📂 Project Structure
```
note-management-app/
├── note-manager/ # Laravel API
├── note-manager/resource/js/ # Vue.js 3 SPA
├── docker-compose.yml
└── README.md
```
---

## 🚀 Local Development Setup (without Docker)

### ✅ Prerequisites
- PHP ≥ 8.2
- Composer
- Node.js & npm
- MySQL server

### 📦 Backend Setup

```bash
cd backend
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
php artisan serve
```
🎨 Frontend Setup
```
cd frontend
npm install
npm run dev
```
🐳 Docker Development Setup

✅ Prerequisites
Docker

Docker Compose

📁 Setup & Run
Clone and enter the project directory:

```
cd note-management-app  

Copy the Laravel environment file:
cp .env.docker .env

Start the containers:
docker-compose up --build -d

Access the Laravel container and finalize the setup:
docker exec -it laravel-app bash

composer install
php artisan key:generate
php artisan migrate

npm install
npm run build
exit

Visit:

API: http://localhost:9000/api

Frontend: http://localhost:9000

MySQL: localhost:3306
```


📡 API Endpoints
```
Method	Endpoint	Description
GET	/api/users	Get all users with their notes
GET	/api/notes	Get all notes with associated user
POST	/api/notes	Create a new note (requires user_id, title, body)

All API routes are prefixed with /api and return JSON responses.
```

🖥️ Frontend (Vue.js)
The frontend is a single-page Vue.js 3 app that:

Lists all notes (with user names)

Allows note creation via a form (select user, input title/body)

Uses localStorage to store auth tokens

Handles routing using Vue Router (/ for login, /dashboard for main UI)

🔐 Authentication
Basic fake login token is stored in localStorage for routing purposes.

Logout clears the token and redirects to login.

📸 Screenshots
Add screenshots here if needed (Dashboard UI, Note Form, etc.)

🧪 Testing
Basic functional testing is done via manual form input and API response checks.

📝 License
This project is open-source and free to use for educational or demo purposes.

🙋‍♂️ Author
Developed by Kristijan Opacic – Laravel & Vue.js Full Stack Developer
