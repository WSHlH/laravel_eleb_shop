@extends('layout.default')
@section('title','注册店铺')
@section('content')
    <div class="jumbotron">
        <h2 style="color: #43d5ef">加入饿了吧外卖平台 赚大钱</h2>
        <p>快来加入我们吧</p>
        <p>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">我要开店</button>

        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">注册店铺</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('business.store')}}" method="post">
                            <div class="form-group">
                                <label for="shop_name">店铺名称</label>
                                <input type="text" name="shop_name" class="form-control" id="shop_name" placeholder="请输入店铺名称">
                            </div>
                            <div class="form-group">
                                <label for="phone">电话</label>
                                <input type="text" name="phone" class="form-control" id="phone" placeholder="请输入电话号码">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">密码</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="密码">
                            </div>
                            <div class="form-group">
                                <label >确认密码</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="确认密码">
                            </div>
                        <button type="submit" class="btn btn-default btn-block">注册店铺</button>
                            {{csrf_field()}}
                        </form>
                    </div>
    {{--<div class="modal-footer">--}}
        {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
        {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
    {{--</div>--}}
                </div>
            </div>
        </div>

    {{--<form action="{{route('business.store')}}" method="post">--}}
        {{--<div class="form-group">--}}
            {{--<label for="shop_name">店铺名称</label>--}}
            {{--<input type="text" name="shop_name" class="form-control" id="shop_name" placeholder="请输入店铺名称">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="phone">电话</label>--}}
            {{--<input type="text" name="phone" class="form-control" id="phone" placeholder="请输入电话号码">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label for="exampleInputPassword1">密码</label>--}}
            {{--<input type="password" class="form-control" id="exampleInputPassword1" placeholder="密码">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<label >确认密码</label>--}}
            {{--<input type="password" name="password_confirmation" class="form-control" placeholder="确认密码">--}}
        {{--</div>--}}
        {{--<button type="submit" class="btn btn-default btn-block">注册店铺</button>--}}
    {{--</form>--}}

@stop
