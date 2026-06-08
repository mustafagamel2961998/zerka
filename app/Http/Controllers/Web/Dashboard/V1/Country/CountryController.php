<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Country;

use App\Actions\Dashboard\V1\Country\CreateAction;
use App\Actions\Dashboard\V1\Country\GetPaginatedAction;
use App\Actions\Dashboard\V1\Country\GetCountAction;
use App\Actions\Dashboard\V1\Currency\GetAllAction as GetAllCurrencyAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Country\CountryRequest;
use Illuminate\Http\Request;
use Exception;
use App\Models\Country;
use App\DTOs\Dashboard\V1\Country\CreateDTO;
class CountryController extends Controller
{
    public function __construct(){}
    /**
     * Display a listing of the resource.
     */
    public function index(GetCountAction $get_count_action,GetPaginatedAction $get_paginated_action)
    {
            $countries = $get_paginated_action->execute();
            $counts = $get_count_action->execute();
            return view('dashboard.country.index',compact('countries','counts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(GetCountAction $get_count_action,GetAllCurrencyAction $get_all_currency_action)
    {
            $country = new Country();
            $counts = $get_count_action->execute();
            $currencies = $get_all_currency_action->execute();
            return view('dashboard.country.create',compact('country','counts','currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request,CreateAction $create_action)
    {
            $dto = CreateDTO::fromRequest($request);
            return $create_action->execute($dto);
            return redirect()->route('dashboard.v1.countries.index')->with('success',__('crud.created'));
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
