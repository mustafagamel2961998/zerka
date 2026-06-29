<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Auth;

use App\Actions\Auth\LoginAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\DTOs\Auth\LoginDTO;
class AuthController extends Controller
{
    public function __construct(){}
    public function index(){
        return view('dashboard.auth.index');
    }

    public function login(LoginRequest $request,LoginAction $login_action){
        $dto = LoginDTO::fromRequest($request);
        $login_action->execute($dto);
        return redirect()
                    ->intended(route('dashboard.v1.home'))
                    ->with('success',__('global.login_success'));
       
    }
}
