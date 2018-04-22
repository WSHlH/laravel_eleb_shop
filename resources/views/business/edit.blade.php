@extends('layout.default')
@section('title','修改')
@section('content')
    <form action="{{route('business.update',['business'=>$business])}}" method="post" class="col-xs-6">
        {{--<div class="form-group">--}}
            {{--<label for="shop_name">店铺名称</label>--}}
            {{--<input type="text" name="shop_name" value="{{$business->shop_name}}" class="form-control" id="shop_name" placeholder="请输入店铺名称">--}}
        {{--</div>--}}
        <div class="form-group">
            <label for="phone">电话</label>
            <input type="text" name="phone" value="{{$business->phone}}" class="form-control" id="phone" placeholder="请输入电话号码">
        </div>
        <div class="form-group">
            <label>原密码</label>
            <input type="password" name="old_password" class="form-control" placeholder="原密码">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">新密码</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="新密码">
        </div>
        <div class="form-group">
            <label >确认密码</label>
            <input type="password" name="password_confirmation" class="form-control" placeholder="确认密码">
        </div>
        <button type="submit" class="btn btn-default btn-block">修改登录信息</button>
        {{csrf_field()}}
        {{method_field('PUT')}}
    </form>
    <img src="" alt="" class="col-xs-1">
    <img src="/img/8.jpg" alt="" width="40%">
@stop
