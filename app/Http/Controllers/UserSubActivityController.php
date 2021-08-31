<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use App\Models\BehaviorEmployeeResult;
use App\Models\DepartmentPlan;
use App\Models\UserActivity;
use App\Models\UserSubActivity;
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

      $userActivity=UserActivity::where('department_plan_id',$data['department_plan_id'])->first();

      if(!$userActivity){

          $userActivity=new UserActivity();
          $userActivity->term_activity_id=$data['term_activity_id'];
          $userActivity->department_plan_id=$data['department_plan_id'];
          $userActivity->user_id=$request->user_id;
          $userActivity->save();

      }

      $saved[]= UserSubActivity::create([
          'term_sub_activity_id'=>$data['term_sub_activity_id'],
          'user_id'=>$request->user_id,
          'user_activity_id'=>$userActivity->id
      ]);
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

           $behavior= Behavior::find($data['behavior_id']);
           $behaviors[]=$behavior;
           $result_scale=$data['result_scale'];
           $result_scales[]=$result_scale;
           $result=$result_scale * $behavior->weight;

          //  $br=new BehaviorEmployeeResult();


            $result_scale=$data['result_scale'];
            $result=$result;
        }

        $term_id=request('term_id');
        $brbehavior_id=request('behavior_id');
        $user_id=request()->user_id;
        $department_card=request('department_card');
    }



}
