@extends('layout.default')
@section('title','抽奖活动报名')
@section('content')
    <div><p style="color:#9d9da2;font-size: 24px" class="glyphicon glyphicon-time">抽奖活动结束仅剩<span style="font-size: 36px;color: #ef4715;">
                {{ceil(($event->signup_end-time())/(3600*24))}}</span>天</p></div>
    <br>
    <img src="/img/<?=mt_rand(1,12)?>.jpg" width="40%" class="col-xs-5">

    <span class="col-xs-4">
        <h3 style="color: #3597ef">{{$event->title}}</h3>
        <div>开始时间:<span>{{date('Y-m-d',$event->signup_start)}}</span>&emsp;结束时间:<span>{{date('Y-m-d',$event->signup_end)}}</span></div><br>
        <div>开奖日期:{{$event->prize_date}},敬请期待!</div><br>
        <span style="font-size: 21px;">{!! $event->content !!}</span>

    </span>


@if($event->is_prize==1)
    <span class="col-xs-3">
        <span style="color: #994bef">获奖名单:</span><br>
        @foreach($eventPrizes as $eventPrize)
            <span style="color: #020100">{{$eventPrize->business->shop_name}}</span><br>
        @endforeach
    </span>
    @elseif($event->prize_date>date('Y-m-d'))
    <form action="{{route('eventBusiness')}}" method="post" class="col-xs-1">
        <div class="form-group">
            <label style="color: #ef23ba">奖品:</label><br>
            @foreach($eventPrizes as $eventPrize)
                <label ><span style="color: #ef8526">{{$eventPrize->name}}</span></label><br>
            @endforeach
            <input type="hidden" name="events_id" value="{{$event->id}}">
            <input type="hidden" name="business_lists_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
            <input type="submit" value="点击抽奖" class=" btn btn-warning">
        </div>
        {{csrf_field()}}
    </form>
    @endif
@stop
