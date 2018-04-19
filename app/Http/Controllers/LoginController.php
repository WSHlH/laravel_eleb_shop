<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show()
    {
        return view('business.login');
    }

    public function store(Request $request)
    {
        //检验
        $this->validate($request,[
            'phone'=>'required|numeric|min:11',
            'password'=>'required|min:3|max:16',
            'captcha'=>'required|captcha',
        ]);
        //检验成功
        if (Auth::attempt(['phone'=>$request->phone,'password'=>$request->password],$request->has('remember'))){
            session()->flash('success','登录成功!');
            return redirect()->route('businessList.show',[Auth::user()]);
        }else{
            session()->flash('danger','用户名或密码错误!登录失败!');
            return back()->withInput();
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success','注销成功!');
        return view('business.index');
    }
}
