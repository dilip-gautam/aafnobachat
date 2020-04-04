<?php

namespace App\Http\Controllers;

use App\Paying;
use Illuminate\Http\Request;
use App\Http\Resources\FormatResource;

class PayingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Paying::all()->toArray());
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $details = Paying::create([
            'items' => $request->items,
            'amount' => $request->amount,
          ]);
          return new FormatResource($details);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paying  $paying
     * @return \Illuminate\Http\Response
     */
    public function show(Paying $paying)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paying  $paying
     * @return \Illuminate\Http\Response
     */
    public function edit(Paying $paying)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paying  $paying
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paying $paying)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paying  $paying
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paying $paying)
    {
        //
    }
}
