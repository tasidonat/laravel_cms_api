<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
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
            'category' => $this->category,
            'author' => $this->user,
            'title' => $this->title,
            'thumbnail' => $this->thumbnail,
            'content' => $this->content,
            'status' => $this->status,
            'created_at' => $this->created_at
        ];;
    }
}
