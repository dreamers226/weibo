<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }
    
    // 登录页面
    public function create()
    {
        return view('sessions.create');
    }

    // 用户登录提交表单操作的处理
    public function store(Request $request)
    {
       $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
       ]);

       if (Auth::attempt($credentials, $request->has('remember'))) {
            // 登录成功后的相关操作
            session()->flash('success', '欢迎回来！');
            $fallback = route('users.show', Auth::user());//默认的跳转页面
            return redirect()->intended($fallback);//返回用户上一个页面
       } else {
            // 登录失败后的相关操作
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            return redirect()->back()->withInput();
       }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}
