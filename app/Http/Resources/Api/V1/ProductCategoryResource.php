<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{

    protected $wrapper = 'product_category';
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'product_category',
            'attributes' => [
                'name' => $this->name,
                $this->mergeWhen(
                    $request->routeIs('product-categories.*'),
                    [
                        'description' => $this->description,
                        'createdAt' => $this->created_at,
                        'updatedAt' => $this->updated_at,
                    ],
                ),
            ],
            'links' => [
                'self' => route('product-categories.show', ['product_category' => $this->id]),
            ],
        ];
    }
}
