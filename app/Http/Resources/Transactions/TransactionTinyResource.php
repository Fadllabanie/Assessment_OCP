<?php

namespace App\Http\Resources\Transactions;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Transactions\UserResource;

class TransactionTinyResource extends JsonResource
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
            'paid_amount'=> $this->paid_amount,
            'parent_email'=> $this->parent_email,
            'currency'=> $this->currency,
            'status_code'=> $this->status_code,
            'payment_date'=> $this->payment_date,
            'parent_identification'=> $this->parent_identification,
            'user' => new UserResource($this->user),
          
        ];
    }
}
