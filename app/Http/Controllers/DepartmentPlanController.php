<?php

namespace App\Http\Controllers;

use App\Models\DepartmentPlan;
use Illuminate\Http\Request;

class DepartmentPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DepartmentPlan::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //  $departmentPlan=new DepartmentPlan();
        $request->validate(
            [
                'activity'=>'required',
                'quantity_weight'=>'required',
                'quality_weight'=>'required',
                'time_weight'=>'required',
                'to'=>'required',
                'from'=>'required',
                'budget'=>'required',
                'goal'=>'required',
                'yearly_plan_id'=>'required',
                'department_id'=>'required',
                'department_card_id'=>'required'
            ]
            );

            $data=$request->all();

            $to = strtotime($request->to);
            $from = strtotime($request->from);
            $toformat = date('Y-m-d',$to);
            $fromformat = date('Y-m-d',$from);
            $data['to']=$toformat;
            $data['from']=$fromformat;
            return DepartmentPlan::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentPlan $departmentPlan)
    {
        return $departmentPlan;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepartmentPlan $departmentPlan)
    {
        $request->validate(
            [
                'activity'=>'required',
                'quantity_weight'=>'required',
                'quality_weight'=>'required',
                'time_weight'=>'required',
                'to'=>'required',
                'from'=>'required',
                'budget'=>'required',
                'goal'=>'required',
                'yearly_plan_id'=>'required',
                'department_id'=>'required'
            ]
            );

            $data=$request->all();

            $to = strtotime($request->to);
            $from = strtotime($request->from);
            $toformat = date('Y-m-d',$to);
            $fromformat = date('Y-m-d',$from);
            $data['to']=$toformat;
            $data['from']=$fromformat;
            $departmentPlan->update($data);
            return $departmentPlan;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentPlan $departmentPlan)
    {
        $departmentPlan->delete();
    }
}
