<?php

namespace App\Http\Controllers;

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
          $userActivity->user_id=$data['user_id'];
          $userActivity->save();

      }

      $saved[]= UserSubActivity::create([
          'term_sub_activity_id'=>$data['term_sub_activity_id'],
          'user_id'=>$data['user_id'],
          'user_activity_id'=>$userActivity->id
      ]);
    }

    return$saved;
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
}
