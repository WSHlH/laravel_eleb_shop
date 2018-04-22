@extends('layout.default')
@section('title','')
@section('content')
    <form action="{{route('businessList.update',['businessList'=>$businessList,'business'=>$business,'categories'=>$categories])}}" method="post" enctype="multipart/form-data" class="col-xs-6">
        <div class="form-group">
            <label for="shop_name">店铺名称:</label>
            <input type="text" name="shop_name" class="form-control" id="shop_name" value="{{$businessList->shop_name}}">
        </div>
        <div class="form-group">
            <label for="brand">店铺是否为品牌:</label>
            <label class="radio-inline"><input type="radio" name="brand" value="1" {{$businessList->brand==1?'checked':''}}> 是</label>
            <label class="radio-inline"><input type="radio" name="brand" value="0" {{$businessList->brand==0?'checked':''}}>否</label>
        </div>
        <div class="form-group">
            <label for="business_categories_id">店铺所属分类:</label>
            <select name="business_categories_id"   class="form-control" >
                @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="phone">电话号码:</label>
            <input type="text" name="phone" class="form-control" id="phone" value="{{$businessList->business->phone}}">
        </div>
        <div class="form-group">
            <label>店铺图片:</label>
            <input type="file" name="shop_img" >
        </div>
        <div class="form-group">
            <label for="start_send">起送价:</label>
            <input type="text" name="start_send" value="{{$businessList->start_send}}"  class="form-control" id="start_send">
        </div>
        <div class="form-group">
            <label for="send_cost">配送费:</label>
            <input type="text" name="send_cost" value="{{$businessList->send_cost}}"  class="form-control" id="send_cost">
        </div>
        <div class="form-group">
            <label for="humming">店铺是否蜂鸟配送:</label>
            <label class="radio-inline"><input type="radio" name="humming" value="1" {{$businessList->humming==1?'checked':''}}>是</label>
            <label class="radio-inline"><input type="radio" name="humming" value="0" {{$businessList->humming==0?'checked':''}}>否</label>
        </div>
        <div class="form-group">
            <label for="estimate_time">预约时间:</label>
            <input type="text" name="estimate_time" value="{{$businessList->estimate_time}}"  class="form-control" id="estimate_time">
        </div>
        <div class="form-group">
            <label for="on_time">店铺是否准时达:</label>
            <label class="radio-inline"><input type="radio" name="on_time" value="1" {{$businessList->on_time==1?'checked':''}}>是</label>
            <label class="radio-inline"><input type="radio" name="on_time" value="0" {{$businessList->on_time==0?'checked':''}}>否</label>
        </div>
        <div class="form-group">
            <label for="promise">店铺是否晚到必赔:</label>
            <label class="radio-inline"><input type="radio" name="promise" value="1" {{$businessList->promise==1?'checked':''}}>是</label>
            <label class="radio-inline"><input type="radio" name="promise" value="0" {{$businessList->promise==0?'checked':''}}>否</label>
        </div>
        <div class="form-group">
            <label for="notice">店铺公告:</label>
            <textarea name="notice" class="form-control" cols="30" rows="4">{{$businessList->notice}}</textarea>
        </div>
        <div class="form-group">
            <label for="discount">店铺优惠:</label>
            <textarea name="discount" class="form-control" cols="30" rows="4">{{$businessList->discount}}</textarea>
        </div>
        <div class="form-group">
            <label for="invoice">店铺是否开具发票:</label>
            <label class="radio-inline"><input type="radio" name="invoice" value="1" {{$businessList->invoice==1?'checked':''}}>是</label>
            <label class="radio-inline"><input type="radio" name="invoice" value="0" {{$businessList->invoice==0?'checked':''}}>否</label>
        </div>
        <div class="form-group">
            <input type="submit" value="确认修改" class="form-control btn-block">
        </div>
        {{csrf_field()}}
        {{method_field('PUT')}}
    </form>
    <div>&emsp;</div>
    <img src="" alt="" class="col-xs-1">
    <img src="/img/8.jpg" alt="" width="40%">
@stop
