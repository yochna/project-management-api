@extends('admin.layout')

@section('content')
<h4 class="fw-bold mb-4">Dashboard</h4>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card stat-card p-3">
            <div class="text-muted small">Total Users</div>
            <div class="fs-2 fw-bold text-primary">{{ $totalUsers }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3">
            <div class="text-muted small">Total Projects</div>
            <div class="fs-2 fw-bold text-success">{{ $totalProjects }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3">
            <div class="text-muted small">Total Tasks</div>
            <div class="fs-2 fw-bold text-warning">{{ $totalTasks }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card stat-card p-3">
            <div class="text-muted small">Completed Tasks</div>
            <div class="fs-2 fw-bold text-info">{{ $completedTasks }}</div>
        </div>
    </div>
</div>

<div class="card stat-card p-4">
    <h6 class="fw-bold mb-3">Task Status Breakdown</h6>
    <div class="d-flex gap-3">
        <span class="badge badge-pending px-3 py-2">Pending: {{ $pendingTasks }}</span>
        <span class="badge badge-in-progress px-3 py-2">In Progress: {{ $inProgressTasks }}</span>
        <span class="badge badge-completed px-3 py-2">Completed: {{ $completedTasks }}</span>
    </div>
</div>
@endsection