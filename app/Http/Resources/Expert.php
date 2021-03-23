<?php

namespace App\Http\Resources;

use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Resources\Json\JsonResource;
use Facades\App\Repositories\Cache\HealthStatusRepository;
use Storage;

class Expert extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $flag = ($request->has('id') ? true : false);
        return [
//            'plaque' => $this->when($flag, json_decode($this->plaque , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)),
            'location' => $this->location_id,
            'date' =>  Verta::parse($this->created_at)->formatDifference(),
            'status' => $this->status,
            'tracking_code' => $this->tracking_code,
            'health_status' => HealthStatusRepository::find($this->health_status_id,'slug'),
            'details' => $this->when($flag, new ExpertProperties($this)),
            'pdf_link' => $this->when($flag, Storage::disk('file')->url($this->download_pdf_link))
        ];
    }
}
