<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'long_description' => $this->long_description,
            'active' => $this->active,

            'imageUrl' => $this->getFirstMediaUrl(),
            'image' => $this->getFirstMediaResource(),
            'sliderImageUrl' => $this->getFirstMediaUrl('slider_image') ?: null,
            'sliderImage' => $this->getFirstMediaResource('slider_image') ?: null,
            'gallery' => $this->getMediaResource('gallery') ?: null,
        ];
    }
}
