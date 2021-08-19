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
        $request->validate(
            [
                'activity'=>'required',
                'quantity_weight'=>'required',
                'quality_weight'=>'required',
                'time_weight'=>'required',
                'year'=>'required',
                'to'=>'required',
                'from'=>'required',
                'budget'=>'required',
                'goal'=>'required',
                'yearly_plan_id'=>'required',
                'department_id'=>'required'
            ]
            );

            DepartmentPlan::create($request->all());
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
                'year'=>'required',
                'to'=>'required',
                'from'=>'required',
                'budget'=>'required',
                'goal'=>'required',
                'yearly_plan_id'=>'required',
                'department_id'=>'required'
            ]
            );

            $departmentPlan->update($request->all());
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
