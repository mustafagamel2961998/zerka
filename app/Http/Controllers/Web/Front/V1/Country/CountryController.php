<?php

namespace App\Http\Controllers\Web\Front\V1\Country;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;

class CountryController extends Controller
{
    public function __construct(
        private CountryRepositoryInterface $country_repository_interface
    ){}

    public function show($id){
        $country = $this->country_repository_interface->findById($id);
         if(request()->wantsJson()){
            return response()->json([
                'status' => true,
                'data' => $country->cities
            ]);
        }
        return response()->json(['status' => false], 404);
    }
}
