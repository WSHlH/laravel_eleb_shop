@extends('layout.default')
@section('title','店铺详情')
@section('content')
    <p style="color:#c8c8cf;font-size: 24px">店铺详情</p>
    <dl class="dl-horizontal col-xs-7">
        <dt>店铺名称</dt>
        <dd>{{$businessList->shop_name}}</dd>
        <dt>店铺图片</dt>
        <dd><img src="{{\Illuminate\Support\Facades\Storage::url($businessList->shop_img)}}" alt="未上传" width="200"></dd>
        <dt>店铺是否为品牌</dt>
        <dd>{{$businessList->brand==1?'是':'否'}}</dd>
        <dt>店铺是否准时达</dt>
        <dd>{{$businessList->on_time==1?'是':'否'}}</dd>
        <dt>店铺是否蜂鸟配送</dt>
        <dd>{{$businessList->humming==1?'是':'否'}}</dd>
        <dt>店铺是否晚到必赔</dt>
        <dd>{{$businessList->promise==1?'是':'否'}}</dd>
        <dt>店铺是否开具发票</dt>
        <dd>{{$businessList->invoice==1?'是':'否'}}</dd>
        <dt>起送价</dt>
        <dd>{{$businessList->start_send}}元</dd>
        <dt>配送费</dt>
        <dd>{{$businessList->send_cost}}元</dd>
        <dt>预约时间</dt>
        <dd>{{empty($businessList->estimate_time)?'未设置':$businessList->estimate_time}}</dd>
        <dt>店铺公告</dt>
        <dd>{{empty($businessList->notice)?'未设置':$businessList->notice}}</dd>
        <dt>店铺优惠</dt>
        <dd>{{empty($businessList->discount)?'未设置':$businessList->discount}}</dd>
        <dt></dt><dd></dd>
        <dt></dt>
        <dd><a href="{{route('businessList.edit',['businessList'=>$businessList])}}" class="btn btn-warning">修改店铺信息</a></dd>
    </dl>
    <img src="" alt="" class="col-xs-1">
    <img src="/img/6.jpg" alt="" width="40%">
@stop
