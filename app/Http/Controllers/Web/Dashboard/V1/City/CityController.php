<?php

namespace App\Http\Controllers\Web\Dashboard\V1\City;

use App\DTOs\Dashboard\V1\City\CreateDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\City\CityRequest;
use Illuminate\Http\Request;
use App\Repositories\Contracts\City\CityRepositoryInterface;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use App\Models\City;
use App\Actions\Dashboard\V1\City\CreateAction;
class CityController extends Controller
{
    public function __construct(
        protected CityRepositoryInterface $city_repository_interface,
        protected CountryRepositoryInterface $country_repository_interface
    ){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = $this->city_repository_interface->getPaginated();
        return view('dashboard.city.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $city = new City();
        $countries = $this->country_repository_interface->all();
        return view('dashboard.city.create',compact('city','countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CityRequest $request,CreateAction $create_action)
    {
        $dto = CreateDTO::fromRequest($request);
        $create_action->execute($dto);
        return redirect()->route('dashboard.v1.cities.index')->with('success', __('crud.created'));
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
        $city = $this->city_repository_interface->findById($id);
        $countries = $this->country_repository_interface->all();
        return view('dashboard.city.edit',compact('city','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CityRequest $request, string $id)
    {
        $dto = CreateDTO::fromRequest($request);
        $this->city_repository_interface->update($id,$dto->toArray());
        return redirect()->route('dashboard.v1.cities.index')->with('success', __('crud.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->city_repository_interface->destroy($id);
        return redirect()->route('dashboard.v1.cities.index')->with('success', __('crud.deleted'));
    }
}
