<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProjectWithCommRateCollection extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'data' => $this->collection->map(function ($item) {
                return $item->only(['name', 'status', 'description', 'exp_delivery_date', 'delivery_date', 'client_id', 'freelancer_id', 'section_id', 'independent_attachments', 'customer_attachments']) + [
                    'rate' => $item->reviews->map(function ($comment) {
                        return $comment->only(['rate']);
                    }),                    'comments' => $item->comments->map(function ($comment) {
                        return $comment->only(['text']);
                    }),                ];
            }),

         

        ];
    }
}
