<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Controller;
use App\Http\Requests\Update\InformationPasswordRequest as PasswordRequest;
use App\Models\Admin;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InformationController extends Controller
{
    public function index()
    {
        return view('backend.system.informations.index', get_defined_vars());
    }

    public function update(Request $request, $id)
    {
        try {
            Admin::find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            alert()->error(__('messages.error'));
            return redirect()->back();
        }
    }

    public function store(PasswordRequest $request)
    {
        try {
            Admin::find($request->id)->update([
                'password' => Hash::make($request->password),
            ]);
            alert()->success(__('messages.success'));
            return redirect()->back();
        } catch (Exception $e) {
            alert()->error(__('messages.error') . $e);
            return redirect()->route('backend.system.informations.index');
        }
    }
}
