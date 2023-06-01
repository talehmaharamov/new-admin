<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Controller;
use App\Http\Helpers\CRUDHelper;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        check_permission('permissions index');
        $permissions = Permission::all();
        $permissionGroups = Permission::where('guard_name', 'admin')->get()->groupBy('group_name');
        return view('backend.system.permissions.index', get_defined_vars());
    }

    public function create()
    {
        check_permission('permissions create');
        return view('backend.system.permissions.create');
    }

    public function store(Request $request)
    {
        check_permission('permissions create');
        try {
            foreach ($request->name as $n) {
                Permission::create([
                    'name' => $request->permissionName . ' ' . $n,
                    'group_name' => $request->permissionName,
                    'guard_name' => $request->guardName,
                ]);
            }
            alert()->success(__('messages.add-success'));
            return redirect()->route('system.permissions.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('system.permissions.index');
        }
    }

    public function edit(Permission $permission)
    {
        check_permission('permissions edit');
        return view('backend.system.permissions.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        check_permission('permissions edit');
        try {
            Permission::find($id)->update([
                'name' => $request->name,
                'guard_name' => $request->guardName,
            ]);
            alert()->success(__('messages.success'));
            return redirect()->route('system.permissions.index');
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('system.permissions.index');
        }
    }

    public function giveUserPermission(Admin $user)
    {
        check_permission('permissions create');
        $permissions = Permission::where('guard_name', 'admin')->orderBy('name', 'asc')->get();
        $permissionGroups = Permission::where('guard_name', 'admin')->get()->groupBy('group_name');
        return view('backend.system.permissions.give-user', get_defined_vars());
    }

    public function giveUserPermissionUpdate(Request $request)
    {
        check_permission('permissions create');
        $admin = Admin::find($request->id);
        try {
            DB::transaction(function () use ($request, $admin) {
                $admin->syncPermissions($request->permissions);
            });
            alert()->success(__('messages.success'));
            return redirect()->route('system.giveUserPermission', $admin->id);
        } catch (Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->route('system.giveUserPermission', $admin->id);
        }
    }
    public function delete($id)
    {
        check_permission('permissions delete');
        return CRUDHelper::remove_item('\Spatie\Permission\Models\Permission', $id);
    }
}
