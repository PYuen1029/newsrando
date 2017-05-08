<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
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
