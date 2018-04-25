@extends('layout.default')
@section('title','')
@section('content')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
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
        {{--<div class="form-group">--}}
            {{--<label>店铺图片:</label>--}}
            {{--<input type="file" name="shop_img" >--}}
        {{--</div>--}}
        <!--dom结构部分-->
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">店铺图片</div>
            <br>
            <img src="" id="shop-img" width="200">
            <input type="hidden" name="shop_img" value="" id="shop_img" class="form-control">
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
            <label for="fengniao">店铺是否蜂鸟配送:</label>
            <label class="radio-inline"><input type="radio" name="fengniao" value="1" {{$businessList->fengniao==1?'checked':''}}>是</label>
            <label class="radio-inline"><input type="radio" name="fengniao" value="0" {{$businessList->fengniao==0?'checked':''}}>否</label>
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
            <label for="bao">店铺是否晚到必赔:</label>
            <label class="radio-inline"><input type="radio" name="bao" value="1" {{$businessList->bao==1?'checked':''}}>是</label>
            <label class="radio-inline"><input type="radio" name="bao" value="0" {{$businessList->bao==0?'checked':''}}>否</label>
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
            <label for="piao">店铺是否开具发票:</label>
            <label class="radio-inline"><input type="radio" name="piao" value="1" {{$businessList->piao==1?'checked':''}}>是</label>
            <label class="radio-inline"><input type="radio" name="piao" value="0" {{$businessList->piao==0?'checked':''}}>否</label>
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
@section('jquery')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            //因为是仿表单提交,需要传token
            formData:{"_token":"{{csrf_token()}}"},

            // swf文件路径
            swf: '/webuploader/Uploader.swf',

            // 文件接收服务端。
//            server: 'http://webuploader.duapp.com/server/fileupload.php',
            server: '/businessListAdd',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });
        // 监听文件上传成功事件,回显
        uploader.on( 'uploadSuccess', function( file,response ) {
//            $( '#'+file.id ).addClass('upload-state-done');
            var url = response.url;
            $('#shop-img').attr('src',url);
            $('#shop_img').val(url);
        });
    </script>
@stop
