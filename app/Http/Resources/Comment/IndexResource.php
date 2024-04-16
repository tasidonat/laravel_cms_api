<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $status = [
            'approved' => 100,
            'denied' => 50,
            'pendding' => 0
        ];

        return [
            'id' => $this->id,
            'post' => $this->post,
            'name' => $this->name,
            'email' => $this->email,
            'content' => $this->content,
            'status' => array_search($this->status, $status),
            'created_at' => $this->created_at
        ];
    }
}
