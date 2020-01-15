<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "order";

    public const orderActiveId = 1;
    public const orderCompletedId = 2;
    public const orderRejectedId = 3;
    public const orderDeliveredId = 4;
    public const orderCanceledId = 5;

    public const orderActive = "Active";
    public const orderCompleted = "Completed";
    public const orderRejected = "Rejected";
    public const orderDelivered = "Delivered";
    public const orderCanceled = "Canceled";

    protected $fillable = [ 'order_id' , 'bid_id' , 'job_id' , 'status' , 'client_review' , 'freelancer_review' , 'client_rating' , 'freelancer_rating' , 'created_at' , 'updated_at'];

    protected $appends = array('order_status' , 'allow_delivery');
    public function getOrderStatusAttribute(){
        switch ($this->status){
            case(self::orderActiveId):
                $status = self::orderActive;break;
            case(self::orderDeliveredId):
                $status = self::orderDelivered;break;
            case(self::orderRejectedId):
                $status = self::orderRejected;break;
            case(self::orderCompletedId):
                $status = self::orderCompleted;break;
            case(self::orderCanceledId):
                $status = self::orderCanceled;break;
        }
        return $status;
    }

    public function orderDeliveries(){
        return $this->hasMany('App\OrderDelivery' , 'order_id' , 'id');
    }
    public function jobDetail(){
        return $this->hasOne('App\job' , 'id' , 'job_id');
    }
    public function bidDetail(){
        return $this->hasOne('App\Bids' , 'id' , 'bid_id');
    }
    public function getallowDeliveryAttribute(){
        $status = true;
        if($this->status == self::orderCompletedId || $this->status == self::orderCanceledId){
            $status = false;
        }
        return $status;
    }
}
