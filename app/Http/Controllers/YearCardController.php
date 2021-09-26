<?php

namespace App\Http\Controllers;

use App\Models\ScoreCard;
use App\Models\StrategicPlan;
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
     /**
     * Display the specified resource.
     *
     * @param  \App\Models\YearCard  $yearCard
     * @return \Illuminate\Http\Response
     */
    public function get_yearly_plan( $score_card_id)
    {
       $user=auth()->user();
       $yps_by_score_cards=null;
        $yp_final=[];
        $st_plans= StrategicPlan::where('score_card_id',$score_card_id)->get();

        foreach ($st_plans as $st_plan) {
            //return $st_plan->yearly_plans;
        //    if($st_plan->departments->first()->department_id==2){
        //     return $st_plan->departments;
        // }

           $st_departments= $st_plan->departments;
           foreach ($st_departments as $st_department) {
            if($st_department->id==request()->department_id){
                $yps=$st_plan->yearly_plans;
                foreach($yps as $yp){
                    array_push($yp_final,$yp);


                }



            }
        }
       // return $yp_final;

          //->department_id;
        }
        return $yp_final;

        // $yp_final=[];
        // foreach ($yps_by_score_cards as $yps_by_score_card) {
        // return  $strategic_plan_id=$yps_by_score_card->strategic_plans()->id;
       // }



    }
}
