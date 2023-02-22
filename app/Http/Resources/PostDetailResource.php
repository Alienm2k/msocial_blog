<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
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
            'user_name' => optional($this->user)->name ?? 'Unknown User',
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d h:i:s A'),
            'category_name' => optional($this->category)->name ?? 'Unknown Category',
            'created_at_readable' => Carbon::parse($this->created_at)->diffForHumans(),
            'title' => $this->title,
            'description' => $this->description,
            // 'image_path' => $this->image,// don't give direct
            'image_path' => $this->image ? asset('storage/media/'.$this->image->file_name) : null,
        ];
    }
}
