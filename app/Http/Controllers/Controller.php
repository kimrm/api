<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;


#[
    OA\Info(version: "1.0.0", description: "laravel api", title: "Laravel API Documentation"),
    OA\Server(url: 'http://localhost:8088', description: "local server"),
    OA\SecurityScheme(securityScheme: 'bearerAuth', type: "http", name: "Authorization", in: "header", scheme: "bearer"),
]

abstract class Controller
{
    //
}
