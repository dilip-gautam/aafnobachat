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
        $this->validate($request, [
            'items' => 'required|max:255',
            'amount' => 'required|numeric',
        ]);
        
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
        return new FormatResource($paying);
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
        $this->validate($request, [
            'items' => 'required|max:255',
            'amount' => 'required|numeric',
        ]);
        $paying->update($request->only(['items', 'amount']));
        return new FormatResource($paying);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paying  $paying
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paying $paying)
    {
        $paying->delete();
        return response()->json(null , 204);
    }
}
