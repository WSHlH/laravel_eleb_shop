<?php

namespace App\Http\Controllers;

use App\Model\Food;
use App\Model\Order;
use App\Model\OrderGood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        //查询所有订单
        $orders = Order::where('shop_id',Auth::user()->id)->paginate(8);
//        var_dump($orders[0]->shop_name);die;
        return view('order.index',compact('orders'));
    }

    public function show(Order $order)
    {
        $orderGoods = OrderGood::where('order_id',$order->id)->get();
        $order_id = OrderGood::where('order_id',$order->id)->first();
//        var_dump($order_id->order_id);die;
        return view('order.show',compact('orderGoods','order_id'));
    }

    public function update(Request $request,Order $order)
    {
//        var_dump($order->id);die;
        DB::table('orders')->where('id',$order->id)->update(['order_status'=>$request->status]);
        session()->flash('success','操作成功');
        return redirect()->route('order.index');
    }

    public function orders()
    {
        $shop_id = Auth::user()->id;
        $orders = Order::where('shop_id',$shop_id)->get();
        $ids = [];
        foreach ($orders as $row){
            $ids[] = $row->id;
        }
        $str = implode(',',$ids);
        $total = DB::select("select goods_id,sum(amount) as total from `order_goods` where order_id in ($str) GROUP by `goods_id` order BY total desc");
        $month = DB::select("select goods_id,sum(amount) as m from `order_goods` WHERE order_id in ($str) and created_at like ? GROUP by `goods_id` order BY m desc",[date('Y-m').'%']);
        $day = DB::select("select goods_id,sum(amount) as d from `order_goods` where order_id in ($str) and created_at like ? GROUP by `goods_id` order BY d desc",[date('Y-m-d').'%']);
        return view('order.orders',compact('total','month','day'));
    }

    public function everyOrder(Request $request)
    {
        $shop_id = Auth::user()->id;
        $orders = Order::where('shop_id',$shop_id)->get();
        $ids = [];
        foreach ($orders as $row){
            $ids[] = $row->id;
        }
        $str = implode(',',$ids);
        if ($request->date==null and $request->month==null and ($request->datetime1==null or $request->datetime2==null)){
            return back()->withInput()->with('warning','请输入要搜索的日期');
        }
        if ($request->date!=null){
            $date = $request->date;
            $count = DB::select("select goods_id,sum(amount) as d from `order_goods` where order_id in ($str) and created_at like ? GROUP by `goods_id` ORDER by d desc",[$date.'%']);
        }
        elseif ($request->month!=null){
            $date = $request->month;
            $count = DB::select("select goods_id,sum(amount) as d from `order_goods` WHERE order_id in ($str) and created_at like ? GROUP by `goods_id` order BY d desc",[$date.'%']);
        }
        elseif($request->datetime1!=null and $request->datetime2!=null){
            $date = $request->datetime1;
            $date1 = $request->datetime2;
            $count = DB::select("select goods_id,sum(amount) as d from `order_goods` where order_id in ($str) and created_at between ? and ? GROUP by `goods_id` order BY d desc",[$date,$date1]);
        }
        return view('order.sale',compact('count'));
    }
}
