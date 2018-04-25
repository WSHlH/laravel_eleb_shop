@extends('layout.default')
@section('title','活动详情')
@section('content')
    <div><p style="color:#9d9da2;font-size: 24px" class="glyphicon glyphicon-time">活动仅剩<span style="font-size: 36px;color: #ef4715;">{{ceil((strtotime($business->end)-time())/(3600*24))}}</span>天</p></div>
    <br>
    <img src="/img/<?=mt_rand(1,12)?>.jpg" alt="" width="40%" class="col-xs-5">

    <span class="col-xs-6">
        <h3 style="color: #3597ef">{{$business->title}}</h3>
        <div>开始时间:<span>{{$business->start}}</span>&emsp;结束时间:<span>{{$business->end}}</span></div><br>
        <span style="font-size: 21px;">{!! $business->content !!}</span>
    </span>

@stop
