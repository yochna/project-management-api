<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private function actingWithToken(User $user): array
    {
        $token = $user->createToken('auth_token')->plainTextToken;
        return ['Authorization' => 'Bearer ' . $token];
    }

    public function test_user_can_create_task(): void
    {
        $user    = User::factory()->create();
        $headers = $this->actingWithToken($user);
        $project = Project::factory()->create(['created_by' => $user->id]);

        $response = $this->postJson("/api/projects/{$project->id}/tasks", [
            'title'       => 'Test Task',
            'description' => 'Task description',
            'due_date'    => '2026-12-01',
        ], $headers);

        $response->assertStatus(201)
                 ->assertJsonStructure(['data' => ['id', 'title', 'status']]);
    }

    public function test_user_can_list_tasks(): void
    {
        $user    = User::factory()->create();
        $headers = $this->actingWithToken($user);
        $project = Project::factory()->create(['created_by' => $user->id]);

        $response = $this->getJson("/api/projects/{$project->id}/tasks", $headers);

        $response->assertStatus(200)
                 ->assertJsonStructure(['data']);
    }

    public function test_task_status_can_be_updated(): void
    {
        $user    = User::factory()->create();
        $headers = $this->actingWithToken($user);
        $project = Project::factory()->create(['created_by' => $user->id]);
        $task    = Task::factory()->create([
            'project_id'  => $project->id,
            'assigned_to' => $user->id,
        ]);

        $response = $this->putJson("/api/projects/{$project->id}/tasks/{$task->id}", [
            'status' => 'in-progress',
        ], $headers);

        $response->assertStatus(200)
                 ->assertJsonPath('data.status', 'in-progress');
    }

    public function test_tasks_can_be_filtered_by_status(): void
    {
        $user    = User::factory()->create();
        $headers = $this->actingWithToken($user);
        $project = Project::factory()->create(['created_by' => $user->id]);
        Task::factory()->create(['project_id' => $project->id, 'status' => 'pending']);
        Task::factory()->create(['project_id' => $project->id, 'status' => 'completed']);

        $response = $this->getJson("/api/projects/{$project->id}/tasks?status=pending", $headers);

        $response->assertStatus(200);
        $data = $response->json('data');
        $this->assertTrue(collect($data)->every(fn($t) => $t['status'] === 'pending'));
    }
}
