<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'title' => $this->title,
            'description' => Str::limit($this->description, 100),
            'category_name' => \optional($this->category)->name ?? 'Unknown Category',

        ];
    }
}
