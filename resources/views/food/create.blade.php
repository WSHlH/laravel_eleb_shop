@extends('layout.default')
@section('title','添加食品')
@section('content')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
    <form action="{{route('food.store',['foodCategories'=>$foodCategories])}}" method="post" class="col-xs-6">
        <div class="form-group">
            <label for="food_name">食品名称:</label>
            <input type="text" name="food_name" class="form-control" id="food_name" value="{{old('food_name')}}">
        </div>
        {{--<div class="form-group">--}}
            {{--<label>食品图片:</label>--}}
            {{--<input type="file" name="food_image" value="{{old('food_image')}}">--}}
        {{--</div>--}}
        <div></div>
        <!--dom结构部分-->
        <div id="uploader-demo">
            <!--用来存放item-->
            <div id="fileList" class="uploader-list"></div>
            <div id="filePicker">食品图片</div>
            <br>
            <img src="" id="food-img" width="200">
            <input type="hidden" name="food_image" value="" id="food_image" class="form-control">
        </div>
        <div class="form-group">
            <label>食品价格:</label>
            <input type="text" name="price" class="form-control" value="{{old('price')}}">
        </div>
        <div class="form-group">
            <label>食品分类:</label>
            <select name="food_categories_id" class="form-control">
                @foreach($foodCategories as $foodCategory)
                <option value="{{$foodCategory->id}}" {{old($foodCategory->id)==$foodCategory->id?'selected':''}}>{{$foodCategory->name}}</option>
                    @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>食品描述:</label>
            <textarea name="description" cols="30" rows="6" class="form-control">{{old('description')}}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" value="确认添加" class="btn btn-block">
        </div>
        {{csrf_field()}}
    </form>
    <div>&emsp;</div>
    <img src="" alt="" class="col-xs-1">
    <img src="/img/7.jpg" alt="" width="40%">
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
            server: '/foodAdd',

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
            $('#food-img').attr('src',url);
            $('#food_image').val(url);
        });
    </script>
    @stop
