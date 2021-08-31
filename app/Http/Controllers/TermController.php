<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

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
    public function show(Term $term)
    {
        return $term;
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
        $term->make_visible=request()->visiblity;
        $term->save();
        return $term;

    }
}
