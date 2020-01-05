<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */

namespace App\Services\Classes;
use App\Job;
use Illuminate\Support\Facades\Validator;
use App\Services\BaseService;
class JobStore extends BaseService
{
    public function storeClientJob($data){
        $this->validateStoreData($data)->validate();
        $data = $this->processDataToStore($data);
        $data['job_id'] = uniqid();
        if(Job::create($data)){
            $status = true;
            $msg = ['Job Posted'];
        }
        else{
            $status = false;
            $msg = ['Something went wrong'];
        }
        $data = array(
            'status' => $status,
            'msg' => $msg
        );
        return $data;
    }
    private function validateStoreData($data){
        return Validator::make($data, [
            'budget' => ['required', 'integer', 'alpha_dash' ],
            'title' => ['required', 'string', 'min:10'],
            'description' => ['required', 'string', 'min:20'],
        ]);
    }
}