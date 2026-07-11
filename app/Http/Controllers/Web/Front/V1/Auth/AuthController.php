<?php

namespace App\Http\Controllers\Web\Front\V1\Auth;

use App\Http\Controllers\Controller;
use App\Actions\Auth\LoginAction;
use App\DTOs\Auth\LoginDTO;
use App\Actions\Auth\RegisterAction;
use App\DTOs\Auth\RegisterDTO;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use App\Repositories\Contracts\City\CityRepositoryInterface;
class AuthController extends Controller
{
    public function __construct(
        private CountryRepositoryInterface $country_repository_interface,
        private CityRepositoryInterface $city_repository_interface,
        ){}
        
    public function loginView(){
        if(auth()->check()){
            return redirect()->route('home');
        }
        return view('front.auth.login');
    }


    public function login(LoginRequest $request,LoginAction $login_action){
        $dto = LoginDTO::fromRequest($request);
        $login_action->execute($dto);
        return redirect()
                    ->intended(route('home'))
                    ->with('success',__('global.login_success'));
       
    }

    public function registerView(){
        $countries = $this->country_repository_interface->baseQuery()
                          ->active()
                          ->latest()
                          ->with('currentTranslation:id,country_id,name')
                          ->get();
        $cities = $this->city_repository_interface->all();                  
        return view('front.auth.register',compact('countries','cities'));
    }
    public function register(RegisterRequest $request,RegisterAction $register_action){
        $dto = RegisterDTO::fromRequest($request);
        $register_action->execute($dto);
        return redirect()->route('home')->with('success',__('global.register_success'));
    }
    public function logout(){
        auth()->logout();
        return redirect()->route('home');
    }
}
