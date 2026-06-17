<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Services\ProjectService;

class ProjectController extends Controller
{
    public function __construct(protected ProjectService $service) {}

    public function index()
    {
        return ProjectResource::collection($this->service->getAll());
    }

    public function store(StoreProjectRequest $request)
    {
        $project = $this->service->create($request->validated());
        return new ProjectResource($project->load(['owner', 'tasks']));
    }

    public function show(Project $project)
    {
        return new ProjectResource($project->load(['owner', 'tasks']));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);
        $project = $this->service->update($project, $request->validated());
        return new ProjectResource($project->load(['owner', 'tasks']));
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $this->service->delete($project);
        return response()->json(['message' => 'Project deleted successfully']);
    }
}