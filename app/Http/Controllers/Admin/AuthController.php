<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BackendLoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /*
     * 登录页面
     */
    public function showLogin()
    {
        return view ( 'admin.auth.showLogin' );
    }


    /*
     * 后台登录
     */
    public function login(BackendLoginRequest $request)
    {
        if (Auth::guard ( 'admin' )->attempt ( [
            'account' => $request ['account'],
            'password' => $request ['password']
        ], $request->has ( 'remember' ) )) {
            // 认证通过
            return redirect ('admin/index');
        } else {
            return redirect ()->back ()->with('error', '用户名或密码错误!');
        }
    }


    /*
     * 首页
     */
    public function index()
    {
        return view ( 'admin.index');
    }


    /*
     * 登出
     */
    public function logout()
    {
        Auth::guard ( 'admin' )->logout ();
        return redirect ( 'admin/login' );
    }


}
