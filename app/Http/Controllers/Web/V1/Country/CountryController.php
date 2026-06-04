<?php

namespace App\Http\Controllers\Web\V1\Country;

use App\Actions\Dashboard\V1\Country\GetAllAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function __construct(protected GetAllAction $get_all_action){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->get_all_action->execute();
        $countries = $data['countries'];
        $counts = $data['counts'];
        return view('dashboard.country.index',compact('countries','counts'));
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
