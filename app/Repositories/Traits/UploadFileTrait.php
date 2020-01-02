<?php
namespace App\Repositories\Traits;
use Illuminate\Support\Carbon;
Trait UploadFileTrait {
    public function uploadImage($image , $path){
        $path = $this->getDateMonthToPath($path);
        $name = $path.'/'.time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('/').$path , $name);
        return $name;
    }
    public function uploadOrderFiles($file , $order_id , $path = 'order_deliveries'){
        $path = $this->getDateMonthToPathOfOrder($path , $order_id);
        $name = $path.'/'.time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('/').$path , $name);
        return $name;
    }
    private function getDateMonthToPathOfOrder($path , $order_id){
        $now = Carbon::now();
        return 'storage/'.$path.'/'.$now->year.'/'.$now->month.'/'.$order_id;
    }
    private function getDateMonthToPath($path){
        $now = Carbon::now();
        return 'storage/'.$path.'/'.$now->year.'/'.$now->month;
    }
}