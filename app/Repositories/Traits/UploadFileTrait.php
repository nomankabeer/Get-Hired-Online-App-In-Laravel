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
    private function getDateMonthToPath($path){
        $now = Carbon::now();
        return 'storage/'.$path.'/'.$now->year.'/'.$now->month;
    }
}