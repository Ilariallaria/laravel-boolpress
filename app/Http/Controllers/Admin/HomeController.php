<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
    //    dd('ciao sono la dashborard privata');
        // ora che abbiamo fatto la view, deve tornare la view e non il dd

        $user = Auth::user();

        $data = [
            'user'=> $user
        ];
        return view ('admin.home', $data);
    }
}
