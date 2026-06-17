<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'status'      => $this->status,
            'due_date'    => $this->due_date,
            'assigned_to' => new UserResource($this->whenLoaded('assignee')),
            'project_id'  => $this->project_id,
            'created_at'  => $this->created_at,
        ];
    }
}