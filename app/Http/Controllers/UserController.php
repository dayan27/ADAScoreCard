<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentPlanResource;
use App\Models\Behavior;
use App\Models\DepartmentCard;
use App\Models\DepartmentPlan;
use App\Models\Term;
use App\Models\TermActivity;
use App\Models\TermSubActivity;
use App\Models\User;
use App\Models\UserActivity;
use App\Models\UserSubActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\Continue_;

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
        $id=$user->id;

        // return UserActivity::all();
         $user_activities= UserActivity::all()->where('user_id',$id);
        // return $user_activities;
         // $department=$user->department;
         // $department_plans=$department->department_plans;
         $dps=[];
         $all=[];
        // $term=[];
         //  return $department_plans;
    //    return  $user->terms()->get();
       //  if ($user->terms()->pivot->draft_visiblity) {}
               // return $user->pivot;

         foreach ($user_activities as  $ua) {

          // return   $dp->user_activities;
         // return $ua;

          if ($ua->term_activity->term->make_visible && ! $ua->term_activity->term->is_completed) {
             $term_id= $ua->term_activity->term->id;

        //    return $user->terms()->get();
          // return $user->terms()->where('term_id',$term_id)->first()->pivot->draft_visiblity;
           if ( $user->terms()->first()->pivot->draft_visiblity) {
            $dep_plan_id=$ua->department_plan_id;
            //   return $dep_plan_id;

               $dep_plan=DepartmentPlan::find($dep_plan_id);
               $dps['id']=$dep_plan->id;
               $dps['activity']=$dep_plan->activity;
               $dps['quantity_weight']=$dep_plan->quantity_weight;
               $dps['time_weight']=$dep_plan->time_weight;
               $dps['quality_weight']=$dep_plan->quality_weight;
               $dps['is_accepted'] = $user->terms()->where('term_id',$term_id)->first()->pivot->is_accepted;

               $quality=[];
               $quantity=[];
               $time=[];

                foreach ($ua->user_sub_activities as  $usa) {

                  //     return $ua->user_sub_activities;
                    if ( Str::lower($usa->term_sub_activity->measurment) == 'quality') {
                      $quality[]=$usa;
                    }

                  else if ( Str::lower( $usa->term_sub_activity->measurment) == 'time') {
                    $time[]=$usa;
                  }

                  else if (Str::lower( $usa->term_sub_activity->measurment) == 'quantity') {
                    $quantity[]=$usa;
                  }
               }
               $dps['user_sub_activity']=['quality'=>$quality,'quantity'=>$quantity,'time'=>$time];


                $term_activity_id=$ua->term_activity_id;
                $term=TermActivity::find($term_activity_id)->term;

                $term_id= $term->id;
                   $all[]=$dps;
                //    array_push($terms_all,$term,$dps);
            }


           }

         // return $all;

         }
         return $all;
   //  }

       // return DepartmentPlanResource::collection($department_plans);
      // $activities= $department_plans->user_sub_activities;
    //     return response()->json([
    //      //'draft_visiblity'=>$user->terms()->where('term_id',$term_id)->first()->pivot->draft_visiblity,
    //      //->pivot->draft_visiblity,
    //     // 'term'=>$term,
    //      'department_plans'=>$all
    //      //'department_plans'=>$department_plans->load('user_activities.user_sub_activities')
    //     // 'user_sub_activities'=>$user->user_sub_activities->load('term_sub_activity'),
    //     //'department_plans'=>$department_plans,
    //    // 'activities'=>$activities
    //  ]);
    }

    /*
    return user by filtering based on department_id
    */
    public function get_user($department_id){
      return User::where('department_id',$department_id)->get();

    }


    public function plan_to_be_selected($id){

        $department_cards=[];
        $terms=[];
        //  return User::find($id);
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
          //return $department_plans;
       foreach ($department_plans as $dp) {

        //  return $dp->term_activity;
        // if($dp->id==23){
        //     return 23;
        // }

        foreach ($dp->term_activities as $term_activity) {
            # code...

          $make_visible=$term_activity->term->make_visible;
          $is_completed=$term_activity->term->is_completed;
        //   if($is_completed==1){
        //     return $dp->term_activity;

        //   }
        if ( $make_visible && ! $is_completed  ) {


          $dps['id']=$dp->id;
          $dps['activity']=$dp->activity;
          $dps['quantity_weight']=$dp->quantity_weight;
          $dps['time_weight']=$dp->time_weight;
          $dps['quality_weight']=$dp->quality_weight;


           //$dps['term_activities']=['id'];
           // $tsas= $ta->term_sub_activities;


           $dps['term_activities']=array('id'=>  $term_activity->id);

           $quality=[];
           $quantity=[];
           $time=[];

          foreach ($term_activity->term_sub_activities as  $tsa) {


             if ( Str::lower( $tsa->measurment) ==  'quality') {
               $quality[]=$tsa;
             }

            else if ( Str::lower($tsa->measurment) == 'time') {
              $time[]=$tsa;
            }

           else if ( Str::lower($tsa->measurment) == 'quantity') {
             $quantity[]=$tsa;
           }

           }
           $dps['term_activities']= array('term_sub_activity'=>array('quality'=>$quality,'quantity'=>$quantity,'time'=>$time));
           $all[]=$dps;

            }else{

          }

         $terms[]=$term_activity->term;

       }

    }
    return response()->json([
    'term'=>$terms,
    'termActivity'=>$all,
     ]);
    }

    public function get_user_activity($id){

        $user=User::find($id);
        $department=$user->department;
        $department_plans=$department->department_plans;
        $dps=[];
        $all=[];
        $all_coll=[];

         $dep_id=$department->id;
        $dep_cards=DepartmentCard::all()->where('department_id',$dep_id);

        $coll=[];
        $all_active=[];

        foreach ($dep_cards as $dep_card) {
            $dep_card_id=$dep_card->id;

          $dep_id= $user->department_id;
          //return Term::all();

            $terms=Term::all()->where('department_id','=',$dep_id)->where('department_card_id',$dep_card_id);
         $term_coll = $terms->where('department_id',$dep_id)
                 ->where('department_card_id',$dep_card_id);
                 $coll['year']=$dep_card->year;
                 $coll['terms']=$term_coll;
                array_push($all_coll,$coll) ;


        }
        // return $all_coll;
         $user_activity=UserActivity::where('user_id',$id)->get();
        foreach ($user_activity as $ua) {

        if($ua->term_activity->term->make_visible && $ua->term_activity->term->is_completed){

            $dep_plan_id=$ua->department_plan_id;
            $dp=DepartmentPlan::find($dep_plan_id);

            $dps['id']=$dp->id;
            $dps['activity']=$dp->activity;
            $dps['quantity_weight']=$dp->quantity_weight;
            $dps['time_weight']=$dp->time_weight;
            $dps['quality_weight']=$dp->quality_weight;
            $dps['year']=$dp->department_card->year;

            foreach ($dp->user_activities as $ua) {
                // return $ua;



                $quality=[];
                $quantity=[];
                $time=[];

                 $low=array();
                 $enough=array();
                 $high=array();
                 $excellent=array();

                 //quantity
                 $qlow=array();
                 $qenough=array();
                 $qhigh=array();
                 $qexcellent=array();

                 $tlow=array();
                 $tenough=array();
                 $thigh=array();
                 $texcellent=array();
                foreach ($ua->user_sub_activities as  $usa) {
                  $term_activity_id=TermSubActivity::find($usa->term_sub_activity_id)->term_activity_id;
                  $term_id= TermActivity::find($term_activity_id)->term->id;
                  $usa['term_id']=$term_id;
                    //->term_id ;


                     //     return $usa->term_sub_activity;
                   if ( Str::lower($usa->term_sub_activity->measurment) == 'quality') {

                        if (Str::lower($usa->term_sub_activity->level) == 'low') {
                        $low[]= $usa;
                        }else if (Str::lower($usa->term_sub_activity->level) == 'enough') {
                             $enough[]= $usa;

                        }else if (Str::lower($usa->term_sub_activity->level) == 'high') {
                             $high[]= $usa;
                        }else if (Str::lower($usa->term_sub_activity->level) == 'excellent') {
                         //   $excellent['excellent']=  $usa;
                         $excellent[]=  $usa;

                        }


                   }






                   else if ( Str::lower( $usa->term_sub_activity->measurment) == 'time') {




                    if (Str::lower($usa->term_sub_activity->level) == 'low') {
                        $tlow[]= $usa;
                        }else if (Str::lower($usa->term_sub_activity->level) == 'enough') {
                             $tenough[]= $usa;

                        }else if (Str::lower($usa->term_sub_activity->level) == 'high') {
                             $thigh[]= $usa;
                        }else if (Str::lower($usa->term_sub_activity->level) == 'excellent') {
                          //  $texcellent['excellent']=  $usa;
                          $texcellent[]=  $usa;

                        }


                   }

                  else if (Str::lower( $usa->term_sub_activity->measurment) == 'quantity') {




                    if (Str::lower($usa->term_sub_activity->level) == 'low') {
                        $qlow[]= $usa;
                        }else if (Str::lower($usa->term_sub_activity->level) == 'enough') {
                             $qenough[]= $usa;

                        }else if (Str::lower($usa->term_sub_activity->level) == 'high') {
                             $qhigh[]= $usa;
                        }else if (Str::lower($usa->term_sub_activity->level) == 'excellent') {
                           // $qexcellent['excellent']=  $usa;
                           $qexcellent[]=  $usa;


                        }


                 }
                }

                $quality[]=['low'=>$low ,'enough'=>$enough ,'high'=>$high , 'excellent'=>$excellent];
                $time[]=['low'=>$tlow ,'enough'=>$tenough ,'high'=>$thigh , 'excellent'=>$texcellent];
                $quantity[]=['low'=>$qlow ,'enough'=>$qenough ,'high'=>$qhigh , 'excellent'=>$qexcellent];
                $dps['user_sub_activity']=['quality'=>$quality,'quantity'=>$quantity,'time'=>$time];
                $all[]=$dps;





          }
        }


        }










        // return $all;
        return response()->json([
            'TermYearCard'=>$all_coll,
            'TermActivity'=>$all,
            'TermActivityActive'=>$all_active,
    ]);
    }


    public function get_current_user_activity($id){
        $user=User::find($id);
        $department=$user->department;
        $department_plans=$department->department_plans;
        $dps=[];
        $all=[];
        // $all_coll=[];

         $dep_id=$department->id;
        $dep_cards=DepartmentCard::all()->where('department_id',$dep_id);
        $user_activity=UserActivity::where('user_id',$id)->get();

        $coll=[];
        $all_active=[];

        // foreach ($dep_cards as $dep_card) {
        //     $dep_card_id=$dep_card->id;

        //   $dep_id= $user->department_id;
        //   //return Term::all();

        //     $terms=Term::all()->where('department_id','=',$dep_id)->where('department_card_id',$dep_card_id);
        //  $term_coll = $terms->where('department_id',$dep_id)
        //          ->where('department_card_id',$dep_card_id);
        //          $coll['year']=$dep_card->year;
        //          $coll['terms']=$term_coll;
        //         array_push($all_coll,$coll) ;


        // }
        // return $all_coll;
        /**
         * to get the term number
         */
      //  return $user_activity;
        $trm=null;
        foreach($user_activity as $ua){
            if($ua->term_activity->term->make_visible && ! $ua->term_activity->term->is_completed){
                $trm=$ua->term_activity->term;
                break;
            }


        }
      $term=[];
      $term['id']=$trm->id;
      $term['no']=$trm->term_no;

      $term['year']=$trm->department_card->year;
      $term['department_card_id']=$trm->department_card->id;
      $term['is_accepted']=$user->terms()->where('term_id',$trm->id)->first()->pivot->is_accepted;


        foreach ($user_activity as $ua) {
        //////
        if($ua->term_activity->term->make_visible && ! $ua->term_activity->term->is_completed){

            $dep_plan_id=$ua->department_plan_id;
            $dp=DepartmentPlan::find($dep_plan_id);

            $dps['id']=$dp->id;
            $dps['activity']=$dp->activity;
            $dps['quantity_weight']=$dp->quantity_weight;
            $dps['time_weight']=$dp->time_weight;
            $dps['quality_weight']=$dp->quality_weight;
            $dps['year']=$dp->department_card->year;

         //   foreach ($dp->user_activities as $ua) {
                // return $ua;



                $quality=[];
                $quantity=[];
                $time=[];

                 $low=array();
                 $enough=array();
                 $high=array();
                 $excellent=array();

                 //quantity
                 $qlow=array();
                 $qenough=array();
                 $qhigh=array();
                 $qexcellent=array();

                 $tlow=array();
                 $tenough=array();
                 $thigh=array();
                 $texcellent=array();
                foreach ($ua->user_sub_activities as  $usa) {
                  $term_activity_id=TermSubActivity::find($usa->term_sub_activity_id)->term_activity_id;
                  $term_id= TermActivity::find($term_activity_id)->term->id;
                  $usa['term_id']=$term_id;

                   if ( Str::lower($usa->term_sub_activity->measurment) == 'quality') {

                        if (Str::lower($usa->term_sub_activity->level) == 'low') {
                        $low[]= $usa;
                        }else if (Str::lower($usa->term_sub_activity->level) == 'enough') {
                             $enough[]= $usa;

                        }else if (Str::lower($usa->term_sub_activity->level) == 'high') {
                             $high[]= $usa;
                        }else if (Str::lower($usa->term_sub_activity->level) == 'excellent') {
                         //   $excellent['excellent']=  $usa;
                         $excellent[]=  $usa;

                        }
                   }

                   else if ( Str::lower( $usa->term_sub_activity->measurment) == 'time') {

                    if (Str::lower($usa->term_sub_activity->level) == 'low') {
                        $tlow[]= $usa;
                        }else if (Str::lower($usa->term_sub_activity->level) == 'enough') {
                             $tenough[]= $usa;

                        }else if (Str::lower($usa->term_sub_activity->level) == 'high') {
                             $thigh[]= $usa;
                        }else if (Str::lower($usa->term_sub_activity->level) == 'excellent') {
                          //  $texcellent['excellent']=  $usa;
                          $texcellent[]=  $usa;

                        }
                   }

                  else if (Str::lower( $usa->term_sub_activity->measurment) == 'quantity') {

                    if (Str::lower($usa->term_sub_activity->level) == 'low') {
                        $qlow[]= $usa;
                        }else if (Str::lower($usa->term_sub_activity->level) == 'enough') {
                             $qenough[]= $usa;

                        }else if (Str::lower($usa->term_sub_activity->level) == 'high') {
                             $qhigh[]= $usa;
                        }else if (Str::lower($usa->term_sub_activity->level) == 'excellent') {
                           // $qexcellent['excellent']=  $usa;
                           $qexcellent[]=  $usa;

                        }
                 }
                }

                $quality[]=['low'=>$low ,'enough'=>$enough ,'high'=>$high , 'excellent'=>$excellent];
                $time[]=['low'=>$tlow ,'enough'=>$tenough ,'high'=>$thigh , 'excellent'=>$texcellent];
                $quantity[]=['low'=>$qlow ,'enough'=>$qenough ,'high'=>$qhigh , 'excellent'=>$qexcellent];
                $dps['user_sub_activity']=['quality'=>$quality,'quantity'=>$quantity,'time'=>$time];
                $all[]=$dps;

            }

        }
        //

    // }
    return response()->json([
        'term'=>$term,
        'termActivity'=>$all,

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

        $term_id=TermActivity::find(request()->term_activity_id)->term_id;


        // $user->terms()->attach($term_id,['draft_visiblity'=>request()->visiblity]);
       // $user->draft_visiblity=;
    //    return request()->visiblity;
        // $user->terms()->first()->pivot->draft_visiblity=request()->visiblity;
        // $user->terms()->first()->pivot->save();
     //return  $user->terms()->first();
         //return $user->terms()->where('term_id',$term_id)->first();
        // $model->relation()->sync([$related->id => [ 'duration' => 'someValue'] ], false);
          //return request()->visiblity;
        $user->terms()->where('term_id',$term_id)->updateExistingPivot($term_id,['draft_visiblity'=>request()->visiblity]);
                $user->terms()->first()->pivot->save();

        // =request()->visiblity;$ter
        return $user->terms()->where('term_id',$term_id)->first();

    }

    /***
     * a method to accepet or reject the  user term activity by a user send
     * by a department head
     */
    public function accepet_current_term($user_id){
        $user=User::find($user_id);
        $user->terms()->where('term_id',request()->term_id)->updateExistingPivot(request()->term_id,['is_accepted'=>request()->is_accepted]);
        $user->terms()->first()->pivot->save();

        //  if($user->terms()->where('term_id',request()->term_id)->first()->pivot->is_accepted){
        //      $behaviors=Behavior::all();
        //      //to add a user and behavior inpivot table of behavior_user pivot table
        //      foreach ($behaviors as  $behavior) {
        //          $user->behaviors->sync($behavior->id,['term_id'=>request()->term_id,
        //         'department_card_id'=>request()->department_card_id]);
        //      }
        //     }
        //    return  $user->behaviors>contains(request()->term_id);




    //     if($user->terms()->where('term_id',$term_id)->first()->pivot->is_accepted)
    //$user->terms()->where('term_id',request()->term_id)->first()->pivot->is_accepted



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
        $term_sub_activity->level=$request->level;
        $user_sub_activity->isAccepeted=$request->is_accepted;
        $user_sub_activity->save();
        $term_sub_activity->save();
        return response()->json(['successfuly changed'],200);

    }
    public function user_draft($id)
    {
         $user=User::find($id);
       // return UserActivity::all();
        $user_activities= UserActivity::all()->where('user_id',$id);
       // return $user_activities;
        // $department=$user->department;
        // $department_plans=$department->department_plans;
        $dps=[];
        $all=[];
        $term=null;
        $term_id=null;
       // $term=[];
        //  return $department_plans;
        // if ($user->pivot->draft_visiblity) {
              // return $user->pivot;

        foreach ($user_activities as  $ua) {

         // return   $dp->user_activities;
        // return $ua;

         if ($ua->term_activity->term->make_visible && ! $ua->term_activity->term->is_completed) {
             $term1=$ua->term_activity->term;

           $dep_plan_id=$ua->department_plan_id;
        //   return $dep_plan_id;
           $dep_plan=DepartmentPlan::find($dep_plan_id);
           $dps['id']=$dep_plan->id;
           $dps['activity']=$dep_plan->activity;
           $dps['quantity_weight']=$dep_plan->quantity_weight;
           $dps['time_weight']=$dep_plan->time_weight;
           $dps['quality_weight']=$dep_plan->quality_weight;

           $quality=[];
           $quantity=[];
           $time=[];

            foreach ($ua->user_sub_activities as  $usa) {

              //     return $ua->user_sub_activities;
                if ( Str::lower($usa->term_sub_activity->measurment) == 'quality') {
                  $quality[]=$usa;
                }

              else if ( Str::lower( $usa->term_sub_activity->measurment) == 'time') {
                $time[]=$usa;
              }

              else if (Str::lower( $usa->term_sub_activity->measurment) == 'quantity') {
                $quantity[]=$usa;
              }
           }
           $dps['user_sub_activity']=['quality'=>$quality,'quantity'=>$quantity,'time'=>$time];


            $term_activity_id=$ua->term_activity_id;
            $term=TermActivity::find($term_activity_id)->term;

            $term_id= $term->id;
        }

            # code...

          if ($dps) {
            $all[]=$dps;
        }


        }

       return response()->json([
        'draft_visiblity'=>$user->terms()->where('term_id',$term_id)->first()->pivot->draft_visiblity,
        'term'=>$term,
        'department_plans'=>$all

    ]);
}

/**************
 *
 *
 *give activity result
 *
 *
 **************/
 public function give_activity_result($user_id){
    $user=User::find($user_id);
    $id=$user->id;


    // return UserActivity::all();
     $user_activities= UserActivity::all()->where('user_id',$id);
    // return $user_activities;
     // $department=$user->department;
     // $department_plans=$department->department_plans;
     $dps=[];
     $all=[];
     $all_terms=[];
     $all_in=[];
    // $term=[];
     //  return $department_plans;
//    return  $user->terms()->get();
   //  if ($user->terms()->pivot->draft_visiblity) {}
           // return $user->pivot;
           $term=null;
       //return $user_activities;
     foreach ($user_activities as  $ua) {

      // return   $dp->user_activities;
     //return $ua;
     if($ua->term_activity->term->make_visible && ! $ua->term_activity->term->is_completed){
        $term= $ua->term_activity->term;
        //return $term;

        $dep_plan_id=$ua->department_plan_id;
        $dp=DepartmentPlan::find($dep_plan_id);

        $dps['id']=$dp->id;
        $dps['activity']=$dp->activity;
        $dps['quantity_weight']=$dp->quantity_weight;
        $dps['time_weight']=$dp->time_weight;
        $dps['quality_weight']=$dp->quality_weight;
        $dps['year']=$dp->department_card->year;

        $dps['time_result_scale']=$ua->time_result_scale;
        $dps['quality_result_scale']=$ua->quality_result_scale;
        $dps['quantity_result_scale_']=$ua->quantity_result_scale;

        $dps['time_result']=$ua->time_result;
        $dps['quality_result']=$ua->quality_result;
        $dps['quantity_result']=$ua->quantity_result;
        $dps['is_accepted']=$ua->is_accepted;




       // return $dp->user_activities ;

        // foreach ($dp->user_activities as $ua) {
            // return $ua;



            $quality=[];
            $quantity=[];
            $time=[];

             $low=array();
             $enough=array();
             $high=array();
             $excellent=array();

             //quantity
             $qlow=array();
             $qenough=array();
             $qhigh=array();
             $qexcellent=array();

             $tlow=array();
             $tenough=array();
             $thigh=array();
             $texcellent=array();
            foreach ($ua->user_sub_activities as  $usa) {
              $term_activity_id=TermSubActivity::find($usa->term_sub_activity_id)->term_activity_id;
              $term_id= TermActivity::find($term_activity_id)->term->id;
              $usa['term_id']=$term_id;
                //->term_id ;
                if($usa){
                    $dps['user_activity_id']= $usa->user_activity_id;

                 }


                 //     return $usa->term_sub_activity;
               if ( Str::lower($usa->term_sub_activity->measurment) == 'quality') {

                    if (Str::lower($usa->term_sub_activity->level) == 'low') {
                    $low[]= $usa;
                    }else if (Str::lower($usa->term_sub_activity->level) == 'enough') {
                         $enough[]= $usa;

                    }else if (Str::lower($usa->term_sub_activity->level) == 'high') {
                         $high[]= $usa;
                    }else if (Str::lower($usa->term_sub_activity->level) == 'excellent') {
                     //   $excellent['excellent']=  $usa;
                     $excellent[]=  $usa;

                    }
               }
               else if ( Str::lower( $usa->term_sub_activity->measurment) == 'time') {

                if (Str::lower($usa->term_sub_activity->level) == 'low') {
                    $tlow[]= $usa;
                    }else if (Str::lower($usa->term_sub_activity->level) == 'enough') {
                         $tenough[]= $usa;

                    }else if (Str::lower($usa->term_sub_activity->level) == 'high') {
                         $thigh[]= $usa;
                    }else if (Str::lower($usa->term_sub_activity->level) == 'excellent') {
                      //  $texcellent['excellent']=  $usa;
                      $texcellent[]=  $usa;

                    }


               }

              else if (Str::lower( $usa->term_sub_activity->measurment) == 'quantity') {

                if (Str::lower($usa->term_sub_activity->level) == 'low') {
                    $qlow[]= $usa;
                    }else if (Str::lower($usa->term_sub_activity->level) == 'enough') {
                         $qenough[]= $usa;

                    }else if (Str::lower($usa->term_sub_activity->level) == 'high') {
                         $qhigh[]= $usa;
                    }else if (Str::lower($usa->term_sub_activity->level) == 'excellent') {
                       // $qexcellent['excellent']=  $usa;
                       $qexcellent[]=  $usa;


                    }


             }
            }

            $quality[]=['low'=>$low ,'enough'=>$enough ,'high'=>$high , 'excellent'=>$excellent];
            $time[]=['low'=>$tlow ,'enough'=>$tenough ,'high'=>$thigh , 'excellent'=>$texcellent];
            $quantity[]=['low'=>$qlow ,'enough'=>$qenough ,'high'=>$qhigh , 'excellent'=>$qexcellent];
            $dps['user_sub_activity']=['quality'=>$quality,'quantity'=>$quantity,'time'=>$time];

            $all[]=$dps;

           //  return $all;
           //array_push( $all_terms, $term,$all);

        //}
          //array_push($all_in,$all_terms) ;
        //   $all_in=$all_terms;
       // return $all;
    }
    // array_push( $all_terms, $all);
    // return $all;


     }
     array_push($all_in,$term,$all);
    return $all_in;
    // return $all_terms;
    //  return response()->json([
    //            'term'=>$term,
    //            'termPlan'=>$all,

    //  ]);



 }
   public function get_user_activity_by_year($id){
    $user=User::find($id);
    $department=$user->department;
    $department_plans=$department->department_plans;
    $dps=[];
    $all=[];
    $all_coll=[];

     $dep_id=$department->id;
    $dep_cards=DepartmentCard::all()->where('department_id',$dep_id);

    $coll=[];
    $all_active=[];

    foreach ($dep_cards as $dep_card) {
        $dep_card_id=$dep_card->id;

      $dep_id= $user->department_id;
      //return Term::all();

        $terms=Term::all()->where('department_id','=',$dep_id)->where('department_card_id',$dep_card_id);
     $term_coll = $terms->where('department_id',$dep_id)
             ->where('department_card_id',$dep_card_id);
             $coll['year']=$dep_card->year;
             $coll['terms']=$term_coll;
            array_push($all_coll,$coll) ;


    }
    // return $all_coll;
     $user_activity=UserActivity::where('user_id',$id)->get();
    foreach ($user_activity as $ua) {

    if($ua->term_activity->term->make_visible ){

        $dep_plan_id=$ua->department_plan_id;
        $dp=DepartmentPlan::find($dep_plan_id);
         //return $dp;
        if($dp->departmen_card->department_card_id==request()->department_card_id){
           continue ;
        }

        $dps['id']=$dp->id;
        $dps['activity']=$dp->activity;
        $dps['quantity_weight']=$dp->quantity_weight;
        $dps['time_weight']=$dp->time_weight;
        $dps['quality_weight']=$dp->quality_weight;
        $dps['year']=$dp->department_card->year;

        foreach ($dp->user_activities as $ua) {
            // return $ua;



            $quality=[];
            $quantity=[];
            $time=[];

             $low=array();
             $enough=array();
             $high=array();
             $excellent=array();

             //quantity
             $qlow=array();
             $qenough=array();
             $qhigh=array();
             $qexcellent=array();

             $tlow=array();
             $tenough=array();
             $thigh=array();
             $texcellent=array();
            foreach ($ua->user_sub_activities as  $usa) {
              $term_activity_id=TermSubActivity::find($usa->term_sub_activity_id)->term_activity_id;
              $term_id= TermActivity::find($term_activity_id)->term->id;
              $usa['term_id']=$term_id;
                //->term_id ;


                 //     return $usa->term_sub_activity;
               if ( Str::lower($usa->term_sub_activity->measurment) == 'quality') {

                    if (Str::lower($usa->term_sub_activity->level) == 'low') {
                    $low[]= $usa;
                    }else if (Str::lower($usa->term_sub_activity->level) == 'enough') {
                         $enough[]= $usa;

                    }else if (Str::lower($usa->term_sub_activity->level) == 'high') {
                         $high[]= $usa;
                    }else if (Str::lower($usa->term_sub_activity->level) == 'excellent') {
                     //   $excellent['excellent']=  $usa;
                     $excellent[]=  $usa;

                    }


               }






               else if ( Str::lower( $usa->term_sub_activity->measurment) == 'time') {




                if (Str::lower($usa->term_sub_activity->level) == 'low') {
                    $tlow[]= $usa;
                    }else if (Str::lower($usa->term_sub_activity->level) == 'enough') {
                         $tenough[]= $usa;

                    }else if (Str::lower($usa->term_sub_activity->level) == 'high') {
                         $thigh[]= $usa;
                    }else if (Str::lower($usa->term_sub_activity->level) == 'excellent') {
                      //  $texcellent['excellent']=  $usa;
                      $texcellent[]=  $usa;

                    }


               }

              else if (Str::lower( $usa->term_sub_activity->measurment) == 'quantity') {

              if (Str::lower($usa->term_sub_activity->level) == 'low') {
                    $qlow[]= $usa;
                    }else if (Str::lower($usa->term_sub_activity->level) == 'enough') {
                         $qenough[]= $usa;

                    }else if (Str::lower($usa->term_sub_activity->level) == 'high') {
                         $qhigh[]= $usa;
                    }else if (Str::lower($usa->term_sub_activity->level) == 'excellent') {
                       // $qexcellent['excellent']=  $usa;
                       $qexcellent[]=  $usa;


                    }


             }
            }

            $quality[]=['low'=>$low ,'enough'=>$enough ,'high'=>$high , 'excellent'=>$excellent];
            $time[]=['low'=>$tlow ,'enough'=>$tenough ,'high'=>$thigh , 'excellent'=>$texcellent];
            $quantity[]=['low'=>$qlow ,'enough'=>$qenough ,'high'=>$qhigh , 'excellent'=>$qexcellent];
            $dps['user_sub_activity']=['quality'=>$quality,'quantity'=>$quantity,'time'=>$time];
            $all[]=$dps;





      }
    }

  }
  return   $all;


}



}
