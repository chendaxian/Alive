<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Image;

trait UploadFile
{
    /**
     * 压缩图片上传复用函数
     *
     * @param $file, $path
     * @return mixed
     */
    public function uploadImg($file, $path)
    {
        $size = filesize($file->getRealPath())/1000;

        $picName = str_random(40).'.'.$file->getClientOriginalExtension();

        if ($size > 100) {
            $savePath = public_path($path).$picName;
            Image::make($file->getRealPath())->resize(400, null, function($constraint){
                $constraint->aspectRatio();
            })->save($savePath);
        } else {
            $file->move(public_path().$path, $picName);
        }
        return url($path.$picName);
    }
}
