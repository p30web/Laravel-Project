<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => ($this->name == 'null' || empty($this->name) ? null : $this->name),
            'family' => ($this->family == 'null' || empty($this->family) ? null : $this->family),
            'phone' => $this->phone_number,
            'email' => $this->email,
            'code_melli' => $this->code_melli,
            'adress' => $this->adress,
            'paswd' => ($this->password ? true : false)
        ];
    }
}
