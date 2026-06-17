<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'created_by'  => new UserResource($this->whenLoaded('owner')),
            'tasks'       => TaskResource::collection($this->whenLoaded('tasks')),
            'created_at'  => $this->created_at,
        ];
    }
}