<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: "Product",
    title: "Product",
    description: "A product with attributes, relationships and links",
    type: "object",
    properties: [
        new OA\Property(property: "id", type: "integer", example: 1),
        new OA\Property(property: "type", type: "string", example: "product"),
        new OA\Property(
            property: "attributes",
            type: "object",
            properties: [
                new OA\Property(property: "name", type: "string", example: "Newton Brakus"),
                new OA\Property(property: "price", type: "number", format: "float", example: 63.52),
                new OA\Property(property: "stock", type: "integer", example: 43),
                new OA\Property(property: "status", type: "string", example: "active"),
                new OA\Property(property: "image", type: "string", example: "https://via.placeholder.com/640x480.png/00dddd?text=non"),
                new OA\Property(property: "createdAt", type: "string", format: "date-time", example: "2025-01-31T14:44:29.000000Z"),
                new OA\Property(property: "updatedAt", type: "string", format: "date-time", example: "2025-01-31T14:44:29.000000Z"),
            ]
        ),
        new OA\Property(
            property: "relationships",
            type: "object",
            properties: [
                new OA\Property(
                    property: "category",
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer", example: 2),
                        new OA\Property(property: "type", type: "string", example: "product_category"),
                        new OA\Property(
                            property: "attributes",
                            type: "object",
                            properties: [
                                new OA\Property(property: "name", type: "string", example: "Electronics"),
                            ]
                        ),
                        new OA\Property(
                            property: "links",
                            type: "object",
                            properties: [
                                new OA\Property(property: "self", type: "string", example: "http://api-test.test/api/v1/product-categories/2"),
                            ]
                        ),
                    ]
                ),
                new OA\Property(
                    property: "owner",
                    type: "object",
                    properties: [
                        new OA\Property(property: "id", type: "integer", example: 1),
                        new OA\Property(property: "type", type: "string", example: "user"),
                        new OA\Property(
                            property: "attributes",
                            type: "object",
                            properties: [
                                new OA\Property(property: "name", type: "string", example: "Name"),
                                new OA\Property(property: "email", type: "string", example: "name@email.com"),
                            ]
                        ),
                        new OA\Property(
                            property: "links",
                            type: "object",
                            properties: [
                                new OA\Property(property: "self", type: "string", example: "http://api-test.test/api/v1/users/1"),
                            ]
                        ),
                    ]
                ),
            ]
        ),
        new OA\Property(
            property: "links",
            type: "object",
            properties: [
                new OA\Property(property: "self", type: "string", example: "http://api-test.test/api/v1/products/1"),
            ]
        ),
    ]
)]
class ProductSchema
{
    //
}
