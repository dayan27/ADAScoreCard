<?php

namespace App\Http\Controllers;

use App\Models\DepartmentCard;
use App\Models\Term;
use App\Models\TermSubActivity;
use Illuminate\Http\Request;

class DepartmentCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DepartmentCard::all();
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
                'year'=>'required',
                'number_of_term'=>'required',

            ]
            );

            return DepartmentCard::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DepartmentCard  $departmentCard
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentCard $departmentCard)
    {
        $term_sub_activities=[];
        $term_activities=[];
        $yearly_plans=[];
        $department_plans=$departmentCard->department_plans;
        // $term_sub_activities=
           // return $department_plans;
         foreach ($department_plans as  $department_plan) {
            $activity=$department_plan->term_activity;
            if($activity){

                $term_activities[]=$activity;
                // $term_activities;
            }


             $yearly_plans[]=$department_plan->yearly_plan;
           //  $a= $activity->term_sub_activities;
             $a=TermSubActivity::where('term_activity_id',$activity['id'])->get();



                foreach ($a as  $term_sub_activity) {
                    $term_sub_activities[]=$term_sub_activity;
                }


        }

        return response()->json([
            'department_plans'=>$department_plans->load('perspective:id,title'),
            'term_activitis'=> $term_activities,
            'yearly_plans'=> $yearly_plans,
            'term_sub_activitis'=> $term_sub_activities,
            'terms'=>$departmentCard->terms

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DepartmentCard  $departmentCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepartmentCard $departmentCard)
    {
        $request->validate(
            [
                'year'=>'required',
                'number_of_term'=>'required',

            ]
            );

            $departmentCard->update($request->all());
            return $departmentCard;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DepartmentCard  $departmentCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentCard $departmentCard)
    {
        $departmentCard->delete();
    }

    public function make_visible($id)
    {
        $deptCard= DepartmentCard::find($id);
        $deptCard->make_visible=request()->visiblity;
        $deptCard->save();
        return $deptCard;

    }
}
