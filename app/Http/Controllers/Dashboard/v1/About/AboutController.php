<?php

namespace App\Http\Controllers\Dashboard\v1\About;

use App\Http\Controllers\Controller;
use App\Models\About;
class AboutController extends Controller
{
    public function edit(){
        $about = About::query()->first();
        return view('dashboard.about.edit',compact('about'));
    }
}
