<?php

namespace App\Http\Controllers;

use App\Models\ScoreCard;
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

        $request->validate([
            'year'=>'required',
            'score_card_id'=>'required'
        ]);
        return YearCard::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\YearCard  $yearCard
     * @return \Illuminate\Http\Response
     */
    public function show( $yearCard)
    {
       $user=auth()->user();
       $yp=null;
       $yearCard=YearCard::find($yearCard);
       if($user->role=='manager'){
        $yp= $yearCard->yearly_plans;

       }
       else if($user->role=='employee'){
           if($yearCard->make_visible){
            $yp= $yearCard->yearly_plans;
           }

       }
       else if($user->role=='department head'){
        if($yearCard->make_visible){
         $yp= $yearCard->yearly_plans;
        }

    }

    return $yp != null ? $yp : [];
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
        return $yearCard;
    }


    public function destroy(YearCard $yearCard)
    {
        $yearCard->delete();
    }


    public function make_visible($id)
    {
        $yearCard= YearCard::find($id);
        $yearCard->make_visible=request()->visiblity;
        $yearCard->save();
        return $yearCard;

    }
}
