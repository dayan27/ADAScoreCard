<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\TermSubActivity;
use App\Models\User;
use App\Models\UserSubActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
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
            'first_name'=>'required',
            'last_name'=>'required',
            'role'=>'required',
            'phone_no'=>'required',
            'gender'=>'required',
            'department_id'=>'required',
        ]);

        $data=$request->all();
        $data['password']=Hash::make($request->password);
       return User::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
       // $user->load('user_activities','user_sub_activities')
      return response()->json([
        'user_activities'=>$user->user_activities->load('department_plan','term_activity'),
        'user_sub_activities'=>$user->user_sub_activities->load('term_sub_activity'),
    ]);
    }


    public function plan_to_be_selected($id){

        $department_cards=[];
        $terms=[];
        $department=User::find($id)->department;
        $department_plans=$department->department_plans;
        // $term_sub_activities=
           // return $department_plans;
         foreach ($department_plans as  $department_plan) {
            $terms[]=$department_plan->department_card->terms;

            $department_cards[]=$department_plan->department_card->makeHidden('terms');
            }

            $department_cards = array_values(array_unique($department_cards));
            $terms = array_values(array_unique($terms));


        return response()->json([
             'department_plans'=>$department->department_plans->makeHidden('department_card')->load('term_activity.term_sub_activities'),
             'department_cards'=>$department_cards,
            'terms'=>$terms,

     ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'role'=>'required',
            'phone_no'=>'required',
            'gender'=>'required',
            'department_id'=>'required',

        ]);

        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    }

    public function make_visible($id)
    {
        $user= User::find($id);
        $user->draft_visiblity=request()->visiblity;
        $user->save();
        return $user;

    }


    public function send_comment($id)
    {
        $term= Term::find($id);
        $term->comment=request()->comment;
        $term->save();
        return $term;

    }

    public function accept_activity(Request $request)
    {
        $user_sub_activity= UserSubActivity::find($request->user_sub_activity_id);
        $term_sub_activity= TermSubActivity::find($request->term_sub_activity_id);
        $user_sub_activity->level=$request->level;
        $term_sub_activity->is_accepted=$request->is_accepted;
        $user_sub_activity->save();
        $term_sub_activity->save();
        return response()->json(['successfuly changed'],200);

    }
}
