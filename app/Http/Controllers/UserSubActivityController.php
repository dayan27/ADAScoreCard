<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use App\Models\BehaviorEmployeeResult;
use App\Models\DepartmentCard;
use App\Models\DepartmentPlan;
use App\Models\Term;
use App\Models\TermActivity;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserSubActivity;
use App\Models\YearCard;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Http\Request;

class UserSubActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return UserSubActivity::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    //   $request->validate([

    //     'term_sub_activity_id'=>'required',
    //     'user_id'=>'required',

    //   ]);

    $saved=[];
    foreach ($request->datas as $data) {

      $userActivity=UserActivity::where('department_plan_id',$data['department_plan_id'])->where('term_activity_id',$data['term_activity_id'])->first();

      if(!$userActivity){

          $userActivity=new UserActivity();
          $userActivity->term_activity_id=$data['term_activity_id'];
          $userActivity->department_plan_id=$data['department_plan_id'];
          $userActivity->user_id=$data['user_id'];
          $userActivity->save();

      }

      $saved[]= UserSubActivity::create([
          'term_sub_activity_id'=>$data['term_sub_activity_id'],
          'user_id'=>$request->user_id,
          'user_activity_id'=>$userActivity->id
      ]);
    }
    if($saved){
        $user=User::find($request->user_id);
        $term_id=TermActivity::find($request->term_activity_id)->term_id;
        if(!$user->terms()->where('term_id',$term_id)->get()){
            $user->terms()->attach($term_id,['draft_visiblity'=>0]);

        }



    }

    return $saved;
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserSubActivity $UserSubActivity)
    {
       return $UserSubActivity;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,UserSubActivity $userSubActivity)
    {
        $request->validate([
            'term_sub_activity_id'=>'required',
            'user_id'=>'required',
            'department_plan_id'=>'required'

          ]);


          $userActivity=UserActivity::where('department_plan_id',$request->department_plan_id);

          if(!$userActivity){
              $userActivity=new UserActivity();
              $userActivity->term_activity_id=$request->term_activity_id;
              $userActivity->user_id=$request->user_id;
              $userActivity->save();
          }

          $data=$request->all();
          $data['user_activity_id']=$userActivity->id;


         $userSubActivity->update($data);
         return $userSubActivity;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSubActivity $UserSubActivity)
    {
        $UserSubActivity->delete();
    }

    public function giveActivityResult(){
     //  return request()->all();
     foreach (request()->datas as  $data) {
        $department_plan=DepartmentPlan::find($data['department_plan_id']);


        $userActivity=UserActivity::find($data['user_activity_id']);

        $given_time_result=isset($data['time_result']) ? $data['time_result']: 0.0;
        $given_quality_result=isset($data['quality_result']) ? $data['quality_result'] : 0.0;
        $given_quantity_result=isset($data['quantity_result']) ? $data['quantity_result'] : 0.0;

        $time_result=$department_plan->time_weight * $given_time_result;

        $quantity_result=$department_plan->quality_weight * $given_quality_result;
        $quantity_result=$department_plan->quantity_weight * $given_quantity_result;
        $total_result= $time_result + $quantity_result + $quantity_result;

        $userActivity->time_result=$time_result;
        $userActivity->quality_result=$quantity_result;
        $userActivity->quantity_result=$quantity_result;

        $userActivity->result=$total_result;

        $userActivity->save();

     }
    }
     public function giveBehaviorResult(){


        foreach (request()->datas as  $data) {
            $term_id=$data['term_id'];
           // return request()->datas;
            $department_card_id=$data['department_card_id'];

            $behavior= Behavior::find($data['behavior_id']);
         //   return $behavior;
           $user= User::find($data['user_id']);
         //  return $user;
            $result_scale=$data['result_scale'];
          // $result_scales[]=$result_scale;
           $result=$result_scale * $behavior->weight;

           $user->behaviors()->attach($data['behavior_id'],[
            'result_scale'=>$result_scale,
            'result'=>$result,
            'term_id'=>$term_id,
            'department_card_id'=>$department_card_id,

             ]);

        }

    }

    public function getEfficiency($id){

      $user=User::find($id);
    // return $user->user_activities;
      $user_activities=[];
      foreach ($user->user_activities as  $user_activity) {
      //  return $user->user_activities;

        $department_card_id= $user_activity->term_activity->term->department_card->year;
        if ($department_card_id == request('year')) {
            $user_activities[]=$user_activity;


        }
      }

       $no_of_term= DepartmentCard::where('year',request('year'))->first()->number_of_term;

       $results=[];
         for ($term=0; $term < $no_of_term ; $term+1) {

            foreach ($user_activities as $user_activity) {

                if($user_activity->term_activity->term->term_no == $term){

                    $results[$term]+= $user_activity->result;
                }
            }
         }

        $behavior_results=[];
        for ($term=1; $term <= $no_of_term ; $term+1) {
            foreach ($user->behaviors->wherePivot('department_card',request('department_card')) as  $behavior) {

                if ($behavior->pivot->term->term_no == $term) {

                   $behavior_results[$term]+=$behavior->pivot->result;
                }
            }

         }


       return $this->addResult($results,$behavior_results);
    }

    public function addResult($a,$b){
        $r=[];
        for ($i=0; $i < count($a) ; $i++) {

         $r[$i]+=$a[$i]+ $b[$i];
        }
        return $r;
    }


    public function getEff(){
        $user_id=request()->user_id;
        $user=User::find($user_id);
        //return $user->load('behaviors')->where('department_card_id',request()->department_card_id);
        //  $x[]=0;
      foreach ( $user->behaviors  as $behav) {

        $year=DepartmentCard::find($behav->pivot->department_card_id)->year;
        if($year==request()->year){
            $behavor_data[]=$behav;
        }

      }
       return $behavor_data;
      foreach ($user->user_activities as  $user_activity) {
        $activ[]=null;
          if($user_activity->department_plan->department_card==request()->year){
              $activ[]=$user_activity->load('department_Strategic_plan');
          }

    }
    //return $activ;
    }
    public function get_result($user_id){
        $user=User::find($user_id);
        $dep_id= $user->department_id;
         $dep_cards=DepartmentCard::where('department_id',$dep_id)->get();
        // return $dep_cards;
        $user_result=[];
        $terms=[];
        foreach ($dep_cards as $dep_card) {
           $terms=$dep_card->terms;
           $term_result=[];
           $user_result['year']=$dep_card->year;
           foreach ($terms as $term) {
               $terms['term_no']=$term->term_no;
               $terms['term_id']=$term->id;

               $behavior_result=[];
               $activity_result=[];
               foreach ($user->behaviors as $behavior) {
                  $current_dep_card_id=$behavior->pivot->department_card_id;
                  $current_term_id=$behavior->pivot->term_id;
                  if($current_dep_card_id==request()->department_card_id && $current_term_id==request()->term_id){
                      $behavior_result=$behavior;
                      //return $behavior_result;
                  }

               }
               array_push($term_result,$behavior_result);
               return $term_result;

               foreach ($user->user_activities as $user_activity) {

                $current_term_id=$user_activity->term_activity->term_id;
                $current_dep_card_id=Term::find($current_term_id)->department_card_id;

                if($current_dep_card_id==request()->department_card_id && $current_term_id==request()->term_id){
                  $activity_result=$user_activity->term_activity->department_plan;
                }
              }
              array_push($term_result,$activity_result);

              array_push($terms,$term_result);

          }
           array_push($user_result,$terms);

        }
        return $user_result;

      }

}


