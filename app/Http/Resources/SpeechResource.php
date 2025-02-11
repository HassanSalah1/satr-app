<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpeechResource extends JsonResource
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
            'name' => $this->name,
            'author' => $this->author->name ?? null,
            'date' => $this->date,
            'image' => asset('storage/' . $this->image),
            'status' => $this->status,
            'youtube_link' => $this->link,
        ];
    }
}
