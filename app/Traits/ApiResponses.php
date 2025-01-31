<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponses
{

    protected function ok($message, $data = null)
    {
        return $this->success($message, $data, 200);
    }

    /**
     * Return a success JSON response.
     *
     * @param string $message
     * @param mixed $data
     * @param int $status
     * @return JsonResponse
     */
    public function success(string $message, $data = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }

    /**
     * Return an error JSON response.
     *
     * @param string $message
     * @param mixed $data
     * @param int $status
     * @return JsonResponse
     */
    public function error(string $message, $data = null, int $status = 400): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $data
        ], $status);
    }
}
