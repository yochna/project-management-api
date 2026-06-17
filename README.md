# Project Management System - API + Admin Panel

A RESTful API and Admin Panel built with Laravel 13 + Sanctum.

## Tech Stack
- Laravel 13
- Laravel Sanctum (API Token Auth)
- SQLite
- Blade + Bootstrap 5 (Admin Panel)
- PHPUnit (16 tests passing)

## Setup Instructions

git clone https://github.com/yochna/project-management-api
cd project-management-api
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve

## API Endpoints

### Auth
POST   /api/register
POST   /api/login
POST   /api/logout

### Projects
GET    /api/projects
POST   /api/projects
GET    /api/projects/{id}
PUT    /api/projects/{id}
DELETE /api/projects/{id}

### Tasks
GET    /api/projects/{id}/tasks
POST   /api/projects/{id}/tasks
GET    /api/projects/{id}/tasks/{taskId}
PUT    /api/projects/{id}/tasks/{taskId}
DELETE /api/projects/{id}/tasks/{taskId}

### Task Filters
?status=pending|in-progress|completed
?assigned_to={user_id}
?due_date=YYYY-MM-DD

## Authorization Rules
- Only project owner can update or delete a project
- Only assigned user or project owner can update a task
- Only project owner can delete a task

## Admin Panel
Visit /admin/login in browser.
Login with any registered user credentials.
Features: Dashboard, Projects, Tasks, Users

## Tests
php artisan test
16 tests, 36 assertions - all passing

## Assumptions
- All authenticated users can view all projects and tasks
- Tasks scoped under parent project
- Admin panel uses session auth, API uses token auth
- Tokens do not expire by default
