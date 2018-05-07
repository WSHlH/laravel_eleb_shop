<?php

namespace App\Http\Controllers;

use App\Model\Food;
use App\Model\Order;
use App\Model\OrderGood;
use App\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

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

    /**
     * 发送验证码
     * @param Request $request
     * @return array
     */
    function sendSms($tel,$shop_name) {

        $params = array ();

        // *** 需用户填写部分 ***

        // fixme 必填: 请参阅 https://ak-console.aliyun.com/ 取得您的AK信息
        $accessKeyId = "LTAIxNo7qxbpUsqV";
        $accessKeySecret = "Ye4O7Cdo3xsQw6HktDl2BPZrdkE3Jk";

        // fixme 必填: 短信接收号码

        //短信接收号码为当前登录人电话号码
        $params["PhoneNumbers"] = $tel;

        // fixme 必填: 短信签名，应严格按"签名名称"填写，请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/sign
        $params["SignName"] = "我们的店";

        // fixme 必填: 短信模板Code，应严格按"模板CODE"填写, 请参考: https://dysms.console.aliyun.com/dysms.htm#/develop/template
        $params["TemplateCode"] = "SMS_134075474";

        // fixme 可选: 设置模板参数, 假如模板中存在变量需要替换则为必填项
        $params['TemplateParam'] = Array (
            "name" => $shop_name,
            //"product" => "阿里通信"
        );

        // fixme 可选: 设置发送短信流水号
        //$params['OutId'] = "12345";

        // fixme 可选: 上行短信扩展码, 扩展码字段控制在7位或以下，无特殊需求用户请忽略此字段
        $params['SmsUpExtendCode'] = "1234567";


        // *** 需用户填写部分结束, 以下代码若无必要无需更改 ***
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }

        // 初始化SignatureHelper实例用于设置参数，签名以及发送请求
        $helper = new Sms();

        // 此处可能会抛出异常，注意catch
        $content = $helper->request(
            $accessKeyId,
            $accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ))
        // fixme 选填: 启用https
        // ,true
        );

//        dd($content);
        if ($content->Message=='OK'){
            //发送成功
            return ["status"=>"true","message"=>"短信发送成功"];
        }else{
            //发送失败
            return ["status"=>"true","message"=>"短信发送失败"];
        }
    }

    public function update(Request $request,Order $order)
    {
//        var_dump($request->status);die;
        if ($request->status==3){
            $this->sendSms($order->tel,$order->shop_name);
        }
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
