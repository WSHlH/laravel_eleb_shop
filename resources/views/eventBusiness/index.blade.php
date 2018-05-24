@extends('layout.default')
@section('title','抽奖活动')
@section('content')
    <a href="{{route('prizeBusiness')}}" class="btn btn-sm btn-warning">往期获奖名单</a>
    <table class="table table-hover table-border table-responsive" id="event_del">
        <tr>
            <th>活动名</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>开奖时期</th>
        </tr>
        @foreach ($events as $event)
            <tr data-id="{{$event->id}}">
                <td>
                    <a href="{{route('eventShow',['event'=>$event])}}">{{$event->title}}</a>
                </td>
                <td>{{date('Y-m-d',$event->signup_start)}}</td>
                <td>{{date('Y-m-d',$event->signup_end)}}</td>
                <td>{{$event->prize_date}}</td>
            </tr>
        @endforeach
    </table>
{{--    {{$events->links()}}--}}
@stop
