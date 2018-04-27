<?php

namespace App\Http\Controllers;

use App\Model\FoodCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FoodCategoryController extends Controller
{
    public function index()
    {
        $foodCategories = FoodCategory::where('business_lists_id','=',Auth::user()->business_lists_id)->paginate(5);
        return view('foodCategory.index',compact('foodCategories'));
    }

    public function create()
    {
        return view('foodCategory.create');
    }

    public function store(Request $request)
    {
        //检测
        $count = DB::select('select count(*) as num from food_categories where name = ? and business_lists_id=?', [$request->name,Auth::user()->business_lists_id]);
//        var_dump($count[0]->num);die;
        if ($count[0]->num==0){
            $this->validate($request,[
                'name'=>'required|min:2|max:10',//|unique:food_categories
                'description'=>'min:10|max:150',
                'tips'=>'min:5|max:50',
            ]);
        }else{
            $this->validate($request,[
                'name'=>'required|min:2|max:10|unique:food_categories',
            ]);
        }

        if ($request->is_selected==1){
            DB::table('food_categories')
                ->where('business_lists_id','=',Auth::user()->business_lists_id)
                ->update(['is_selected'=>0]);
        }
        $id = DB::table('food_categories')->orderBy('id','desc')->first()->id;
        $type = 'c'.($id+1);
        FoodCategory::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'tips'=>$request->tips,
            'is_selected'=>$request->is_selected??0,
            'type_accumulation'=>$type,
            'business_lists_id'=>Auth::user()->business_lists_id,
        ]);
        session()->flash('success','添加成功!');
        return redirect()->route('foodCategory.index');
    }

    public function edit(FoodCategory $foodCategory)
    {
        return view ('foodCategory.edit',compact('foodCategory'));
    }

    public function update(Request $request,FoodCategory $foodCategory)
    {
        //检测
        $foods = DB::select('select count(*) as foods from foods where food_categories_id=?', [$foodCategory->id]);
        if ($foods[0]->foods!=0){
            session()->flash('warning','不可修改!该分类下包含食物,请先移动食物到其他分类');
            return redirect()->route('foodCategory.index');
        }
        $count = DB::select('select count(*) as num from food_categories where name = ? and business_lists_id=?', [$request->name,Auth::user()->business_lists_id]);
//        var_dump($count);die;
        if ($count[0]->num==0){
            $this->validate($request,[
                //Rule::unique('food_categories')->ignore(Auth::user()->business_lists_id)],
                'name'=>'required|min:2|max:10',
                'description'=>'min:10|max:150',
                'tips'=>'min:5|max:50',
            ]);
        }else{
            $this->validate($request,[
                'name'=>'required|min:2|max:10|unique:food_categories',
            ]);
        }

        if ($request->is_selected==1){
            DB::table('food_categories')->where('business_lists_id','=',Auth::user()->business_lists_id)->update(['is_selected'=>0]);
        }
        $foodCategory->update([
            'name'=>$request->name,
            'description'=>$request->description,
            'tips'=>$request->tips,
            'is_selected'=>$request->is_selected??0,
            'business_lists_id'=>Auth::user()->business_lists_id,
        ]);
        session()->flash('success','修改成功!');
        return redirect()->route('foodCategory.index');
    }

    public function destroy(FoodCategory $foodCategory)
    {
        //查询分类下是否有食物
        $foods = DB::select('select count(*) as foods from foods where food_categories_id=?', [$foodCategory->id]);
        if ($foods[0]->foods!=0){
            session()->flash('warning','不可删除!该分类下包含食物,请先删除或移动食物!');
            return redirect()->route('foodCategory.index');
        }else{
            session()->flash('success','删除成功!!');
            return redirect()->route('foodCategory.index');
        }
    }
}
