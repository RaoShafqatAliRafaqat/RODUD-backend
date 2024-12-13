<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'location' => $this->location,
            'title' => $this->title,
            'size' => $this->size,
            'weight' => $this->weight,
            'pickup_time' => $this->pickup_time,
            'delivery_time' => $this->delivery_time,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by_user' => $this->createdBy,
            'updated_by_user' => $this->updatedBy,
        ];
    }
}
