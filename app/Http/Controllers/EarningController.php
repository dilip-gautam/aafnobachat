<?php

namespace App\Http\Controllers;

use App\Earning;
use Illuminate\Http\Request;
use App\Http\Resources\FormatResource;

class EarningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //return response()->json(Earning::all()->toArray());
       return FormatResource::collection(Earning::all());
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
        
        $details = Earning::create([
        'items' => $request->items,
        'amount' => $request->amount,
      ]);
      return new FormatResource($details);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Earning  $earning
     * @return \Illuminate\Http\Response
     */
    public function show(Earning $earning)
    {
        return new FormatResource($earning);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Earning  $earning
     * @return \Illuminate\Http\Response
     */
    public function edit(Earning $earning)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Earning  $earning
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Earning $earning)
    {
         $this->validate($request, [
            'items' => 'required|max:255',
            'amount' => 'required|numeric',
        ]);
        $earning->update($request->only(['items', 'amount']));
        return new FormatResource($earning);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Earning  $earning
     * @return \Illuminate\Http\Response
     */
    public function destroy(Earning $earning)
    {
        $earning->delete();
        return response()->json(null , 204);
    }
}
