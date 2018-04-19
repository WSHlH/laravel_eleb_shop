@extends('layout.default')
@section('title','商家首页')
@section('content')
    <h1>商家首页</h1>
    <a href="{{route('businessList.show')}}">查看店铺详情</a>
@stop
