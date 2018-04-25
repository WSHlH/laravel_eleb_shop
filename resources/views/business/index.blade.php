@extends('layout.default')
@section('title','饿了就来饿了吧')
@section('content')
    <div class="jumbotron">
        <h2 style="color: #ef8526">热门活动!!!</h2>
        <table class="table table-hover table-border table-responsive" id="businessActivity">
            <tr>
                {{--<th>id</th>--}}
                <th>活动名称</th>
                <th>活动内容</th>
                <th>开始时间</th>
                <th>结束时间</th>
            </tr>
            @foreach($businessActivities as $businessActivity)
                <tr data-id="{{$businessActivity->id}}">
{{--                    <td>{{$businessActivity->id}}</td>--}}
    <td><a href="{{route('business.show',['businessActivity'=>$businessActivity])}}">{{$businessActivity->title}}</a></td>
    <td><a href="{{route('business.show',['businessActivity'=>$businessActivity])}}">{!! mb_substr($businessActivity->content,0,15) !!}...</a></td>
                    <td>{{$businessActivity->start}}</td>
                    <td>{{$businessActivity->end}}</td>
                </tr>
            @endforeach
        </table>
        {{$businessActivities->links()}}
    </div>
@stop

