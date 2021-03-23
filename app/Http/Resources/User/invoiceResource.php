<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class invoiceResource extends JsonResource
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
            'name_family' => $this->name_family,
            'status' => $this->status,
            'total_amount' => $this->total_amount,
            'time' => $this->created_at,
            'expert' => new Expert($this->expert),
            'payments' =>new PaymentCollection($this->payments),
        ];
    }
}
