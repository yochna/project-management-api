@extends('admin.layout')

@section('content')
<h4 class="fw-bold mb-4">Projects</h4>
<div class="card stat-card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Owner</th>
                    <th>Tasks</th>
                    <th>Created</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr>
                    <td>{{ $project->id }}</td>
                    <td class="fw-semibold">{{ $project->title }}</td>
                    <td class="text-muted">{{ Str::limit($project->description, 50) }}</td>
                    <td>{{ $project->owner->name }}</td>
                    <td><span class="badge bg-secondary">{{ $project->tasks->count() }}</span></td>
                    <td>{{ $project->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center text-muted py-4">No projects yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection