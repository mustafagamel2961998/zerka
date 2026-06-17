<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Country;

use App\Actions\Dashboard\V1\Country\CreateAction;
use App\Actions\Dashboard\V1\Country\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\V1\Country\CountryRequest;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use App\Repositories\Contracts\Currency\CurrencyRepositoryInterface;
use App\Models\Country;
use App\DTOs\Dashboard\V1\Country\CreateDTO;
use App\DTOs\Dashboard\V1\Country\UpdateDTO;
class CountryController extends Controller
{
    public function __construct(
        protected CountryRepositoryInterface $country_repository_interface,
        protected CurrencyRepositoryInterface $currency_repository_interface
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = $this->country_repository_interface->getPaginated();
        return view('dashboard.country.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $country = new Country();
        $currencies = $this->currency_repository_interface->index();
        return view('dashboard.country.create', compact('country','currencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request, CreateAction $create_action)
    {
        $dto = CreateDTO::fromRequest($request);
        $create_action->execute($dto);
        return redirect()->route('dashboard.v1.countries.index')->with('success', __('crud.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $country = $this->country_repository_interface->findById($id);
        if(request()->wantsJson()){
            return response()->json([
                'status' => true,
                'data' => $country->cities
            ]);
        }
        return view('dashboard.country.show', compact('country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $country = $this->country_repository_interface->findById($id);
        $currencies = $this->currency_repository_interface->index();
        return view('dashboard.country.edit', compact('country','currencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, string $id,UpdateAction $update_action)
    {
        $dto = UpdateDTO::fromRequest($request);
        $update_action->execute($dto);
        return redirect()->route('dashboard.v1.countries.index')->with('success', __('crud.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->country_repository_interface->destroy($id);
        return redirect()->route('dashboard.v1.countries.index')->with('success', __('crud.deleted'));
    }
}
