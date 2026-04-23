<?php

namespace App\Trait;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

trait ApiResponseTrait
{
    public function successResponse($data, $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $data,
        ], $code);
    }

    public function notFoundResponse($message = 'Not Found', $code = 200)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $code);
    }

    /**
     * Sahifalangan ro‘yxat javobi. `data` — joriy sahifa elementlari, `meta` — paginator haqida.
     */
    public function paginatedSuccessResponse(LengthAwarePaginator $paginator, int $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => 'success',
            'data' => $paginator->items(),
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
        ], $code);
    }
}

