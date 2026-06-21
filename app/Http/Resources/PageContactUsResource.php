<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageContactUsResource extends JsonResource
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
            'phone_one' => $this->phone_one,
            'phone_two' => $this->phone_two,
            'work_hours' => $this->work_hours,
            'email' => $this->email,
            'active' => $this->active,

            'imageUrl' => $this->getFirstMediaUrl(),
            'image' => $this->getFirstMediaResource(),
        ];
    }
}
