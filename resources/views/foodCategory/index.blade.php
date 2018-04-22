@extends('layout.default')
@section('title','食品分类')
@section('content')
    <a href="{{route('foodCategory.create')}}" class="btn btn-primary">添加食品分类</a>
    <table class="table table-hover table-border table-responsive" id="foodCategory_delete">
        <tr>
            <th>id</th>
            <th>食品分类名称</th>
            <th>操作</th>
        </tr>
        @foreach ($foodCategories as $foodCategory)
            <tr data-id="{{$foodCategory->id}}">
                <td>{{$foodCategory->id}}</td>
                <td>{{$foodCategory->name}}</td>
                <td>
                    <a href="{{route('foodCategory.edit',['foodCategory'=>$foodCategory])}}" class="btn btn-sm btn-warning">编辑</a>
                    {{--<button class="btn btn-sm btn-info package_delete">删除</button>--}}
                </td>
            </tr>
        @endforeach
    </table>
    {{$foodCategories->links()}}
@stop
