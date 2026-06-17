<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    private function actingWithToken(User $user): array
    {
        $token = $user->createToken('auth_token')->plainTextToken;
        return ['Authorization' => 'Bearer ' . $token];
    }

    public function test_user_can_create_project(): void
    {
        $user    = User::factory()->create();
        $headers = $this->actingWithToken($user);

        $response = $this->postJson('/api/projects', [
            'title'       => 'Test Project',
            'description' => 'Test Description',
        ], $headers);

        $response->assertStatus(201)
                 ->assertJsonStructure(['data' => ['id', 'title', 'description']]);
    }

    public function test_user_can_list_projects(): void
    {
        $user    = User::factory()->create();
        $headers = $this->actingWithToken($user);

        $response = $this->getJson('/api/projects', $headers);

        $response->assertStatus(200)
                 ->assertJsonStructure(['data']);
    }

    public function test_owner_can_update_project(): void
    {
        $user    = User::factory()->create();
        $headers = $this->actingWithToken($user);
        $project = Project::factory()->create(['created_by' => $user->id]);

        $response = $this->putJson('/api/projects/' . $project->id, [
            'title' => 'Updated Title',
        ], $headers);

        $response->assertStatus(200)
                 ->assertJsonPath('data.title', 'Updated Title');
    }

    public function test_non_owner_cannot_update_project(): void
    {
        $owner   = User::factory()->create();
        $other   = User::factory()->create();
        $headers = $this->actingWithToken($other);
        $project = Project::factory()->create(['created_by' => $owner->id]);

        $response = $this->putJson('/api/projects/' . $project->id, [
            'title' => 'Hacked Title',
        ], $headers);

        $response->assertStatus(403);
    }

    public function test_owner_can_delete_project(): void
    {
        $user    = User::factory()->create();
        $headers = $this->actingWithToken($user);
        $project = Project::factory()->create(['created_by' => $user->id]);

        $response = $this->deleteJson('/api/projects/' . $project->id, [], $headers);

        $response->assertStatus(200);
    }

    public function test_non_owner_cannot_delete_project(): void
    {
        $owner   = User::factory()->create();
        $other   = User::factory()->create();
        $headers = $this->actingWithToken($other);
        $project = Project::factory()->create(['created_by' => $owner->id]);

        $response = $this->deleteJson('/api/projects/' . $project->id, [], $headers);

        $response->assertStatus(403);
    }
}
