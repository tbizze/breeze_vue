<?php

namespace App\Http\Controllers;

use App\Models\FaturaItem;
use App\Http\Requests\StoreFaturaItemRequest;
use App\Http\Requests\UpdateFaturaItemRequest;

class FaturaItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        dd('Fatura item');
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
    public function store(StoreFaturaItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(FaturaItem $faturaItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FaturaItem $faturaItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaturaItemRequest $request, FaturaItem $faturaItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FaturaItem $faturaItem)
    {
        //
    }
}
