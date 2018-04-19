<?php

namespace App\Http\Controllers;

use App\Model\Business;
use App\Model\BusinessList;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index()
    {
        return view('business.index');
    }

    public function create()
    {
        return view('business.create');
    }

    public function store(Request $request)
    {
//        var_dump('111');die;
//        var_dump($request->shop_name);die;
        //检验
        $this->validate($request,[
            'phone'=>'required|numeric|max:11|unique:businesses',
            'password'=>'required|min:3|max:16',
            'shop_name'=>'required|min:3|max:15|unique:business_lists',
        ]);
        //检测成功,保存数据库
        Business::create([
            'phone'=>$request->phone,
            'password'=>bcrypt($request->password),
        ]);
        //同时向businessList表中添加空数据
        BusinessList::create([
                'shop_name'=>$request->shop_name,
            ]);
        //保存成功,提示并跳转
        session()->flash('success','注册成功!请登录!');
        return redirect()->route('login');
    }

    public function edit()
    {
       return view('business.edit');
    }
}
