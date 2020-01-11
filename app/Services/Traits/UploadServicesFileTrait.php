<?php
namespace App\Services\Traits;
use Illuminate\Support\Carbon;
Trait UploadServicesFileTrait {

    private static function uploadImage($image , $path){
        $now = Carbon::now();
        $path = 'storage/'.$path.'/'.$now->year.'/'.$now->month;
        $name = $path.'/'.time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('/').$path , $name);
        return $name;
    }
    private static function uploadOrderFiles($file , $order_id , $path = 'order_deliveries'){
        $now = Carbon::now();
        $path = 'storage/'.$path.'/'.$now->year.'/'.$now->month.'/'.$order_id;
        $name = $path.'/'.time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('/').$path , $name);
        return $name;
    }
}