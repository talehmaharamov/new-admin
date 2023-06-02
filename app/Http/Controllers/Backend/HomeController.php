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
        $langFiles = [
            'en' => resource_path('lang/en/backend.php'),
            'ru' => resource_path('lang/ru/backend.php'),
            'az' => resource_path('lang/az/backend.php'),
        ];
        $keys = [];
        foreach ($langFiles as $lang => $file) {
            $translations = require $file;
            if (empty($keys)) {
                $keys = array_keys($translations);
                continue;
            }
            $keys = array_diff($keys, array_keys($translations));
        }
        echo "Keys that exist in the first language file but not in the others:" . PHP_EOL;
        foreach ($keys as $key) {
            echo "- $key" . PHP_EOL;
        }

//        return view('backend.dashboard', get_defined_vars());
    }

    public function deletePhoto($modelName, $id)
    {
        checkPermission(Str::lower($modelName) . ' delete');
        CRUDHelper::remove_item('\App\Models\\' . $modelName . 'Photos', $id);
    }
}
