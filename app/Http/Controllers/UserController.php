<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentPlanResource;
use App\Models\DepartmentCard;
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
        $department=$user->department;
        $department_plans=$department->department_plans;
        $dps=[];
        $all=[];

        foreach ($department_plans as  $dp) {
            $dps['id']=$dp->id;
            $dps['activity']=$dp->activity;
            foreach ($dp->user_activities as $ua) {
                $dps['user_activity']=$dp->$ua;
                 $quality=[];
                 $quantity=[];
                 $time=[];
                foreach ($ua->user_sub_activities as  $usa) {


                     //      return $usa->term_sub_activity;
                   if ($usa->term_sub_activity->measurment == 'quality') {
                     $quality[]=$usa;
                   }

                  else if ($usa->term_sub_activity->measurment == 'time') {
                    $time[]=$usa;
                  }

                 else if ($usa->term_sub_activity->measurment == 'quantity') {
                   $quantity[]=$usa;
                 }
                }
                $dps['user_activity']['user_sub_activity']=['quality'=>$quality,'quantity'=>$quantity,'time'=>$time];



          }
          $all[]=$dps;

        }
        return $all;
      // return DepartmentPlanResource::collection($department_plans);
     // $activities= $department_plans->user_sub_activities;
       return response()->json([
        'department_plans'=>$department_plans->load('user_activities.user_sub_activities')
       // 'user_sub_activities'=>$user->user_sub_activities->load('term_sub_activity'),
       //'department_plans'=>$department_plans,
      // 'activities'=>$activities
    ]);
    }


    public function plan_to_be_selected($id){

        $department_cards=[];
        $terms=[];
        $department=User::find($id)->department;
        $department_plans=$department->department_plans;

        //  foreach ($department_plans as  $department_plan) {

        //     $department_cards[]=$department_plan->department_card;
        //     foreach ($department_plan->department_card->terms as  $term) {

        //       $terms[]=$term;
        //     }
        // }

        //     $department_cards = array_values(array_unique($department_cards));
        //     $years=[];
        //     foreach ($department_cards as  $value) {
        //         $years[]=$value->year;
        //         if (max($years)) {
        //             $id=$value->id;
        //         }
        //     }

        //     $terms =array_values(array_unique($terms));

            ///////////////////////////
            $dps=[];
            $all=[];

       foreach ($department_plans as $dp) {
      //  return $dp->term_activity;

          $dps['id']=$dp->id;
           $dps['activity']=$dp->activity;

           $dps['term_activities']['term_sub_activities']=null;


           if ($dp->term_activity) {
           // $tsas= $ta->term_sub_activities;
           $dps['term_activities']=$dp->term_activity;

           $quality=[];
           $quantity=[];
           $time=[];

          foreach ($dp->term_activity->term_sub_activities as  $tsa) {



             if ($tsa->measurment == 'quality') {
               $quality[]=$tsa;
             }

            else if ($tsa->measurment == 'time') {
              $time[]=$tsa;
            }

           else if ($tsa->measurment == 'quantity') {
             $quantity[]=$tsa;
           }

          }
       $dps['term_activities']['term_sub_activities']=['quality'=>$quality,'quantity'=>$quantity,'time'=>$time];
        //   return $dps['term_activities']['term_sub_activities'];


     // return $dps;

        }


           $all[]=$dps;
       }
       return $all;
       /////////////////

        return response()->json([
            'departments'=>$all,
            //  'department_plans'=>$department_plans->where('department_card_id', $id)->values() ->makeHidden('department_card')

            //  ->load('term_activity.term_sub_activities') ,
           //  'department_cards'=>$department_cards,
             'terms'=> array_filter($terms,function($term) use($id){
                 return $term['department_card_id']=$id;
             }) ,

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

        $data=$request->all();
        $data['password']=Hash::make($request->password);
        $user->update($data);
        return $user;
    }

    public function make_deactive($id)
    {
        $user= User::find($id);
        $user->is_active=request()->is_active;
        $user->save();
        return $user;

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
