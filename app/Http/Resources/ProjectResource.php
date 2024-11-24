<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'name'=> $this->name,
            'status'=> $this->status,
            'description'=> $this->description,
            'exp_delivery_date'=> $this->exp_delivery_date,
            'delivery_date'=> $this->delivery_date,
            'portfolio_id'=> $this->portfolio_id,
            'user_id'=> $this->user_id,
            'section_id'=> $this->section_id,
        ];
    }
}
