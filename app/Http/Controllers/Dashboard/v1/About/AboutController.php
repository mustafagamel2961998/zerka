<?php

namespace App\Http\Controllers\Dashboard\v1\About;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function edit(){
        $about = About::query()->first();
        return view('dashboard.about.edit',compact('about'));
    }
    
    public function update(Request $request, $id){
        $about = About::find($id);
        $about->update();
        foreach($request['content'] as $key => $value){
            $about->translations()->updateOrCreate([
                'locale' => $key,
            ],[
                'content' => $value,
            ]);
        }

        // $about->update(request()->all());
        return redirect()->back()->with('success', __('crud.updated'));
    }
}
