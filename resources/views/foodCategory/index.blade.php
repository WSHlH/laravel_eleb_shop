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
                    {{--<button class="btn btn-sm btn-info foodCategory_delete">删除</button>--}}
                </td>
                <td><form action="{{route('foodCategory.destroy',['foodCategory'=>$foodCategory])}}" method="post">
                        <input type="submit" class="btn btn-sm btn-danger foodCategory_delete" value="删除">
{{--                        {{csrf_field()}}--}}
                        {{method_field('DELETE')}}
                    </form></td>
            </tr>
        @endforeach
    </table>
    {{$foodCategories->links()}}
@stop
@section('jquery')
    <script>
        $('#foodCategory_delete .foodCategory_delete').click(function(){
           var tr = $(this).closest('tr');
           var id = tr.data('id');
           $.ajax({
               type:'DELETE',
               url:'foodCategory/'+id,
               data:'_token={{csrf_token()}}',
               success:function(msg){

               }
           });
        });
    </script>
    @stop
