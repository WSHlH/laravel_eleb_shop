<?php

namespace App\Http\Controllers;

use App\Model\Business;
use App\Model\BusinessList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class BusinessListController extends Controller
{
    public function index()
    {
        return view('businessList.index');
    }

    public function create()
    {

    }

    public function show(BusinessList $businessList)
    {
        $category =DB::table('business_categories')->where('id','=',$businessList->business_categories_id)->get();
//        var_dump($category);die;
        return view('businessList.show',compact('businessList','category'));
    }

    public function edit(BusinessList $businessList)
    {
        $business = DB::table('businesses')->where('id','=',1)->get();
        $categories = DB::table('business_categories')->get();
//        var_dump($categories);die;
        return view('businessList.edit',compact('businessList','business','categories'));
    }

    public function update(Request $request,BusinessList $businessList)
    {
        //检验
//        var_dump($request->business_categories_id);die;
        $this->validate($request,[
            'phone'=>['required','max:11',Rule::unique('businesses')->ignore($businessList->id)],
//            'password'=>'required|min:3|max:16',
            "shop_name"=>'required|min:3|max:15',
            "shop_img"=>'required|image',
            'business_categories_id'=>'required',
            "brand"=>'required',
            "on_time"=>'required',
            "humming"=>'required',
            "promise"=>'required',
            "invoice"=>'required',
            "start_send"=>'required|numeric',
            "send_cost"=>'required|numeric',
            "estimate_time"=>'required|numeric',
            "notice"=>'required|max:120',
            "discount"=>'required|max:50',
        ]);
        //检验成功,开启事务保存至数据库
        DB::transaction(function () use($request,$businessList){
            $fileName = $request->file('shop_img')->store('public/shop');
            $fileUrl = url(Storage::url($fileName));
//        var_dump($fileUrl);die;
            $businessList->update([
                "shop_name"=>$request->shop_name,
                'business_categories_id'=>$request->business_categories_id,
                "shop_img"=>$fileUrl,
                "on_time"=>$request->on_time,
                "humming"=>$request->humming,
                "promise"=>$request->promise,
                "invoice"=>$request->invoice,
                "start_send"=>$request->start_send,
                "send_cost"=>$request->send_cost,
                "estimate_time"=>$request->estimate_time,
                "notice"=>$request->notice,
                "discount"=>$request->discount,
            ]);
            DB::table('businesses')->where('id','=',$businessList->id)->update(['phone'=>$request->phone]);
        });
//保存成功,提示并跳转
        session()->flash('success','修改成功!');
        return redirect()->route('businessList.show',compact('businessList'));
    }
}
