<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InquiryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reference' => sprintf('CG-%s-%04d', $this->created_at ? $this->created_at->format('Y') : date('Y'), $this->id),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'event_type' => $this->event_type,
            'estimated_guests' => $this->estimated_guests,
            'event_date' => $this->event_date ? $this->event_date->format('Y-m-d') : null,
            'status' => $this->status,
            'created_at' => $this->created_at ? $this->created_at->toIso8601String() : null,
        ];
    }
}
