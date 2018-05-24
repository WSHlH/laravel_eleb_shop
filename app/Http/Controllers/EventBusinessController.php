<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Model\EventBusiness;
use App\Model\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class EventBusinessController extends Controller
{
    public function index()
    {
        //显示抽奖活动
//        $events = Event::paginate(5);
        $events = Event::all();
//        var_dump($events);die;
        if (!is_dir('html/eventBusiness/')){
            mkdir('html/eventBusiness/',777,true);
        }
        $list = view('eventBusiness.index',compact('events'))->render();
        file_put_contents('html/eventBusiness/list.html',$list);
//        return view('eventBusiness.index',compact('events'));
    }

    public function show(Event $eventShow)
    {
//        var_dump($eventShow->id);die;
        $event = DB::table('events')->where('id',$eventShow->id)->first();
        $eventPrizes = EventPrize::where('events_id',$eventShow->id)->get();

//        var_dump($eventPrize);die;
        return view('eventBusiness.show',compact('event','eventPrizes'));
    }

    public function store(Request $request)
    {
//        var_dump($request->events_id);die;
        $business = DB::table('event_businesses')->where('business_lists_id',$request->business_lists_id)->where('events_id',$request->events_id)->first();
        if (!empty($business)){
            return redirect()->route('eventBusiness')->with('warning','你已参与,不能重复抽奖!');
        }
        EventBusiness::create([
            'events_id'=>$request->events_id,
            'business_lists_id'=>$request->business_lists_id,
        ]);
        return redirect()->route('eventBusiness')->with('success','参与抽奖成功,请耐心等待开奖^_^');
    }

    public function prize()
    {
        $prizes = EventPrize::orderBy('events_id')->paginate(8);
//        var_dump($prizes);die;
        return view('eventBusiness.prize',compact('prizes'));
    }
}
