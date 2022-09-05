<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
    //    dd('ciao sono la dashborard privata');
        // ora che abbiamo fatto la view, deve tornare la view e non il dd
        return view ('admin.home');
    }
}
