@extends('layout.default')
@section('title','订单详情')
@section('content')
    <p style="color:#c8c8cf;font-size: 24px">订单详情</p>
    <table class="table table-bordered col-xs-4">
        <tr>
            <th>商品名</th>
            <th>商品图片</th>
            <th>单价</th>
            <th>商品数</th>
        </tr>
        @foreach($orderGoods as $goods)
        <tr>
            <td>{{$goods->goods_name}}</td>
            <td><img src="{{$goods->goods_img}}" alt="未上传" width="50"></td>
            <td>{{$goods->goods_price}}</td>
            <td>{{$goods->amount}}</td>
        </tr>
        @endforeach
        <tr>
            <td>
                <form action="{{route('order.update',['order_id'=>$order_id->order_id])}}" method="post">
                    订单状态:
                    <label><input type="radio" name="status" value="4">拒绝</label>
                    <label><input type="radio" name="status" value="3">发货</label>
                    <input type="submit" value="确认">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                </form>
            </td>
        </tr>
    </table>
    {{--<img src="" alt="" class="col-xs-1">--}}
    {{--<img src="/img/6.jpg" alt="" width="40%">--}}


@stop
@section('jquery')
    <script>
        $('#order .order_refuse').click(function(){
            var dd = $(this).closest('dd');
            var id = dd.data('id');
            var that = this;
            $.getJSON('order/'+id,"_token={{csrf_token()}}",function(data){
                $(that).html('已拒绝');
            });
        });
    </script>
    @stop
