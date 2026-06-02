<?php

namespace App\Http\Controllers\Web\V1\Auth;

use App\Actions\Dashboard\V1\Auth\LoginAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Auth\LoginRequest;
use Illuminate\Http\Request;
use Exception;
class AuthController extends Controller
{
    public function __construct(protected LoginAction $login_action){}
    public function index(){
        try{
            return view('dashboard.auth.index');
        }catch(Exception $e){
            return redirect()->route('errors.fallback.index')->with('error', $e->getMessage());
        }
    }

    public function login(LoginRequest $request){
         
         try{

         
            $this->login_action->execute($request->validated());


            
            return 'login success';

            return redirect()
                        ->route('v1.dashboard.home')
                        ->with('success',__('dashboard.login_success'));
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
