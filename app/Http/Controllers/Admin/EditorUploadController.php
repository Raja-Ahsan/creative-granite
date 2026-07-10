<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EditorUploadController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'file' => ['required', 'image', 'max:10240'],
        ]);

        $path = $request->file('file')->store('editor/services', 'public');

        return response()->json([
            'location' => '/storage/'.$path,
        ]);
    }
}
