@extends('layout.default')
@section('title','订单列表')
@section('content')
    <a href="{{route('orders')}}" class="btn btn-primary">销量详情</a>
    <table class="table table-hover table-border table-responsive" id="order_delete">
        <tr>
            <th>id</th>
            <th>订单编号</th>
            <th>付款人</th>
            <th>总付款</th>
            <th>收货人</th>
            <th>联系方式</th>
            <th>收货地址</th>
            <th colspan="3">订单状态</th>
            <th>操作</th>
        </tr>
        @foreach ($orders as $order)
            <tr data-id="{{$order->id}}">
                <td>{{$order->id}}</td>
                <td>{{$order->order_code}}</td>
                <td>{{$order->customer->username}}</td>
                <td>{{$order->order_price}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->tel}}</td>
                <td>{{$order->provence.$order->city.$order->area.$order->detail_address}}</td>
                <td>{{$order->order_status==3?'发货':''}}</td>
                <td>{{$order->order_status==0?'未付款':''}}</td>
                <td>{{$order->order_status==4?'拒单':''}}</td>
                <td>
                    {{--<a href="{{route('foodCategory.edit',['foodCategory'=>$foodCategory])}}" class="btn btn-sm btn-warning">编辑</a>--}}
                    <a href="{{route('order.show',['order'=>$order])}}" class="btn btn-sm btn-warning" >订单详情</a>
                    {{--<button class="btn btn-sm btn-info order_delete">取消订单</button>--}}
                </td>
                <td>
                    {{--<form action="{{route('foodCategory.destroy',['foodCategory'=>$foodCategory])}}" method="post">--}}
                        {{--<input type="submit" class="btn btn-sm btn-danger foodCategory_delete" value="删除">--}}
{{--                        {{csrf_field()}}--}}
                        {{--{{method_field('DELETE')}}--}}
                    {{--</form>--}}
                </td>
            </tr>
        @endforeach
    </table>
    {{$orders->links()}}
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
