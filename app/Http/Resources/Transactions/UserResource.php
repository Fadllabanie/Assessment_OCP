<?php

namespace App\Http\Resources\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Users\Profiles\ProfileRoleResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'code' => $this->code,
            'email' => $this->email,
            'balance' => $this->balance,
            'currency' => $this->currency,

        ];
    }
}
