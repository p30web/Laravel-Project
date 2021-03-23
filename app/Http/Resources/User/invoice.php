<?php

namespace App\Http\Resources\User;

use App\Http\Resources\ExpertProperties;
use Illuminate\Http\Resources\Json\JsonResource;
use Storage;

class invoice extends JsonResource
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
            'name_family' => $this->when($this->name_family, $this->name_family),
            'status' => $this->status,
            'total_amount' => $this->total_amount,
            'time' => $this->created_at,
            'expert' => new Expert($this->expert),
//            'payments' => $this->when($flag, new PaymentCollection($this->payments)),
        ];
    }
}
