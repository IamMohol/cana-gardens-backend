<?php

namespace App\Http\Controllers;

class BlogController extends Controller
{
    public function index()
    {
        return response()->json([]);
    }

    public function show($slug)
    {
        return response()->json(['title' => 'Dummy Post', 'content' => 'Dummy Content']);
    }
}
