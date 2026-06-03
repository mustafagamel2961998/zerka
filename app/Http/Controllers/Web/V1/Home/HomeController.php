<?php

namespace App\Http\Controllers\Web\V1\Home;

use App\Actions\Dashboard\V1\Home\GetAllAction;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(protected GetAllAction $get_all_action){}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $home = $this->get_all_action->execute(); 
            return view('dashboard.home.index');
        }catch(Exception $e){
            return redirect()->route('errors.fallback.index')->with('error', $e->getMessage());
        }
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
