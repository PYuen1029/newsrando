<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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

            // save last login time
            $user->last_login = Carbon::now();
            $user->save();

            $newsSources = $user->standardBackendOutput();
        } else {
            $user = null;
            $newsSources = null;
        }

        return view('home', ['user' => $user, 'newsSources' => $newsSources]);
    }

    public function test()
    {
        $websiteImagePath = public_path() . '/img/websiteImages/economist.com.png';
        $testPath = public_path() . '/img/WebsiteImages/foo3.png';

        $image = Image::make($websiteImagePath)
            ->crop(1500, 1500, 1200, 0)
            ->save($testPath);

        echo 'image created';

    }
}
