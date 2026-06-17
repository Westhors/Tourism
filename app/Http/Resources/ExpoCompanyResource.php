<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpoCompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'subTitle' => $this->sub_title ?? null,
            'active' => $this->active ?? null,
            'linkDrive' => $this->link_drive ?? null,
            'imageUrl' => $this->getFirstMediaUrlTeam(),
            'image' => new MediaResource($this->getFirstMedia()),
        ];
    }
}
