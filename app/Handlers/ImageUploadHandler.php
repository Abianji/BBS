<?php

namespace App\Handlers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageUploadHandler
{
    // 只允许以下后缀名的图片文件上传
    protected $allowed_ext = ["png", "jpg", "gif", 'jpeg'];

    public function save($file, $folder, $file_prefix)
    {
        // 获取文件的后缀名，因图片从剪贴板里黏贴时后缀名为空，所以此处确保后缀一直存在
        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        // 如果上传的不是图片将终止操作
        if ( ! in_array($extension, $this->allowed_ext)) {
            return false;
        }

        // 拼接文件名
        $fileName = $file_prefix . '_' . time() . '_' . Str::random(10) . '.' . $extension;

        // 构建存储的文件夹规则
        $folderName = "$folder/" . date("Y/m/d", time());

        Storage::disk('local')->put('public/' . $folderName . '/' .$fileName, file_get_contents($file->getRealPath()));

        return  'storage/' . $folderName . '/' . $fileName;
    }
}