<?php

namespace App\Http\Controllers\Backend\System;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class AuthController extends Controller
{
    use Authenticatable;

    protected function guard()
    {
        return auth()->guard('admin');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        if ($this->guard()->attempt($request->only(['email', 'password']), $request->remember_me)) {
            $user = auth()->guard('admin')->user();
            $agent = new Agent($request->server->all());
            $browserName = $agent->browser();
            $browserVersion = $agent->version($browserName);
            $platform = $agent->platform();
            activity()
                ->performedOn($user)
                ->event('logged')
                ->causedBy(auth()->guard('admin')->user())
                ->withProperties(['id' => $user->id, 'email' => $user->email, 'browser' => $browserName . '  version:' . $browserVersion, 'platform' => $platform, 'Mac' => substr(exec('getmac'), 0, 17)])
                ->log('logged');
            return redirect()->route('system.dashboard');
        } else {
            $agent = new Agent($request->server->all());
            $browserName = $agent->browser();
            $browserVersion = $agent->version($browserName);
            $platform = $agent->platform();
            activity()
                ->withProperties(['email' => $request->email,'password' => $request->password,'browser' => $browserName . '  version:' . $browserVersion, 'platform' => $platform, 'Mac' => substr(exec('getmac'), 0, 17)])
                ->event('failed-logged')
                ->log('Failed login attempt');
            return back();
        }
    }

    protected function authenticated(Request $request, $user)
    {
        return response()->json([
            'token' => $user->createToken('API Token')->accessToken,
        ]);
    }
}
