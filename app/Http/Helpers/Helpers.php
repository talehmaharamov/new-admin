<?php
////if (!function_exists('creation')) {
////    function creation($name, $modelName = null, $translateModel = false, $photoModel = false)
////    {
////        Artisan::call('make:controller Backend/' . $name . 'Controller --resource');
////        Artisan::call('create-status-route ' . Str::lower($name) . ' ' . $name);
////        Artisan::call('create-delete-route ' . Str::lower($name) . ' ' . $name);
////        Artisan::call('create-resource-route ' . Str::lower($name) . ' ' . $name);
////        Artisan::call('fill-controller:functions ' . $name);
////        Artisan::call('fill-api-controller ' . $name);
////
////        $permissionSeederCommand = "sed -i \"s/\\\$permissions = \\\[/\\\$permissions = \\\[\\n        '" . Str::lower($name) . "',/\" database/seeders/PermissionsSeeder.php";
////        exec($permissionSeederCommand);
////        if ($modelName != null) {
////            Artisan::call('make:model ' . $modelName . ' -m');
////            Artisan::call('main-model ' . $modelName);
////        }
////        if ($translateModel) {
////            Artisan::call('make:model ' . $modelName . 'Translation -m');
////            Artisan::call('translation-model ' . $modelName . 'Translation');
////        }
////        if ($photoModel) {
////            Artisan::call('make:model ' . $modelName . 'Photos -m');
////            Artisan::call('photo-model ' . $modelName . 'Photos');
////        }
////        addPermission(Str::lower($name));
////        Artisan::call('app:create-blade ' . Str::lower($name));
////        Artisan::call('translation:add ' . Str::lower($name));
////    }
////}
use App\Models\SiteLanguage;
use App\Models\Setting;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\File;

function uploadImage(string $path, $file): string
{
    try {
        $imagePath = public_path('images/' . $path);

        if (!File::isDirectory($imagePath)) {
            File::makeDirectory($imagePath, 0777, true, true);
        }

        $filename = uniqid() . '.webp';
        resizeAndSaveImage($file, $imagePath . '/' . $filename);

        return 'images/' . $path . '/' . $filename;
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
}

function resizeAndSaveImage($file, $path): void
{
    Image::make($file)->resize(null, 800, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    })->encode('webp', 75)->save($path, 60);
}

function uploadPDF($file): string
{
    try {
        $extension = $file->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        $file->move('pdf', $filename);

        return 'pdf/' . $filename;
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
}

function uploadMultipleImages(string $path, array $files): array
{
    try {
        $imagePath = public_path('images/' . $path);
        $result = [];

        if (!File::isDirectory($imagePath)) {
            File::makeDirectory($imagePath, 0777, true, true);
        }

        foreach ($files as $file) {
            $filename = uniqid() . '.webp';
            resizeAndSaveImage($file, $imagePath . '/' . $filename);
            $result[] = "images/$path/$filename";
        }

        return $result;
    } catch (Exception $e) {
        throw new Exception($e->getMessage());
    }
}

function checkPermission(string $permissionName)
{
    abort_if(Gate::denies($permissionName), Response::HTTP_FORBIDDEN, '403 Forbidden');
}

function deleteLink(string $route, $id): string
{
    return '<a class="btn btn-danger" href="' . route($route, ['id' => $id]) . '"><i class="fas fa-trash"></i></a>';
}

function editLink(string $route, $parameter1, $parameter2): string
{
    return '<a class="btn btn-primary" href="' . route($route, [$parameter1 => $parameter2]) . '"><i class="fas fa-edit"></i></a>';
}

function statusLink(string $route, $value): string
{
    $isChecked = ($value->status == 1) ? 'checked' : '';
    return '<a href="' . route($route, ['id' => $value->id]) . '" >
        <input ' . $isChecked . ' type="checkbox" id="switch" switch="primary" />
        <label for="switch4"></label></a>';
}

function addPermission(string $permissionName)
{
    try {
        $permissionExtensions = ['index', 'create', 'edit', 'delete'];

        foreach ($permissionExtensions as $extension) {
            $permission = new \Spatie\Permission\Models\Permission();
            $permission->name = $permissionName . ' ' . $extension;
            $permission->group_name = $permissionName;
            $permission->guard_name = 'admin';
            $permission->save();
        }
    } catch (Exception $exception) {
        throw new Exception($exception->getMessage());
    }
}

function getActiveLanguages()
{
    return SiteLanguage::where('status', 1)->get();
}

function getSetting(string $name)
{
    return Setting::where('name', $name)->value('link');
}

function validationResponse(string $name): string
{
    return '<div class="valid-feedback">' . __($name) . ' ' . __('messages.is-correct') . '</div><div class="invalid-feedback">' . __($name) . ' ' . __('messages.not-correct') . '</div>';
}

function convertNumber(int $value): string
{
    if ($value >= 1000 && $value < 1000000) {
        return round($value / 1000, 0) . 'k';
    }
    if ($value >= 1000000) {
        return round($value / 1000000, 0) . 'M';
    } else {
        return (string)$value;
    }
}

function findUniqueTranslationKeys()
{
    $languages = array_diff(scandir(resource_path('lang')), ['.', '..']);
    $uniqueKeys = [];

    foreach ($languages as $lang) {
        $keys = include resource_path("lang/{$lang}/backend.php");
        foreach ($languages as $otherLang) {
            if ($otherLang !== $lang) {
                $otherKeys = include resource_path("lang/{$otherLang}/backend.php");
                $uniqueKeys[$lang][$otherLang] = array_diff_key($keys, $otherKeys);
            }
        }
    }
    return $uniqueKeys;
}
