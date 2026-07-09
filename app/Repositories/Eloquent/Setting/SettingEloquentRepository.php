<?php

namespace App\Repositories\Eloquent\Setting;
use App\Repositories\Contracts\Setting\SettingRepositoryInterface;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use App\Services\Dashboard\Media\MediaService;

class SettingEloquentRepository implements SettingRepositoryInterface
{
    public function __construct()
    {
        //
    }
    public function update(array $data)
    {
        
        $setting = Setting::find($data['id']);
        $setting->update($data);
    
        foreach($data['name'] as $key => $value){
            $setting->translations()->updateOrCreate([
                'locale' => $key,
            ],[
                'name' => $value,

            ]);
        }
        MediaService::singleFileUpload($setting, 'logo', $data['logo']);
        Cache::forget('app_settings');
        $updatedSetting = Cache::rememberForever('app_settings', function () use ($setting) {
            return Setting::query()->first();
        });

        return $updatedSetting;
    }
}