<?php

namespace App\Http\Controllers;

use App\Http\Resources\StrategicPlanResource;
use App\Models\Department;
use App\Models\ScoreCard;
use App\Models\StrategicPlan;
use App\Models\YearCard;
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
        return $scoreCard;
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
        $sps=$scoreCard->strategic_plans;

        $yearCard=[];
        foreach($sps as $sp) {
            foreach($sp->yearly_plans as $value) {

                // if(!array_key_exists($value->year_card->id,$yearCard)){
                //     $yearCard[]=$value->year_card;

                // }
                $yearCard[]=$value->year_card;

            }
        }
        $yearCard= array_values(array_unique($yearCard));
        $departments=Department::all('id','name');
       // $departments->makeHidden('id');
      // return $sps;
        return response()->json([
            'strategic_plans'=>$sps->makeHidden('yearly_plans','pivot')->load('departments'),
            'year_cards'=>$yearCard,
            'departments'=>$departments
        ],201);
        //return StrategicPlanResource::collection($scoreCard->strategic_plans);

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
          return $scoreCard;

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
