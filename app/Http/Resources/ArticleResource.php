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
            'category'=>$this->category,
            'title' => $this->title,
            'summary' => $this->description,
            'content' => $this->content,
            'author' => $this->author ?? 'Unknown',
            'source' => $this->source_name,
            'image' => $this->image_url,
            'link' => $this->url,
            'published' => date('Y-m-d,h:i',strtotime($this->published_at)),
        ];
    }
}
