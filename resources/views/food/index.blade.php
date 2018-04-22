@extends('layout.default')
@section('title','本店食品')
@section('content')
    {{--<p style="color:#c8c8cf;font-size: 24px">本店食品</p>--}}
    <div>
        <a href="{{route('food.create')}}" class="btn btn-primary">添加食品</a>
    </div>
    <br>
    <div class="row" id="food_del">
        @foreach($foods as $food)
    <span class="col-xs-2" data-id="{{$food->id}}">
        <div><img src="{{$food->food_image}}" alt="" width="150"></div><br>
        <div><span>{{$food->food_name}}</span></div><br>
        <div><span>售价:{{$food->price}}元</span></div><br>
        <div>
            <span><a href="{{route('food.edit',['food'=>$food])}}" class="btn btn-warning">编辑</a></span>&emsp;
            <button class="btn btn-danger food_del">删除</button>
        </div>
    </span>
        @endforeach
    </div>
    <div>
        {{$foods->links()}}
    </div>
@stop
@section('jquery')
    <script>
        $('#food_del .food_del').click(function(){
            if (confirm('删除后不可恢复,是否确认删除?')){
                var span = $(this).closest('span').closest('span');
                var id = span.data('id');
                $.ajax({
                    type:'DELETE',
                    url:'food/'+id,
                    data:'_token={{csrf_token()}}',
                    success:function(msg){
                        span.fadeOut();
                    }
                });
            }
        })
    </script>
    @stop
