<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            'admin',
            'about',
            'slider',
            'categories',
            'languages',
            'settings',
            'seo-tags',
            'users',
            'permissions',
            'report',
            'news',
            'catalog',
            'media',
            'blog',
            'product',
            'portfolio',
            'service',
        ];
        foreach ($permissions as $permission) {
            add_permission($permission);
        }
        $singlePermissions = [
            'contact index',
            'contact delete',
            'newsletter index',
            'newsletter create',
            'newsletter delete',
            'mail index',
            'mail delete',
            'dodenv index',
        ];
        foreach ($singlePermissions as $single) {
            $permission = new \Spatie\Permission\Models\Permission();
            $permission->name = $single;
            $permission->group_name = explode(' ', $single)[0];
            $permission->guard_name = 'admin';
            $permission->save();
        }
    }
}
