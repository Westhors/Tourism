<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name ?? '',
            // 'slug' => $this->slug ?? '',
            'des' => $this->des ?? '',
            'active' => $this->active ?? '',
            // 'position' => $this->position ?? '',
            'deleted' => isset($this->deleted_at),
            'deletedAt' => $this->deleted_at ? $this->deleted_at->format('Y-M-d H:i:s A') : null,
            'createdAt' => $this->created_at ? $this->created_at->format('Y-M-d H:i:s A') : null,
            'updatedAt' => $this->updated_at ? $this->updated_at->format('Y-M-d H:i:s A') : null,
        ];
    }
}
