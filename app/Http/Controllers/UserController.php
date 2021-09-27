<?php

namespace App\Http\Controllers;

use App\Http\Resources\DepartmentPlanResource;
use App\Models\DepartmentCard;
use App\Models\Term;
use App\Models\TermActivity;
use App\Models\TermSubActivity;
use App\Models\User;
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
        $department=$user->department;
        $department_plans=$department->department_plans;
        $dps=[];
        $all=[];
        //  return $department_plans;
        //return $user->terms()->first()->pivot->draft_visiblity;

        // if($user->terms()->first()->pivot->draft_visiblity){
        //  $term_id=$user->terms()->first()->pivot->term_id;
        //  $term_visiblity=Term::find($term_id)->make_visible;
        foreach ($department_plans as  $dp) {
            $dps['id']=$dp->id;
            $dps['activity']=$dp->activity;
            $dps['quantity_weight']=$dp->quantity_weight;
            $dps['time_weight']=$dp->time_weight;
            $dps['quality_weight']=$dp->quality_weight;
         // return   $dp->user_activities;
            foreach ($dp->user_activities as $ua) {
              //  $dps['user_activity']=$dp->$ua;
              if ($ua->term_activity->term->make_visible && ! $ua->term_activity->term->is_completed) {


                 $quality=[];
                 $quantity=[];
                 $time=[];
                foreach ($ua->user_sub_activities as  $usa) {


                          $term_activity_id =TermSubActivity::find($usa->term_sub_activity_id)->term_activity_id;
                        $term=  TermActivity::find($term_activity_id)->term;
                        $term_id=$term->id;
                        $department_card_id=$term->department_card_id;
                        $usa['term_id']=$term_id;
                        $usa['department_card_id']=$department_card_id;

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
              //  $dps['user_sub_activity']=['quality'=>$quality,'quantity'=>$quantity,'time'=>$time];

            }

          }
          $all[]=$dps;

        }

        return $all;

      // return DepartmentPlanResource::collection($department_plans);
     // $activities= $department_plans->user_sub_activities;
       return response()->json([


        // 'visiblity'=>$term_visiblity,
        'department_plans'=>$all
       // 'user_sub_activities'=>$user->user_sub_activities->load('term_sub_activity'),
       //'department_plans'=>$department_plans,
      // 'activities'=>$activities
    ]);
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

       foreach ($department_plans as $dp) {

          //return $dp->term_activity->term->make_visible;
        if ($dp->term_activity->term->make_visible && ! $dp->term_activity->term->is_completed ) {



          $dps['id']=$dp->id;
          $dps['activity']=$dp->activity;
          $dps['quantity_weight']=$dp->quantity_weight;
          $dps['time_weight']=$dp->time_weight;
          $dps['quality_weight']=$dp->quality_weight;


           //$dps['term_activities']=['id'];
           // $tsas= $ta->term_sub_activities;
           $dps['term_activities']=array('id'=>  $dp->term_activity->id);

           $quality=[];
           $quantity=[];
           $time=[];

          foreach ($dp->term_activity->term_sub_activities as  $tsa) {


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
          //$dps['term_sub_activities']['term_sub_activities']=array('quality'=>$quality,'quantity'=>$quantity,'time'=>$time);
           //   return $dps['term_activities']['term_sub_activities'];

            //  return $dps;

          $all[]=$dps;

           }else{

          }

         $terms=$dp->term_activity->term;

       }
      // return $terms;
     // return $terms;
       //return $terms;
     // return $all;
       /////////////////

        return response()->json([
             'term'=>$terms,
            'termActivity'=>$all,
            //  'department_plans'=>$department_plans->where('department_card_id', $id)->values() ->makeHidden('department_card')

            //  ->load('term_activity.term_sub_activities') ,
           //  'department_cards'=>$department_cards,
            //  'terms'=> array_filter($terms,function($term) use($id){
            //      return $term['department_card_id']=$id;
            //  }) ,

     ]);
    }

    public function get_user_activity($id){

        $user=User::find($id);
        $department=$user->department;
        $department_plans=$department->department_plans;
        $dps=[];
        $all=[];
        $dep_cards=DepartmentCard::all();
        $coll=[];
        $all_coll=[];

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


        foreach ($department_plans as  $dp) {
            $dps['id']=$dp->id;
            $dps['activity']=$dp->activity;
            $dps['quantity_weight']=$dp->quantity_weight;
            $dps['time_weight']=$dp->time_weight;
            $dps['quality_weight']=$dp->quality_weight;
            $dps['year']=$dp->department_card->year;

            foreach ($dp->user_activities as $ua) {
                // return $ua;

                if ($ua->term_activity->term->make_visible && ! $ua->term_activity->term->is_completed) {

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
                            $excellent['excellent']=  $usa;

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
                            $texcellent['excellent']=  $usa;

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
                            $qexcellent['excellent']=  $usa;

                        }


                 }
                }

                $quality[]=['low'=>$low ,'enough'=>$enough ,'high'=>$high , 'excellent'=>$excellent];
                $time[]=['low'=>$tlow ,'enough'=>$tenough ,'high'=>$thigh , 'excellent'=>$texcellent];
                $quantity[]=['low'=>$qlow ,'enough'=>$qenough ,'high'=>$qhigh , 'excellent'=>$qexcellent];
                $dps['user_sub_activity']=['quality'=>$quality,'quantity'=>$quantity,'time'=>$time];

            }

          }

          $all[]=$dps;

        }


        // return $all;
        return response()->json([
            'TermYearCard'=>$all_coll,
            'TermActivity'=>$all,
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
        $user->terms()->updateExistingPivot($term_id,['draft_visiblity'=>request()->visiblity]);
                $user->terms()->first()->pivot->save();

        // =request()->visiblity;$ter
        return $user->terms()->first()->pivot;

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
        $department=$user->department;
        $department_plans=$department->department_plans;
        $dps=[];
        $all=[];
        //  return $department_plans;
        // if ($user->pivot->draft_visiblity) {
              // return $user->pivot;

        foreach ($department_plans as  $dp) {
            $dps['id']=$dp->id;
            $dps['activity']=$dp->activity;
            $dps['quantity_weight']=$dp->quantity_weight;
            $dps['time_weight']=$dp->time_weight;
            $dps['quality_weight']=$dp->quality_weight;
         // return   $dp->user_activities;
            foreach ($dp->user_activities as $ua) {
              //  $dps['user_activity']=$dp->$ua;

              if ($ua->term_activity->term->make_visible && ! $ua->term_activity->term->is_completed) {


                 $quality=[];
                 $quantity=[];
                 $time=[];

                 if(!$ua->user_sub_activities->isempty()){
                     continue;
                 }

                    foreach ($ua->user_sub_activities as  $usa) {
                        // if(!$usa->term_sub_activity){

                        // }


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






              //  $dps['user_sub_activity']=['quality'=>$quality,'quantity'=>$quantity,'time'=>$time];


            }

            $term_activity_id=$ua->term_activity_id;


          }
         //  $term=TermActivity::find($term_activity_id)->term;

          $all[]=$dps;

        }
  //  }
        //return $all;

      // return DepartmentPlanResource::collection($department_plans);
     // $activities= $department_plans->user_sub_activities;
       return response()->json([
        'draft_visiblity'=>$user->terms()->first()->pivot->draft_visiblity,
       // 'term'=>$term,
        'department_plans'=>$all
        //'department_plans'=>$department_plans->load('user_activities.user_sub_activities')
       // 'user_sub_activities'=>$user->user_sub_activities->load('term_sub_activity'),
       //'department_plans'=>$department_plans,
      // 'activities'=>$activities
    ]);
}
}
