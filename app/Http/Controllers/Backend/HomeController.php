<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function Sodium\add;

class HomeController extends Controller
{
    public function index()
    {
        return view('backend.dashboard', get_defined_vars());
    }

    public function deletePhoto($modelName, $id)
    {
        check_permission(Str::lower($modelName) . ' delete');
        CRUDHelper::remove_item('\App\Models\\' . $modelName . 'Photos', $id);
    }
}
