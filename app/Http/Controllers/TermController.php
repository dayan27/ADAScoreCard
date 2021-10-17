<?php

namespace App\Http\Controllers;

use App\Models\Term;
use App\Models\User;
use App\Notifications\TermPlanShared;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TermController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Term::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuate\Http\Response
     */
    public function show()
    {

     //return Term::where('department_card_id',$department_card_id)->where('department_id',request()->department_id);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Term $term)
    {
        $request->validate([

            'term_no'=>'required',
            'title'=>'required',
            'to'=>'required',
            'from'=>'required',
            'department_id'=>'required',
            'department_card_id'=>'required'
        ]);


        $data=$request->all();

        $to = strtotime($request->to);
        $from = strtotime($request->from);
        $toformat = date('Y-m-d',$to);
        $fromformat = date('Y-m-d',$from);
        $data['to']=$toformat;
        $data['from']=$fromformat;
        $term->update($data);
        return $term;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Term $term)
    {
        $term->delete();
    }

    public function make_visible($id)
    {
        $term= Term::find($id);
        $dep_card=$term->department_card;

        //condition to make invisible
        if ($term->make_visible) {

            $term->make_visible=request()->visiblity;
            $term->save();
            return $term;
        }else{

        foreach ($dep_card->terms as $term1) {

            //condition to check weather there is incompleted term
            if ($term1->make_visible && ! $term1->is_completed) {
                return response()->json(['message'=>'there is un completed term']);
            }
        }
    }
       //making term visible
        $term->make_visible=request()->visiblity;
        $term->save();
        Notification::send(User::all()
        ->where('role','employee')
        ->where('department_id', auth()->user()->department_id),new TermPlanShared());

        return $term;

    }

    public function get_terms($department_card_id){
      return   Term::all()->where('department_card_id',$department_card_id);

 }
 public function make_term_completed($term_id){
     $term=Term::find($term_id);
     $term->is_completed=request()->is_completed;
     $term->save();
     return $term;

 }
}
