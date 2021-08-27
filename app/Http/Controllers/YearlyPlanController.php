<?php

namespace App\Http\Controllers;

use App\Models\YearlyPlan;
use Illuminate\Http\Request;

class YearlyPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return YearlyPlan::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $yearlyPlan=new YearlyPlan();
        $request->validate([
            'action'=>'required',
            'budget'=>'required',
            'to'=>'required',
            'from'=>'required',
            // 'phase'=>'required',
            // 'year'=>'required',


        ]);
        $yearlyPlan->action=$request->action;
        $yearlyPlan->budget=$request->budget;
        // $yearlyPlan->phase=$request->phase;

        $to = strtotime($request->to);
        $from = strtotime($request->from);
        $toformat = date('Y-m-d',$to);
        $fromformat = date('Y-m-d',$from);
        $yearlyPlan->to=$toformat;
        $yearlyPlan->from=$fromformat;
        $yearlyPlan->year_card_id=$request->year_card_id;
        $yearlyPlan->strategic_plan_id=$request->strategic_plan_id;
        // $year = strtotime($request->to);
        // $yearformat = date('Y-m-d',$year);
        $yearlyPlan->make_visible=0;

        $yearlyPlan->save();

        return $yearlyPlan;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(YearlyPlan $yearlyPlan)
    {
        return $yearlyPlan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,YearlyPlan $yearlyPlan)
    {
        $request->validate([
            'action'=>'required',
            'budget'=>'required',
            'to'=>'required',
            'from'=>'required',
            // 'phase'=>'required',
            // 'year'=>'required',


        ]);
        $yearlyPlan->action=$request->action;
        $yearlyPlan->budget=$request->budget;
        // $yearlyPlan->phase=$request->phase;

        $to = strtotime($request->to);
        $from = strtotime($request->from);
        $toformat = date('Y-m-d',$to);
        $fromformat = date('Y-m-d',$from);
        $yearlyPlan->to=$toformat;
        $yearlyPlan->from=$fromformat;
        $yearlyPlan->year_card_id=$request->year_card_id;
        $yearlyPlan->strategic_plan_id=$request->strategic_plan_id;

        $yearlyPlan->make_visible=0;
        $yearlyPlan->save();

        return $yearlyPlan;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(YearlyPlan $yearlyPlan)
    {
        $yearlyPlan->delete();
    }
}
