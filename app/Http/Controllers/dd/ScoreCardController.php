<?php

namespace App\Http\Controllers;

use App\Models\ScoreCard;
use Illuminate\Http\Request;

class ScoreCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ScoreCard::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $scoreCard=new ScoreCard();
        $request->validate([
          'name'=>'required',
          'to'=>'required',
          'from'=>'required',
          'description'=>'required'
        ]);

        $scoreCard->name=$request->name;
        $scoreCard->description=$request->description;
        $to = strtotime($request->to);
        $from = strtotime($request->from);
        $toformat = date('Y-m-d',$to);
        $fromformat = date('Y-m-d',$from);
        $scoreCard->to=$toformat;
        $scoreCard->from=$fromformat;
        $scoreCard->save();




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ScoreCard $scoreCard)
    {
        return $scoreCard;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ScoreCard $scoreCard)
    {
        $request->validate([
            'name'=>'required',
            'to'=>'required',
            'from'=>'required',
            'description'=>'required'
          ]);
          $scoreCard->name=$request->name;
          $scoreCard->description=$request->description;
          $scoreCard->to=$request->to;
          $scoreCard->from=$request->from;
          $scoreCard->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScoreCard $scoreCard)
    {

        $scoreCard->delete;
    }
}
