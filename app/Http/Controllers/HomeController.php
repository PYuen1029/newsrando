<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()) {
            $user = Auth::user();
            $newsSources = $user->newsSources()->with('frontpages')->get()->toJson();
        } else {
            $user = null;
            $newsSources = null;
        }

        return view('home', ['user' => $user, 'newsSources' => $newsSources]);
    }
}
