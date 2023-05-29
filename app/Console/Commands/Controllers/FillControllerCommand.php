<?php

namespace App\Console\Commands\Controllers;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class FillControllerCommand extends Command
{
    protected $signature = 'fill-controller:functions {controller}';
    public function handle()
    {
        $controllerName = $this->argument('controller');
        Artisan::call('make:controller Backend/' . $controllerName . 'Controller --resource');
        $controllerPath = app_path('Http/Controllers/Backend/' . $controllerName . 'Controller.php');
        $stubPath = base_path('stubs/controllers/backend.stub');
        $content = File::get($stubPath);
        $content = str_replace('$name', Str::lower($controllerName), $content);
        $content = str_replace('$controller', $controllerName, $content);
        if (File::exists($stubPath)) {
            $stubContent = File::get($stubPath);
            File::put($controllerPath, $content);
            $this->info('Controller content replaced with the custom stub.');
        } else {
            $this->error('Custom stub file not found.');
        }
    }
}
