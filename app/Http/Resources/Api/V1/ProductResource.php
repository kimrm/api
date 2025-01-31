<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\V1\ProductCategoryResource;

class ProductResource extends JsonResource
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
            'type' => 'product',
            'attributes' => [
                'name' => $this->name,
                'description' => $this->when(
                    $request->routeIs('*.show'),
                    $this->description
                ),
                'price' => $this->price,
                'stock' => $this->stock,
                'status' => $this->status,
                'image' => $this->image,
                'createdAt' => $this->created_at,
                'updatedAt' => $this->updated_at,
            ],
            'relationships' => [
                'category' => new ProductCategoryResource($this->category),
                'owner' => new UserResource($this->owner),
            ],
            'links' => [
                'self' => route('products.show', ['product' => $this->id]),
            ],
        ];
    }
}
