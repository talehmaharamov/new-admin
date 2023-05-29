<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class CreationController extends Controller
{
    public function index()
    {
        return view('backend.system.creation.index');
    }

    public function store(Request $request)
    {
        if ($request->backendController == 1) {
            Artisan::call('fill-controller:functions ' . $request->name);
        }
        if ($request->frontendController == 1) {
            Artisan::call('fill-frontend-controller: ' . $request->name);
        }
        if ($request->apiController == 1) {
            Artisan::call('fill-api-controller ' . $request->name);
        }
//        if ($request->){
//
//        }
    }
}
