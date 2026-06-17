<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Warehouse;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\Warehouse\WarehouseRepositoryInterface;
use App\Repositories\Contracts\Country\CountryRepositoryInterface;
use App\Models\Warehouse;
use App\Http\Requests\Dashboard\V1\Warehouse\WarehouseRequest;
use App\Actions\Dashboard\V1\Warehouse\CreateAction;
use App\DTOs\Dashboard\V1\Warehouse\CreateDTO;
use App\Actions\Dashboard\V1\Warehouse\UpdateAction;
use App\DTOs\Dashboard\V1\Warehouse\UpdateDTO;
class WarehouseController extends Controller
{
    public function __construct(
        private WarehouseRepositoryInterface $warehouse_repository_interface, 
        private CountryRepositoryInterface $country_repository_interface
        ){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = $this->warehouse_repository_interface->getPaginated();
        return view('dashboard.warehouse.index',compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $warehouse = new Warehouse();
        $countries = $this->country_repository_interface->all();
        return view('dashboard.warehouse.create',compact('warehouse','countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WarehouseRequest $request,CreateAction $create_action)
    {
        $dto = CreateDTO::fromRequest($request);
        $create_action->execute($dto);
        return redirect()->route('dashboard.v1.warehouses.index')->with('success', __('crud.created'));
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
        $warehouse = $this->warehouse_repository_interface->findById($id);
        $countries = $this->country_repository_interface->all();
        return view('dashboard.warehouse.edit',compact('warehouse','countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WarehouseRequest $request,UpdateAction $update_action, string $id)
    {
        $dto = UpdateDTO::fromRequest($request);
        $update_action->execute( $dto);    
        return redirect()->route('dashboard.v1.warehouses.index')->with('success', __('crud.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
