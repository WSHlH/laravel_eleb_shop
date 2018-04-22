<?php

namespace App\Http\Controllers;

use App\Model\Business;
use App\Model\BusinessList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class BusinessController extends Controller
{
    public function index()
    {
        //如果列表需要得到所有分类
//        $categories = DB::table('business_categories')->get();//是一个二维数组
        //遍历放入一个新数组
//        $arr = [];
//        foreach($categories as $category){
//            $arr[] = $arr[$category->id][$category->name];//得到一个一维索引数组
//        }
        //然后再分配到页面显示(通过对应的分类id)
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
            'phone'=>'required|max:11|min:11|unique:businesses|regex:/^1[3458][0-9]\d{4,8}$/',
            'password'=>'required|min:3|max:16',
            'shop_name'=>'required|min:3|max:15|unique:business_lists',
        ]);
        //检测成功,开启事务同时保存数据库
        DB::transaction(function() use ($request){
            $businessListId = BusinessList::create([
                'shop_name'=>$request->shop_name,
            ]);
            Business::create([
                'phone'=>$request->phone,
                'password'=>bcrypt($request->password),
                'business_lists_id'=>$businessListId->id,
            ]);
            //同时向businessList表中添加空数据
    });
        //保存成功,提示并跳转
        session()->flash('success','注册成功!请登录!');
        return redirect()->route('login');
    }

    public function edit(Business $business)
    {
       return view('business.edit',compact('business'));
    }

    public function update(Request $request,Business $business)
    {
        //验证
        $this->validate($request,[
            'phone'=>['min:11','max:11','regex:/^1[3458][0-9]\d{4,8}$/',Rule::unique('businesses')->ignore($business->id)],
            'password'=>'required|min:3|max:16',
        ]);
        if (Hash::check($request->old_password,Auth::user()->password)){
//            if (Auth::attempt(['name'=>$request->name,'password'=>$request->old_password])){
//
//            }
            $business->update([
                'phone'=>$request->phone,
                'password'=>bcrypt($request->password),
            ]);
            //修改成功,提示并跳转
            session()->flash('success','修改成功!请重新登录!');
            Auth::logout();
            return redirect()->route('login');
        }
        //修改成功,提示并跳转
        session()->flash('warning','原密码输入错误,修改失败!');
        return back()->withInput();

    }
}
