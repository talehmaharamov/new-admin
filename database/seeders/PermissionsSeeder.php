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
            addPermission($permission);
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
            $singPer = new \Spatie\Permission\Models\Permission();
            $singPer->name = $single;
            list($group) = explode(' ', $single);
            $singPer->group_name = $group;
            $singPer->guard_name = 'admin';
            $singPer->save();


        }
    }
}
