<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Repositories\Frontend\Client\ServiceProviders\Order;
use App\Order;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class OrderReviewServiceProvider extends BaseRepository
{
    public function reviewOrder($data){
        $this->validateReviewData($data)->validate();
        $check = $this->currentClientOrder($data['order_id']);
        if($check === true){
            $review = $this->storeReview($data);
            if($review){
                $status = true;
                $msg = ['Success' , 'Your review is add to this order'];
            }
            else{
                $status = false;
                $msg = ['Something went wrong. Please contact to customer support'];
            }
        }
        elseif($check === false){
            $status = false;
            $msg = ['Order Not Found' , 'if you have any issue please contact to customer support'];
        }
        else{
            $status = false;
            $msg = ['Error' , $check];
        }
        $data = array(
            'status' => $status,
            'msg' => $msg,
            'order_id' => $data['order_id'],
        );
        return $data;
    }

    private function validateReviewData($data){
        return Validator::make($data, [
            'order_id' => ['required', 'integer', 'alpha_dash' ],
            'client_review' => ['required', 'string', 'min:10' , 'regex:/^[a-zA-Z0-9,.!-\s]+$/'],
            'client_rating' => ['required', 'integer', 'min:1' , 'max:5'],
        ]);
    }

    private function currentClientOrder($order_id){
        $order = Order::where('id' , $order_id)->with('jobDetail')->first();
        if($order != null && $order->jobDetail->user_id === $this->getUserId()){
            if($order->status == Order::orderCompletedId){
                if($order->client_rating == null || $order->client_rating == 0){
                    return true;
                }
                else{
                    return "You already reviewed this order";
                }
            }
            else{
                return "You can only review the completed order";
            }
        }
        else{
            return false;
        }
    }

    private function storeReview($data){
        $order_id = $data['order_id'];
        $data = $this->processDataToStoreRating($data);
        if(Order::where('id' , $order_id)->update($data)){
            return true;
        }
        else{
            return false;
        }
    }

    private function processDataToStoreRating($data){
        unset($data['_token']);
        unset($data['order_id']);
        return $data;
    }
}