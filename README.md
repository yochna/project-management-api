# Project Management System — API + Admin Panel

A RESTful API and Admin Panel built with Laravel 13 + Sanctum for managing projects and tasks.

## Tech Stack
- Laravel 13
- Laravel Sanctum (API Token Auth)
- SQLite
- Blade + Bootstrap 5 (Admin Panel)

## Setup Instructions

git clone https://github.com/yochna/laravel
cd laravel
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve

## API Authentication

All protected routes require these headers:
Authorization: Bearer <token>
Accept: application/json
Content-Type: application/json

## API Endpoints

### Auth
POST   /api/register       Register new user
POST   /api/login          Login
POST   /api/logout         Logout (auth required)

### Projects
GET    /api/projects               List all projects
POST   /api/projects               Create project
GET    /api/projects/{id}          Show project with tasks
PUT    /api/projects/{id}          Update project (owner only)
DELETE /api/projects/{id}          Delete project (owner only)

### Tasks
GET    /api/projects/{id}/tasks               List tasks
POST   /api/projects/{id}/tasks               Create task
GET    /api/projects/{id}/tasks/{taskId}      Show task
PUT    /api/projects/{id}/tasks/{taskId}      Update task
DELETE /api/projects/{id}/tasks/{taskId}      Delete task

### Task Filters
?status=pending
?status=in-progress
?status=completed
?assigned_to={user_id}
?due_date=YYYY-MM-DD

## Authorization Rules
- Only project owner can update or delete a project
- Only assigned user or project owner can update a task
- Only project owner can delete a task

## Admin Panel
Visit /admin/login in the browser and login with any registered user credentials.

Features:
- Dashboard with stats
- Users list
- Projects list
- Tasks list with filters

## Assumptions
- All authenticated users can view all projects and tasks
- Tasks are scoped under their parent project
- Admin panel uses session auth, API uses token auth
- Tokens do not expire by default
