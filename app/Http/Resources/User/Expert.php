<?php

namespace App\Http\Resources\User;

use App\Http\Resources\ExpertProperties;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;

class Expert extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $flag = ($request->has('id') ? true : false);
        return [
            'id' => $this->id,
            'brand' => $this->brand_id,
            'model' => $this->model_id,
            'chassisـnumber' => $this->when($this->chassisـnumber, $this->chassisـnumber),
            'tracking_code' => $this->when($this->tracking_code, $this->tracking_code),
            'plaque' => json_decode($this->plaque , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            'reserveTime' => json_decode($this->reserve->reserveDate),
            'location' => $this->location_id,
            'time'=> $this->created_at,
            'status' => $this->status,
            'pdf_link' => $this->when($this->download_pdf_link, Storage::disk('file')->url($this->download_pdf_link)),
            'details' => $this->when($flag, new ExpertProperties($this)),
        ];
    }
}
