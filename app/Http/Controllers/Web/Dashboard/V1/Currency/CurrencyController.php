<?php

namespace App\Http\Controllers\Web\Dashboard\V1\Currency;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\Currency\CurrencyRepositoryInterface;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
