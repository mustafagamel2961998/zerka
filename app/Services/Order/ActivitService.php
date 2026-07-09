<?php

namespace App\Services\Order;
use App\Models\OrderActivity;
class ActivitService
{
    public static function store($order,$title,$description,$properties=null,$status){
        OrderActivity::create([
            'order_id' => $order->id,
            'user_id' => auth()->user()->id,
            'title' => $title,
            'description' => $description,
            'properties' => $properties,
            'status' => $status,
            'created_at'=>config('app_settings.timezone'),
            'updated_at'=>config('app_settings.timezone'),
        ]);
    }
}