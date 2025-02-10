<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        return view('user.home');
    }
    public function redirect()
    {
       if(Auth::id()){
           if(Auth::user()->usertype == '0'){
               return view('user.home');
            //    return view('dashboard');
           }
           else{
               return view('admin.home');
           }
       }
       else{
           return redirect()->back();
       }
    }
}
