<?php

namespace App\Http\Controllers\Web\V1\Country;

use App\Actions\Dashboard\V1\Country\GetPaginatedAction;
use App\Actions\Dashboard\V1\Country\GetCountAction;
use App\Actions\Dashboard\V1\Currency\GetAllAction as GetAllCurrencyAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Country\CountryRequest;
use Illuminate\Http\Request;
use Exception;
use App\Models\Country;
class CountryController extends Controller
{
    public function __construct(
        protected GetPaginatedAction $get_paginated_action,
        protected GetCountAction $get_count_action,
        protected GetAllCurrencyAction $get_all_currency_action,
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $countries = $this->get_paginated_action->execute();
            $counts = $this->get_count_action->execute();
            return view('dashboard.country.index',compact('countries','counts'));
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $country = new Country();
            $counts = $this->get_count_action->execute();
            $currencies = $this->get_all_currency_action->execute();
            return view('dashboard.country.create',compact('country','counts','currencies'));
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
