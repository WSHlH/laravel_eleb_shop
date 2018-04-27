<?php

namespace App\Http\Controllers;

use App\Model\Food;
use App\Model\FoodCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use OSS\Core\OssException;

class FoodController extends Controller
{
    public function index()
    {
//        $foods = Food::all();
        $foods = Food::where('business_lists_id','=',Auth::user()->business_lists_id)->paginate(6);
        return view('food.index',compact('foods'));
    }

    public function create()
    {
        $foodCategories = FoodCategory::where('business_lists_id','=',Auth::user()->business_lists_id)->paginate();
        return view('food.create',compact('foodCategories'));
    }

    public function store(Request $request)
    {
        //检测

        $this->validate($request,[
            'food_name'=>'required|min:1|max:15',
            'food_image'=>'required',
            'price'=>'required|numeric',
            'food_categories_id'=>'required',
            'description'=>'min:3|max:100',
        ]);
        //保存
//        $fileName = $request->file('food_image')->store('public/food');
//        $fileUrl = url(Storage::url($fileName));
        Food::create([
            'food_name'=>$request->food_name,
            'food_image'=>$request->food_image,
            'price'=>$request->price,
            'food_categories_id'=>$request->food_categories_id,
            'description'=>$request->description,
            'business_lists_id'=>Auth::user()->business_lists_id,
        ]);
        //提示并跳转
        session()->flash('success','添加成功!');
        return redirect()->route('food.index');
    }

    public function edit(Food $food)
    {
        $foodCategories = FoodCategory::all();
        return view('food.edit',compact('food','foodCategories'));
    }

    public function update(Request $request,Food $food)
    {
        //检测
        $this->validate($request,[
            'food_name'=>['required','min:1','max:15',Rule::unique('foods')->ignore($food->id)],
            'food_image'=>'required',//|image
            'price'=>'required|numeric',
            'food_categories_id'=>'required',
            'description'=>'min:3|max:100',
        ]);
        //保存
//        $fileName = $request->file('food_image')->store('public/food');
//        $fileUrl = url(Storage::url($fileName));
        $food->update([
            'food_name'=>$request->food_name,
            'food_image'=>$request->food_image,
            'price'=>$request->price,
            'food_categories_id'=>$request->food_categories_id,
            'description'=>$request->description,
        ]);
        //提示并跳转
        session()->flash('success','修改成功!');
        return redirect()->route('food.index');
    }

    public function destroy(Food $food)
    {
        $food->delete();
        session()->flash('success','删除成功!');
    }
}
