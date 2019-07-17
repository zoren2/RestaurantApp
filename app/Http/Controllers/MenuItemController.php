<?php

namespace App\Http\Controllers;

use App\Http\Requests\MenuItemPostRequest;
use App\MenuItem;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param MenuItemPostRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function store(MenuItemPostRequest $request)
    {
        MenuItem::create($request->validated()); // add all the data
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MenuItem $menuItem
     * @return \Illuminate\Http\Response
     */
    public function show(MenuItem $menuItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MenuItem $menuItem
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuItem $menuItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MenuItemPostRequest $request
     * @param MenuItem $menuItem
     */
    public function update(MenuItemPostRequest $request, MenuItem $menuItem)
    {
        $menuItem->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MenuItem $menuItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuItem $menuItem)
    {
        //
    }
}
