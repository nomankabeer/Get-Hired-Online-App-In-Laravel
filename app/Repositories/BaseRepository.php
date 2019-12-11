<?php
/**
 * Created by PhpStorm.
 * User: Noman Kabeer
 * Date: 24-Nov-2019
 * Time: 5:20 AM
 */
namespace App\Repositories;
use Auth;
class BaseRepository
{
    protected function getUserId(){
        return Auth::user()->id;
    }
    protected function processDataToStore(array $data){
        if(array_key_exists('_token' , $data)){
            unset($data['_token']);
        }
        if(array_key_exists('_method' , $data)){
            unset($data['_method']);
        }
        $data['user_id'] = $this->getUserId();
        return $data;
    }
    protected function removeTokenFromArray($data){
        unset($data['_token']);
        return $data;
    }
    protected function mergeCurrentUserIdToArray(array $data){
        $data['user_id'] = $this->getUserId();
        return $data;
    }
    protected function redirectRoute($status , $msg){
        if($status){
            return redirect()->route($this->redirect)->with('success' , $msg);
        }
        else{
            return redirect()->route($this->redirect)->withErrors($msg);
        }
    }
    protected function redirectURL($status , $msg){
        if($status){
            return redirect($this->redirect)->with('success' ,$msg);
        }
        else{
            return redirect($this->redirect)->withErrors($msg);
        }
    }
    protected function redirectView($status , $msg , $data = null){
        if($status){
            return view($this->redirect , compact('data'))->with('success' ,$msg);
        }
        else{
            return view($this->redirect, compact('data'))->withErrors($msg);
        }
    }
}