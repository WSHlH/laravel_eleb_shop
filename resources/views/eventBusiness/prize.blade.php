@extends('layout.default')
@section('title','往期获奖名单')
@section('content')
    <table class="table table-hover table-border table-responsive" id="prize_del">
        <tr>
            <th>活动名</th>
            <th>奖品</th>
            <th>中奖商家</th>
        </tr>
        {{--->title--}}
        @foreach ($prizes as $prize)
            <tr data-id="{{$prize->id}}">
                <td>{{$prize->event->title}}</td>
                <td>{{$prize->name}}</td>
                {{--->shop_name--}}
                <td>{{$prize->business_lists_id==0?'无中奖商家':$prize->business->shop_name}}</td>
            </tr>
        @endforeach
    </table>
    {{$prizes->links()}}
@stop
