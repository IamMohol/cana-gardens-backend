<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return response()->json([
            'hero_slides' => [],
            'feature_highlights' => [],
        ]);
    }
}
