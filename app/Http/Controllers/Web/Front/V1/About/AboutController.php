<?php

namespace App\Http\Controllers\Web\Front\V1\About;

use App\Http\Controllers\Controller;
use App\Models\About;
class AboutController extends Controller
{
    public function index(){
        $about = About::query()->first();
        return view('front.about.index',compact('about'));
    }
}
