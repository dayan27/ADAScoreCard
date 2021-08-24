<?php

namespace App\Http\Controllers;

use App\Http\Resources\StrategicPlanResource;
use App\Models\ScoreCard;
use Illuminate\Http\Request;
use PhpParser\ErrorHandler\Collecting;

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
     * @param  \App\Models\ScoreCard  $scoreCard
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {
        $scoreCard=ScoreCard::find($id);
        // return ($scoreCard);
        return StrategicPlanResource::collection($scoreCard->strategic_plans());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScoreCard  $scoreCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $scoreCard=ScoreCard::findorfail($id);
                // dd($scoreCard);

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
     * @param  \App\Models\ScoreCard  $scoreCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScoreCard $scoreCard)
    {
        $scoreCard->delete();
    }
}
