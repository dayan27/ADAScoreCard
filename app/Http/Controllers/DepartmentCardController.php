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
                'from'=>'required',
                'to'=>'required',
                'score_card_id'=>'required'

            ]
            );

            $data=$request->all();

            $to = strtotime($request->to);
            $from = strtotime($request->from);
            $toformat = date('Y-m-d',$to);
            $fromformat = date('Y-m-d',$from);
            $data['to']=$toformat;
            $data['from']=$fromformat;
            $department_card= DepartmentCard::create($data);

            $to = $request->to;
            $from = $request->from;

           $dates= $this->splitDates($from,$to,$request->number_of_term);
           for ($i=0; $i < count($dates)-1 ; $i++) {
           $term=new Term();
           $term->term_no=$i+1;
           ////ይገርማል

           $term->title=  $i+1;
           $term->from=$dates[$i];
           $term->to=$dates[$i+1];
           $term->department_card_id=$department_card->id;
           $term->department_id=1;
           $term->save();

    }
    return $department_card;

}


function splitDates($from, $to, $parts, $output = "Y-m-d") {
    $dataCollection[] = date($output, strtotime($from));
    $diff = (strtotime($to) - strtotime($from)) / $parts;
    $convert = strtotime($from) + $diff;

    for ($i = 1; $i < $parts; $i++) {
        $dataCollection[] = date($output, $convert);
        $convert += $diff;
    }
    $dataCollection[] = date($output, strtotime($to));
    return $dataCollection;
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
                    $term_sub_activities[]=$term_sub_activity->load('term_activity');
                }


               // return collect($term_sub_activities)->values()->load('term_activity');
        }

        return response()->json([
            'department_plans'=>$department_plans->load('perspective:id,title'),
            'term_activitis'=> $term_activities,
            'yearly_plans'=> $yearly_plans,
            'term_sub_activities'=> $term_sub_activities,
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
                'from'=>'required',
                'to'=>'required',
                'score_card_id'=>'required'

            ]
            );

            $data=$request->all();

            $to = strtotime($request->to);
            $from = strtotime($request->from);
            $toformat = date('Y-m-d',$to);
            $fromformat = date('Y-m-d',$from);
            $data['to']=$toformat;
            $data['from']=$fromformat;
             $departmentCard->update($data);

            $to = $request->to;
            $from = $request->from;
             if ($departmentCard->terms) {
                $departmentCard->terms->delete();
             }
           $dates= $this->splitDates($from,$to,$request->number_of_term);
           for ($i=0; $i < count($dates)-1 ; $i++) {
           $term=new Term();
           $term->term_no=$i+1;
           ////ይገርማል

           $term->title=  $i+1;
           $term->from=$dates[$i];
           $term->to=$dates[$i+1];
           $term->department_card_id=$departmentCard->id;
           $term->department_id=1;
           $term->save();

    }

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
