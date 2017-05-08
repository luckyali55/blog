<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Front\BaseController;

class HomeController extends BaseController
{
    public function index(){
        return view('front.home');
    }
}
