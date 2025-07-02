<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemoApiController extends Controller
{
    protected $fakeData = [
        1 => ['id' => 1, 'name' => 'Test One'],
        2 => ['id' => 2, 'name' => 'Test Two'],
    ];

    public function index()
    {
        return response()->json(array_values($this->fakeData));
    }

    public function store(Request $request)
    {
        return response()->json([
            'message' => 'Resource created successfully',
            'data' => $request->all()
        ], 201);
    }

    public function show($id)
    {
        return response()->json(['id' => $id, 'name' => "Test #$id"]);
    }

    public function update(Request $request, $id)
    {
        return response()->json([
            'message' => 'Resource updated',
            'id' => $id,
            'data' => $request->all()
        ]);
    }

    public function destroy($id)
    {
        return response()->json([
            'message' => 'Resource deleted',
            'id' => $id
        ]);
    }
}
