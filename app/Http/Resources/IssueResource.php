<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IssueResource extends JsonResource
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
            'description' => $this->description,
            'volume' => $this->volume,
            'number' => $this->number,
            'year' => $this->year,
            'month' => $this->month,
            'cover' => $this->cover,
            'doi' => $this->doi,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'articles' => ArticleResource::collection($this->whenLoaded('articles')),
        ];
    }
}
