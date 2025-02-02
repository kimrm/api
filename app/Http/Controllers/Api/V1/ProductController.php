<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Api\V1\ProductResource;
use OpenApi\Attributes as OA;

class ProductController extends Controller
{

    #[
        OA\Get(
            path: "/api/v1/products",
            summary: "Display a list of products",
            tags: ["Products"],
            responses: [
                new OA\Response(
                    response: 200,
                    description: "List of products",
                    content: new OA\JsonContent(
                        properties: [
                            new OA\Property(
                                property: "data",
                                type: "array",
                                items: new OA\Items(ref: "#/components/schemas/Product")
                            )
                        ]
                    )
                )
            ]
        )
    ]
    /**
     * Display a list of products.
     *      
     */
    public function index()
    {
        return ProductResource::collection(Product::paginate());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    #[OA\Get(
        path: "/api/v1/products/{id}",
        summary: "Display a single product",
        tags: ["Products"],
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                description: "ID of the product",
                schema: new OA\Schema(type: "integer", example: 1)
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Single product details",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "data",
                            ref: "#/components/schemas/Product"
                        )
                    ]
                )
            )
        ]
    )]
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
