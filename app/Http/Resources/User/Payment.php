<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class Payment extends JsonResource
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
            'amount' => $this->amount,
            'type' => $this->payment_type,
            'details' => $this->when($this->details , json_decode($this->details , JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)),
            'transactionId' => $this->transactionId,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
