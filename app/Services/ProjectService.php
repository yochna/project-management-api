<?php

namespace App\Services;

use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectService
{
    public function getAll()
    {
        return Project::with(['owner', 'tasks'])->get();
    }

    public function create(array $data): Project
    {
        return Project::create([
            'title'       => $data['title'],
            'description' => $data['description'] ?? null,
            'created_by'  => Auth::id(),
        ]);
    }

    public function update(Project $project, array $data): Project
    {
        $project->update($data);
        return $project->fresh();
    }

    public function delete(Project $project): void
    {
        $project->delete();
    }
}