@extends('admin.layout')

@section('content')
<h4 class="fw-bold mb-4">Tasks</h4>

<form method="GET" class="card stat-card p-3 mb-4">
    <div class="row g-2 align-items-end">
        <div class="col-md-4">
            <label class="form-label small">Filter by Status</label>
            <select name="status" class="form-select form-select-sm">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in-progress" {{ request('status') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label small">Filter by User</label>
            <select name="assigned_to" class="form-select form-select-sm">
                <option value="">All Users</option>
                @foreach($users as $user)
                <option value="{{ $user->id }}" {{ request('assigned_to') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-dark btn-sm w-100">Filter</button>
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.tasks') }}" class="btn btn-outline-secondary btn-sm w-100">Reset</a>
        </div>
    </div>
</form>

<div class="card stat-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Project</th>
                    <th>Status</th>
                    <th>Assigned To</th>
                    <th>Due Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td class="fw-semibold">{{ $task->title }}</td>
                    <td>{{ $task->project->title }}</td>
                    <td>
                        @if($task->status == 'pending')
                            <span class="badge badge-pending px-2 py-1">Pending</span>
                        @elseif($task->status == 'in-progress')
                            <span class="badge badge-in-progress px-2 py-1">In Progress</span>
                        @else
                            <span class="badge badge-completed px-2 py-1">Completed</span>
                        @endif
                    </td>
                    <td>{{ $task->assignee?->name ?? '—' }}</td>
                    <td>{{ $task->due_date ? $task->due_date->format('d M Y') : '—' }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No tasks found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection