<?php

namespace App\Http\Controllers\Web\V1\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
class AuthController extends Controller
{
    public function index(){
        try{
            return view('dashboard.auth.index');
        }catch(Exception $e){
            return $e->getMessage();
            // return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
