<?php

namespace App\Http\Controllers;

use App\Models\StrategicPlan;
use Illuminate\Http\Request;

class StrategicPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StrategicPlan::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $strategicPlan=new StrategicPlan();
        $request->validate([
            'action'=>'required',
            // 'term'=>'required',
           // 'perspective'=>'required',
            'from'=>'required',
            'to'=>'required',
            // 'phase'=>'required',

        ]);
        $strategicPlan->action=$request->action;
        $strategicPlan->phase=$request->phase;
        $strategicPlan->perspective_id=$request->perspective_id;
        $to = strtotime($request->to);
        $from = strtotime($request->from);
        $toformat = date('Y-m-d',$to);
        $fromformat = date('Y-m-d',$from);
        $strategicPlan->from=$toformat;
        $strategicPlan->to=$fromformat;
        // $strategicPlan->phase=$request->phase;
        $strategicPlan->score_card_id=$request->scoreCardId;
        $strategicPlan->save();
        $departmentId=$request->get('depid');
        $strategicPlan->departments()->attach($departmentId);

        // if( $strategicPlan->save()) {
        //     return $this->successResponse('successfully saved ',202);
        // }
        // else{
        //     return $this->errorResponse('fail to save',501);
        // }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(StrategicPlan $strategicPlan)
    {
        return $strategicPlan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        $strategicPlan=StrategicPlan::findorfail($id);
        //   dd($strategicPlan);
        $request->validate([
            'action'=>'required',
            'term'=>'required',
             'perspective_id'=>'required',
            'from'=>'required',
            'to'=>'required',
            // 'phase'=>'required',

        ]);
        $strategicPlan->action=$request->action;
        $strategicPlan->term=$request->term;
        $strategicPlan->perspective_id=$request->perspective_id;

        $to = strtotime($request->to);
        $from = strtotime($request->from);
        $toformat = date('Y-m-d',$to);
        $fromformat = date('Y-m-d',$from);
        $strategicPlan->from=$toformat;
        $strategicPlan->to=$fromformat;
        // $strategicPlan->phase=$request->phase;
        $strategicPlan->score_card_id=$request->scoreCardId;
        $strategicPlan->save();
        $departmentId=$request->get('depid');
        $strategicPlan->departments()->sync($departmentId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( StrategicPlan $strategicPlan)
    {
        $strategicPlan->delete();
    }
}
