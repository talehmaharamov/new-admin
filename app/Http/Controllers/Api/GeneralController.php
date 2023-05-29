<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\General;

class GeneralController extends Controller
{
    public function index()
    {
        if (General::where('status', 1)->exists()) {
            return response()->json(['general' => General::where('status', 1)->with('photos')->get()], 200);
        } else {
            return response()->json(['general' => 'General-is-empty'], 404);
        }
    }

    public function show($id)
    {
        if (General::where('status', 1)->where('id', $id)->exists()) {
            return response()->json(['general' => General::where('status', 1)->where('id', $id)->first()], 200);
        } else {
            return response()->json(['general' => 'general-is-not-founded'], 404);
        }
    }
}
