<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Currency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\Currency\CurrencyRepositoryInterface;
use App\Models\Currency;
use App\Http\Requests\Dashboard\V1\Currency\CurrencyRequest;
use App\Actions\Dashboard\V1\Currency\CreateAction;
use App\DTOs\Dashboard\V1\Currency\CreateDTO;
class CurrencyController extends Controller
{
    public function __construct(private CurrencyRepositoryInterface $currency_repository_interface){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currencies = $this->currency_repository_interface->getPaginated();
        return view('dashboard.currency.index',compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currency = new Currency();
        return view('dashboard.currency.create',compact('currency'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CurrencyRequest $request,CreateAction $create_action)
    {
        $dto = CreateDTO::fromRequest($request);
        $create_action->execute($dto);
        return redirect()->route('dashboard.v1.currencies.index')->with('success', __('crud.created'));
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
        $this->currency_repository_interface->destroy($id);
        return redirect()->route('dashboard.v1.currencies.index')->with('success', __('crud.deleted'));
    }
}
