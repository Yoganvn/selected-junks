<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'detail' => [
                'brand' => $this->brand,
                'size' => $this->size,
                'condition' => $this->condition,
                'is_fullset' => $this->is_fullset ? 'Yes' : 'No', // Format text
            ],
            'price' => [
                'raw' => $this->price,
                'formatted' => 'Rp ' . number_format($this->price, 0, ',', '.'),
            ],
            'image_url' => $this->image ? url('storage/' . $this->image) : null,
            'description' => $this->description,
            'status' => $this->status,
            'posted_at' => $this->created_at->format('d F Y'),
        ];
    }
}