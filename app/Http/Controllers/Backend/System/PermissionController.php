<?php

namespace App\Http\Controllers\Backend\System;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\CRUDHelper;
use Illuminate\Http\Request;
use App\Models\Admin;
use Exception;
class PermissionController extends Controller
{
    public function index()
    {
        checkPermission('permissions index');
        $permissions = Permission::all();
        $permissionGroups = Permission::where('guard_name', 'admin')->get()->groupBy('group_name');
        return view('backend.system.permissions.index', get_defined_vars());
    }

    public function create()
    {
        checkPermission('permissions create');
        return view('backend.system.permissions.create');
    }

    public function store(Request $request)
    {
        checkPermission('permissions create');
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
        checkPermission('permissions edit');
        return view('backend.system.permissions.edit', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        checkPermission('permissions edit');
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
        checkPermission('permissions create');
        $permissions = Permission::where('guard_name', 'admin')->orderBy('name', 'asc')->get();
        $permissionGroups = Permission::where('guard_name', 'admin')->get()->groupBy('group_name');
        return view('backend.system.permissions.give-user', get_defined_vars());
    }

    public function giveUserPermissionUpdate(Request $request)
    {
        checkPermission('permissions create');
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
        checkPermission('permissions delete');
        return CRUDHelper::remove_item('\Spatie\Permission\Models\Permission', $id);
    }
}
