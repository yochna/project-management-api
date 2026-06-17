<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel — Project Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; }
        .sidebar { min-height: 100vh; background: #1e293b; }
        .sidebar a { color: #94a3b8; text-decoration: none; display: block; padding: 10px 20px; border-radius: 6px; margin: 2px 8px; }
        .sidebar a:hover, .sidebar a.active { background: #334155; color: #fff; }
        .sidebar .brand { color: #fff; font-size: 1.2rem; font-weight: 700; padding: 20px; border-bottom: 1px solid #334155; margin-bottom: 10px; }
        .stat-card { border: none; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-in-progress { background: #dbeafe; color: #1e40af; }
        .badge-completed { background: #d1fae5; color: #065f46; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar p-0">
            <div class="brand"><i class="bi bi-kanban me-2"></i>PM Admin</div>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="{{ request()->routeIs('admin.users') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i>Users
            </a>
            <a href="{{ route('admin.projects') }}" class="{{ request()->routeIs('admin.projects') ? 'active' : '' }}">
                <i class="bi bi-folder me-2"></i>Projects
            </a>
            <a href="{{ route('admin.tasks') }}" class="{{ request()->routeIs('admin.tasks') ? 'active' : '' }}">
                <i class="bi bi-check2-square me-2"></i>Tasks
            </a>
            <div style="position:absolute; bottom:20px; width:16%;">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger w-100 mx-2">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </button>
                </form>
            </div>
        </div>
        <div class="col-md-10 p-4">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>