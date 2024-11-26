<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
           
            'id'          =>$this->id,
            'project_id'   =>$this->project_id,
            'user_id'      =>$this->user_id,
            'description' =>$this->description,
            'period'      =>$this->period,
            'price'       =>$this->price,
            'status'      =>$this->status,

        ];
    }
}
