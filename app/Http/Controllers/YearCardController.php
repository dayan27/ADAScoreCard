<?php

namespace App\Http\Controllers;

use App\Models\YearCard;
use Illuminate\Http\Request;

class YearCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return YearCard::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $yearCard=new YearCard();
        $request->validate([
            'year'=>'required'
        ]);
        $yearCard->create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\YearCard  $yearCard
     * @return \Illuminate\Http\Response
     */
    public function show(YearCard $yearCard)
    {
        return $yearCard;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\YearCard  $yearCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, YearCard $yearCard)
    {
        $request->validate([
            'year'=>'required',
        ]);
        $yearCard->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\YearCard  $yearCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(YearCard $yearCard)
    {
       return $yearCard->delete();
    }
}
