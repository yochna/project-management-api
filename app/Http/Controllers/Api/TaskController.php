<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Project;
use App\Models\Task;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function __construct(protected TaskService $service) {}

    public function index(Project $project)
    {
        $tasks = $this->service->getTasksForProject($project, request()->only('status', 'assigned_to', 'due_date'));
        return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request, Project $project)
    {
        $this->authorize('create', Task::class);
        $task = $this->service->create($project, $request->validated());
        return new TaskResource($task->load('assignee'));
    }

    public function show(Project $project, Task $task)
    {
        return new TaskResource($task->load('assignee'));
    }

    public function update(UpdateTaskRequest $request, Project $project, Task $task)
    {
        $this->authorize('update', $task);
        $task = $this->service->update($task, $request->validated());
        return new TaskResource($task->load('assignee'));
    }

    public function destroy(Project $project, Task $task)
    {
        $this->authorize('delete', $task);
        $this->service->delete($task);
        return response()->json(['message' => 'Task deleted successfully']);
    }
}