<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Artisan;

class CreationController extends Controller
{
    public function index()
    {
        return view('backend.system.creation.index');
    }

    public function store(Request $request)
    {
        try {
//            if ($request->backendController == 1) {
//                Artisan::call('fill-controller:functions ' . $request->name);
//            }
////            if ($request->frontendController == 1) {
////                Artisan::call('fill-frontend-controller: ' . $request->name);
////            }
//            if ($request->apiController == 1) {
//                Artisan::call('fill-api-controller ' . $request->name);
//            }
//            if ($request->has('mainModel')) {
//                Artisan::call('make:model ' . $request->name . ' -m');
//                $modelName = $request->input('name');
//                $modelPath = app_path('Models/' . $modelName . '.php');
////                $stubPath = ''; // Define a default value for $stubPath
//                if ($request->translationModel == 1 and $request->photoModel == 1) {
//                    $stubPath = base_path('stubs/models/main.stub');
//                    Artisan::call('make:model ' . $request->name . 'Translation -m');
//                    Artisan::call('translation-model ' . ucfirst($request->name));
//                    Artisan::call('make:model ' . $request->name . 'Photos -m');
//                    Artisan::call('photo-model ' . ucfirst($request->name) . 'Photos');
//                } else if ($request->translationModel == 1 and !$request->has('photoModel')) {
//                    $stubPath = base_path('stubs/models/simple/onlytranslation.stub');
//                    Artisan::call('make:model ' . $request->name . 'Translation -m');
//                    Artisan::call('translation-model ' . ucfirst($request->name));
//                } else if ($request->photoModel == 1 and !$request->has('translationModel')) {
//                    $stubPath = base_path('stubs/models/simple/onlyphoto.stub');
//                    Artisan::call('make:model ' . $request->name . 'Photos -m');
//                    Artisan::call('photo-model ' . ucfirst($request->name));
//                }
//                if (!empty($stubPath)) {
//                    $content = File::get($stubPath);
//                    $content = str_replace('$name', Str::lower($modelName), $content);
//                    $content = str_replace('$controller', $modelName, $content);
//                    $stubContent = File::get($stubPath);
//                    File::put($modelPath, $content);
//                }
//            }
//
//            if ($request->has('backendRoute')) {
//                Artisan::call('create-resource-route ' . Str::lower($request->name) . ' ' . $request->name);
//            }
//            if ($request->has('deleteRoute')) {
//                Artisan::call('create-delete-route ' . Str::lower($request->name) . ' ' . $request->name);
//            }
//            if ($request->has('statusRoute')) {
//                Artisan::call('create-status-route ' . Str::lower($request->name) . ' ' . $request->name);
//            }
////        if ($request->has('frontendRoute')) {
////
////        }
//            if ($request->has('backendRoute')) {
//                Artisan::call('create-api-route ' . Str::lower($request->name) . ' ' . $request->name);
//            }
//            addPermission(Str::lower($request->name));
            $permissionSeederPath = database_path('seeders/PermissionsSeeder.php');
            $permissions = File::get($permissionSeederPath);
            $newPermission = "        '" . Str::lower($request->name) . "',";
            $updatedPermissions = str_replace('];', $newPermission . "\n    ];", $permissions);
            File::put($permissionSeederPath, $updatedPermissions);
//            Artisan::call('app:create-blade ' . Str::lower($request->name));
//            Artisan::call('translation:add ' . Str::lower($request->name));
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());

        }
    }
}
