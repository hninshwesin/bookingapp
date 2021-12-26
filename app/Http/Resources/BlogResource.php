<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'heading' => $this->heading,
            'body' => $this->body,
            'body_trim' => strlen($this->body) > 80 ? Str::substr($this->body, 0, 80) . "..." : $this->body,
            'image' => Storage::url($this->image),
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}
