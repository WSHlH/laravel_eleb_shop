@extends('layout.default')
@section('title','添加食品分类')
@section('content')
    <p style="color:#c8c8cf;font-size: 24px">添加食品分类</p>
    <form action="{{route('foodCategory.store')}}" method="POST" class="col-xs-6" enctype="multipart/form-data">
        分类名:
        <input type="text" name="name" class="form-control" value="{{old('name')}}"><br>
        默认选中:
        <label for=""><input type="checkbox" name="is_selected" value="1" {{old('name')==1?'checked':''}}>是</label><br><br>
        分类提示:
        <textarea name="tips" cols="30" rows="3" class="form-control">{{old('tips')}}</textarea><br><br>
        分类描述:
        <textarea name="description" cols="30" rows="6" class="form-control">{{old('description')}}</textarea><br><br>
        <input type="submit" value="添加" class="btn btn-group btn-block">
        {{csrf_field()}}
    </form><img src="" alt="" class="col-xs-1">
    <img src="/img/5.jpg" alt="" width="40%">
@stop
