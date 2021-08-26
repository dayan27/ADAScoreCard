<?php

namespace App\Http\Controllers;

use App\Models\TermActivity;
use Illuminate\Http\Request;

class TermActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TermActivity::all();
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
            'to'=>'required',
            'from'=>'required',
            'term_id'=>'required',
            'department_plan_id'=>'required'
        ]);

        $data=$request->all();

        $to = strtotime($request->to);
        $from = strtotime($request->from);
        $toformat = date('Y-m-d',$to);
        $fromformat = date('Y-m-d',$from);
        $data['to']=$toformat;
        $data['from']=$fromformat;
        return TermActivity::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TermActivity $termActivity)
    {
        return $termActivity;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,TermActivity $termActivity)
    {
        $request->validate([
            'to'=>'required',
            'from'=>'required',
            'term_id'=>'required',
            'department_plan_id'=>'required'
        ]);

        $data=$request->all();

        $to = strtotime($request->to);
        $from = strtotime($request->from);
        $toformat = date('Y-m-d',$to);
        $fromformat = date('Y-m-d',$from);
        $data['to']=$toformat;
        $data['from']=$fromformat;
        $termActivity->update($data);
        return $termActivity;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermActivity $termActivity)
    {
        $termActivity->delete();
    }
}
