<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('account_status');
    }
    public function index()
    {
        if(Auth::user()->role_id == User::freelancerRoleId){
            return redirect()->route('freelancer.profile');
        }
        elseif(Auth::user()->role_id == User::clientRoleId){
            return view('frontend.client.index');
        }
    }
}
