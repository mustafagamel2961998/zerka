<?php

namespace App\Services\Dashboard\Media;
use Illuminate\Http\UploadedFile;

class MediaService
{
    public function __construct()
    {
        //
    }
    public static function singleFileUpload($model, $collection, $file)
    {
        if($file != null && !empty($file) && $file instanceof UploadedFile){
            $model->addMedia($file)
                  ->toMediaCollection($collection);
        }

    }
    public static function multipleFileUpload($model, $collection, array $files =[])
    {
        foreach($files as $file){
            if($file != null && !empty($file) && $file instanceof UploadedFile){

                $model->addMedia($file)
                    ->toMediaCollection($collection);
            }
        }
    }
}