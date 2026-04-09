# Mini Task Management System

A web-based Task Management System built with Laravel. Each user can manage their own projects and tasks with full CRUD operations, status filtering, and a dashboard summary.

## Tech Stack
- Laravel 13
- PHP 8.3+
- MySQL
- Blade templates + Tailwind CSS
- Laravel Breeze (session-based authentication)

## Core Features
- User registration, login, and logout
- Project CRUD (create, edit, delete, list)
- Task CRUD under projects
- Task status filtering (`todo`, `in_progress`, `done`)
- Dashboard metrics:
  - Total projects
  - Total tasks
  - Tasks grouped by status
- Authorization with Policies (users can only access their own projects/tasks)
- Server-side validation with Form Requests

## Database Structure
- `users`
- `projects` (`user_id` foreign key)
- `tasks` (`project_id` foreign key)

Relationships:
- User `hasMany` Projects
- Project `hasMany` Tasks
- Task `belongsTo` Project

## Setup Instructions

### 1) Clone and install dependencies
```bash
git clone <your-repo-url>
cd php_task_management
composer install
npm install
```

### 2) Configure environment
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` database values:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=task_manager
DB_USERNAME=your_mysql_user
DB_PASSWORD=your_mysql_password
```

### 3) Run migrations and seed demo data
```bash
php artisan migrate:fresh --seed
```

### 4) Start the application
Run in separate terminals:
```bash
php artisan serve
```
```bash
npm run dev
```

App URL: `http://127.0.0.1:8000`

## Demo Login
- Email: `demo@example.com`
- Password: `password`

## Notes
- If MySQL is not running, start it before migration/seed commands.
- If you use database-backed sessions/cache, ensure migration tables are present.