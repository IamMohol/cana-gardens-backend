<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        return response()->json(['message' => 'Inquiry received']);
    }
}
