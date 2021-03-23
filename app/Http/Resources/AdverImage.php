<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Storage;

class AdverImage extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return string
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'link' => Storage::disk('public')->url($this->image_path),
        ];
    }
}
