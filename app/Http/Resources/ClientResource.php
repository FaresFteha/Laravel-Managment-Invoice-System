<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'DD' => $this->id,
            'FN' =>  $this->first_name,
            'LN' =>  $this->last_name,
            'EM' => $this->email,
            'PH' =>  $this->phone,
            'PS' => $this->password,
        ];
    }
}
