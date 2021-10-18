<?php

namespace App\Http\Controllers;

use App\Http\Resources\StrategicPlanResource;
use App\Models\Department;
use App\Models\DepartmentCard;
use App\Models\DepartmentPlan;
use App\Models\Employee;
use App\Models\ScoreCard;
use App\Models\StrategicPlan;
use App\Models\User;
use App\Models\YearCard;
use App\Notifications\StrategicPlanShared;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\ErrorHandler\Collecting;
use Illuminate\Support\Facades\Notification;

class ScoreCardController extends Controller
{




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ScoreCard::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $scoreCard=new ScoreCard();
        $request->validate([
          'name'=>'required',
          'to'=>'required',
          'from'=>'required',
          'description'=>'required'
        ]);

        $scoreCard->name=$request->name;
        $scoreCard->description=$request->description;
        $to = strtotime($request->to);
        $from = strtotime($request->from);
        $toformat = date('Y-m-d',$to);
        $fromformat = date('Y-m-d',$from);
        $scoreCard->to=$toformat;
        $scoreCard->from=$fromformat;
        $scoreCard->save();
        return $scoreCard;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScoreCard  $scoreCard
     * @return \Illuminate\Http\Response
     */
    public function show($id)

    {
         $user= request()->user();
        // return $user;
      // $user=User::find(4);
     //  return response()->json(['user'=>$user]);
        $scoreCard=ScoreCard::find($id);

        $sps=null;
        if($user->role == 'manager'){
            $sps=$scoreCard->strategic_plans;

        }else if($user->role == 'employee'){

            if ($scoreCard->make_visible) {
              //  return $scoreCard->make_visible;
                $sps=$scoreCard->strategic_plans;

            }
        }else if( $user->role == 'department head'){
            if ($scoreCard->make_visible) {
                $sps=$scoreCard->strategic_plans;

            }

        }

       //DB::table('notifications')->where('id',request('notification_id'))->first()->markAsRead();


        return response()->json([
           'department_cards'=>$scoreCard->department_cards,
           'users'=>$user->role=='manager' ? User::where('department_id' ,$user->department_id)
                                                   ->where('role','!=','manager')->get():null,
            'strategic_plans'=>$sps != null ? $sps->makeHidden('yearly_plans','pivot')->load('departments:id,name') : [],
            'year_cards'=>$scoreCard->year_cards,
        ],201);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ScoreCard  $scoreCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $scoreCard=ScoreCard::findorfail($id);
                // dd($scoreCard);

        $request->validate([
            'name'=>'required',
            'to'=>'required',
            'from'=>'required',
            'description'=>'required'
          ]);
          $scoreCard->name=$request->name;
          $scoreCard->description=$request->description;
          $scoreCard->to=$request->to;
          $scoreCard->from=$request->from;
          $scoreCard->save();
          return $scoreCard;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScoreCard  $scoreCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScoreCard $scoreCard)
    {
        $scoreCard->delete();
    }

    public function make_visible($id)
    {
       $scoreCard= ScoreCard::find($id);

       if($scoreCard->make_visible){
      // return request()->visiblity;
        foreach (User::all() as $user) {
            $user->notifications()->where('type','App\Notifications\StrategicPlanShared')->delete();
        }

        $scoreCard->make_visible=request()->visiblity;
        $scoreCard->save();
        return $scoreCard;
       }
       $scoreCard->make_visible=request()->visiblity;
       $scoreCard->save();
       $users=User::where('id' ,'!=', request()->user()->id)->get();
      // return $users;
       Notification::send($users,new StrategicPlanShared($id));
       return $scoreCard;
       //$scoreCard->update(['make_visible'=>request()->make_visible]);
    }
}
