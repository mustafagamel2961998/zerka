<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Auth;

use App\Actions\Dashboard\V1\Auth\LoginAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use Illuminate\Http\Request;
use Exception;
class AuthController extends Controller
{
    public function __construct(protected LoginAction $login_action){}
    public function index(){
        return view('dashboard.auth.index');
    }

    public function login(LoginRequest $request){
         
        $this->login_action->execute($request->validated());
        return redirect()
                    ->route('dashboard.v1.home')
                    ->with('success',__('dashboard.login_success'));
       
    }
}
