@extends('layout.default')
@section('title','添加食品')
@section('content')
    <form action="{{route('food.store',['foodCategories'=>$foodCategories])}}" method="post" enctype="multipart/form-data" class="col-xs-6">
        <div class="form-group">
            <label for="food_name">食品名称:</label>
            <input type="text" name="food_name" class="form-control" id="food_name" value="{{old('food_name')}}">
        </div>
        <div class="form-group">
            <label>食品图片:</label>
            <input type="file" name="food_image" value="{{old('food_image')}}">
        </div>
        <div class="form-group">
            <label>食品价格:</label>
            <input type="text" name="price" class="form-control" value="{{old('price')}}">
        </div>
        <div class="form-group">
            <label>食品分类:</label>
            <select name="food_categories_id" class="form-control">
                @foreach($foodCategories as $foodCategory)
                <option value="{{$foodCategory->id}}" {{old($foodCategory->id)==$foodCategory->id?'selected':''}}>{{$foodCategory->name}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>食品描述:</label>
            <textarea name="description" cols="30" rows="6" class="form-control">{{old('description')}}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="确认添加" class="btn btn-block">
        </div>
        {{csrf_field()}}
    </form>
    <div>&emsp;</div>
    <img src="" alt="" class="col-xs-1">
    <img src="/img/7.jpg" alt="" width="40%">
@stop
