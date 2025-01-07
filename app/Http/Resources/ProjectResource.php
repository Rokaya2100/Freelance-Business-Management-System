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
            'name'=> $this->name,
            'status'=> $this->status,
            'description'=> $this->description,
            'exp_delivery_date'=> $this->exp_delivery_date,
            'delivery_date'=> $this->delivery_date,
            'portfolio_id'=> $this->portfolio_id,
            'client_id'=> $this->client_id,
            'freelancer_id'=> $this->freelancer_id,
            'section_id'=> $this->section_id,
            'independent_attachments'=> $this->independent_attachments,
            'customer_attachments'=> $this->customer_attachments,
        ];
    }
}
