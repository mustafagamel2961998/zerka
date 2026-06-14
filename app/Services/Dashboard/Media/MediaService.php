<?php

namespace App\Services\Dashboard\Media;
use Illuminate\Http\UploadedFile;

class MediaService
{
    public function __construct()
    {
        //
    }
    public static function singleFileUpload($model, $collection, $file,$update = false)
    {
        if($file != null && !empty($file) && $file instanceof UploadedFile){
             if ($update) {
                $model->clearMediaCollection($collection);
            }
            $model->addMedia($file)
                  ->toMediaCollection($collection);
        }

    }
}