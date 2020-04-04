<?php

namespace App\Http\Controllers;

use App\Receive;
use Illuminate\Http\Request;
use App\Http\Resources\FormatResource;

class ReceiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Receive::all()->toArray());
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
        $details = Receive::create([
            'items' => $request->items,
            'amount' => $request->amount,
          ]);
        return new FormatResource($details); 
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function show(Receive $receive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function edit(Receive $receive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receive $receive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receive  $receive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receive $receive)
    {
        //
    }
}
