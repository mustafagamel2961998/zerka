<?php

namespace App\Http\Controllers\Web\Front\V1\Auth;

use App\Http\Controllers\Controller;
use App\Actions\Auth\LoginAction;
use App\DTOs\Auth\LoginDTO;
use App\Http\Requests\Auth\LoginRequest;

class AuthController extends Controller
{
    public function loginView(){
        return view('front.auth.login');
    }

    public function login(LoginRequest $request,LoginAction $login_action){
        $dto = LoginDTO::fromRequest($request);
        $login_action->execute($dto);
        return redirect()
                    ->intended(route('dashboard.v1.home'))
                    ->with('success',__('global.login_success'));
       
    }
}
