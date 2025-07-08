<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function errorResponse(string $message, $data = [], int $code = 400)
    {
        return response()->json([
            'status'  => 'error',
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    protected function paginateResponse(LengthAwarePaginator $paginator)
    {
        return response()->json([
            'status' => 'success',
            'data'   => $paginator->items(),
            'meta'   => [
                'current_page' => $paginator->currentPage(),
                'last_page'    => $paginator->lastPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
            ],
        ]);
    }
}
