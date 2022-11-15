<?php

namespace ggss\upload\controllers;


use App\Http\Controllers\Controller;
use Ggss\upload\Generator\Image;
use Ggss\upload\Generator\Video;
use Ggss\Upload\Services\AliVodService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class UploadController extends Controller
{
     public function createImage(Request $request)
     {
            $validator = Validator::make($request->file(),[
                    'file' => 'require|image|size:'.config('media.max_file_size'),
            ],[
                    'file.require' => '请上传图片',
                    'file.image'   => '图片格式不正确',
                    'file.size'    => '图片最大上传大小10M'
            ]);
            if($validator->fails()){
                return [
                    'code' => 400,
                    'message' => $validator->errors(),
                ];
            }
            $model = (new Image($request->file('file')))->create();
            return [
                'code' => 200,
                'data' => $model
            ];
     }

     public function createVideo(Request $request)
     {
         $validator = Validator::make($request->all(),[
             'file' => [
                 'require',
                 function($attribute, $value, $fail){
                     $info = AliVodService::getPlayInfo($value);
                     if(empty($info)){
                         return $fail('视频信息有误');
                     }
                 }
             ],
         ],[
             'file.require' => '找不到视频videoId',
         ]);
         if($validator->fails()){
             return [
                 'code' => 400,
                 'message' => $validator->errors(),
             ];
         }
         $model = (new Video($request->input('file')))->create();
         return [
             'code' => 200,
             'data' => $model
         ];
     }
}
