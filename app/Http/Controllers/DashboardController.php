<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware(['auth']);
    // }

    public function index()
    {
        //dd(auth()->user()->posts);

        //dd(auth()->user());
        //$name = auth()->user()->name;dd($name);
        //auth('name of guard user/admin/supervisor);

        return view('dashboard');
    }
}
