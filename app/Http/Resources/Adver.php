<?php

namespace App\Http\Resources;

use App\Brand;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\BrandController;
use App\Models;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Adver extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $brand = new BrandController();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'brand' => $this->brand_id,
            'model' => $this->model_id,
            'sale' => new Sale($this->sale),
            'expert' => new Expert($this->expert),
            'images' => AdverImage::collection($this->images),
        ];
    }

}
