@extends('admin.layout')

@section('content')
<h4 class="fw-bold mb-4">Users</h4>
<div class="card stat-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Projects</th>
                    <th>Assigned Tasks</th>
                    <th>Joined</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td class="fw-semibold">{{ $user->name }}</td>
                    <td class="text-muted">{{ $user->email }}</td>
                    <td><span class="badge bg-primary">{{ $user->projects_count }}</span></td>
                    <td><span class="badge bg-warning text-dark">{{ $user->assigned_tasks_count }}</span></td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No users yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection