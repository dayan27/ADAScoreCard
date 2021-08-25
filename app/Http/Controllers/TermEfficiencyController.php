<?php

namespace App\Http\Controllers;

use App\Models\TermEfficiency;
use Illuminate\Http\Request;

class TermEfficiencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TermEfficiency::all();
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

            'total_behavior_result'=>'required',
            'total_term_activity_result'=>'required',
            'result'=>'required',
            'employee_id'=>'required'
        ]);
        TermEfficiency::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TermEfficiency $termEfficiency)
    {
      return $termEfficiency;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,TermEfficiency $termEfficiency)
    {
        $request->validate([

            'total_behavior_result'=>'required',
            'total_term_activity_result'=>'required',
            'result'=>'required',
            'employee_id'=>'required'
        ]);
        $termEfficiency->update($request->all());
        return $termEfficiency;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermEfficiency $termEfficiency)
    {
        $termEfficiency->delete();
    }
}
