@extends('layout.default')
@section('title','抽奖活动')
@section('content')
    <table class="table table-hover table-border table-responsive" id="event_del">
        <tr>
            {{--<th>id</th>--}}
            <th>活动名</th>
            <th>活动开始时间</th>
            <th>活动结束时间</th>
            <th>开奖时期</th>
            {{--<th>活动人数上限</th>--}}
            {{--<th>是否已开奖</th>--}}
            {{--<th>操作</th>--}}
        </tr>
        @foreach ($events as $event)
            <tr data-id="{{$event->id}}">
{{--                <td>{{$event->id}}</td>--}}
                <td>
                    <a href="{{route('eventShow',['event'=>$event])}}">{{$event->title}}</a>
                </td>
                <td>{{date('Y-m-d',$event->signup_start)}}</td>
                <td>{{date('Y-m-d',$event->signup_end)}}</td>
                <td>{{$event->prize_date}}</td>
                {{--<td>{{$event->signup_num}}</td>--}}
                {{--<td>{{$event->is_prize==0?'×':'√'}}</td>--}}
                {{--<td>--}}
                    {{--{{route('event.edit',['event'=>$event])}}--}}
                    {{--<a href="" class="btn btn-sm btn-warning">编辑</a>--}}
                    {{--<button class="btn btn-danger event_del">删除</button>--}}
                {{--</td>--}}
            </tr>
        @endforeach
    </table>
    {{$events->links()}}
@stop
