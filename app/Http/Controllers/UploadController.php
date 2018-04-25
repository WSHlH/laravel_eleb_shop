<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use OSS\Core\OssException;

class UploadController extends Controller
{
    public function food(Request $request)
    {
//        dd($request->file('file'));
//        $fileName = $request->file('file')->store('public/date'.date('Y-m-d'));
        $fileName = $request->file('file')->store('public/food');

        $client = App::make('aliyun-oss');
        try{
            $client->uploadFile('lavarel-eleb',$fileName,storage_path('app/'.$fileName));
//            $client->uploadFile('lavarel-eleb',$_FILES['food_image']['name'],$_FILES['food_image']['tmp_name']);
            $filename = 'https://lavarel-eleb.oss-cn-beijing.aliyuncs.com/'.urlencode($fileName);
            return ['url'=>$filename];
//            https://lavarel-eleb.oss-cn-beijing.aliyuncs.com/img-2fb7090881784b964440cf9d77d321c6.jpg
        }catch(OssException $e){
            echo '上传失败!';
            printf($e->getMessage().'\n');
        }
    }



    public function business(Request $request)
    {
        $fileName = $request->file('file')->store('public/shop');

        $client = App::make('aliyun-oss');
        try{
            $client->uploadFile('lavarel-eleb',$fileName,storage_path('app/'.$fileName));
//            $client->uploadFile('lavarel-eleb',$_FILES['food_image']['name'],$_FILES['food_image']['tmp_name']);
            $filename = 'https://lavarel-eleb.oss-cn-beijing.aliyuncs.com/'.urlencode($fileName);
            return ['url'=>$filename];
//            https://lavarel-eleb.oss-cn-beijing.aliyuncs.com/img-2fb7090881784b964440cf9d77d321c6.jpg
        }catch(OssException $e){
            echo '上传失败!';
            printf($e->getMessage().'\n');
        }
    }
}
