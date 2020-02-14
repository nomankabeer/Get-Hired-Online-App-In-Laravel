<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDelivery extends Model
{
    protected $table = "order_delivery";

    public const orderDeliveryStatusPendingId = 1;
    public const orderDeliveryStatusAcceptedId = 2;
    public const orderDeliveryStatusRejectedId = 3;

    public const orderDeliveryStatusPending = "Pending";
    public const orderDeliveryStatusAccepted = "Accepted";
    public const orderDeliveryStatusRejected = "Rejected";

    protected $fillable = ['order_id' , 'status' , 'content' , 'file' , 'created_at' , 'updated_at'];

    protected $appends = ['orderStatus'];
    public function getorderStatusAttribute(){
        switch ($this->status){
            case(self::orderDeliveryStatusPendingId):
                return self::orderDeliveryStatusPending;
            case(self::orderDeliveryStatusAcceptedId):
                return self::orderDeliveryStatusAccepted;
            case(self::orderDeliveryStatusRejectedId):
                return self::orderDeliveryStatusRejected;
        }
    }
}
