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
        if ($update) {
            $model->clearMediaCollection($collection);
        }
        if(isset($file) && isset($file) instanceof UploadedFile){
          $model->addMedia($file)
                ->toMediaCollection($collection);
        }

    }
}