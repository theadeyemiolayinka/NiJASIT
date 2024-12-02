<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'abstract' => $this->abstract,
            'citation' => $this->citation,
            'keywords' => $this->keywords,
            'authors' => $this->authors,
            'file' => $this->file,
            'cover' => $this->cover,
            'references' => $this->references,
            'affiliations' => $this->affiliations,
            'funding' => $this->funding,
            'acknowledgements' => $this->acknowledgements,
            'conflicts' => $this->conflicts,
            'data_availability' => $this->data_availability,
            'license' => $this->license,
            'doi' => $this->doi,
            'published_at' => $this->published_at,
            'status' => $this->status,
            'user_id' => $this->user_id,
            'issue_id' => $this->issue_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
