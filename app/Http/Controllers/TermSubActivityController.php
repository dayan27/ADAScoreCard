<?php

namespace App\Http\Controllers;

use App\Models\TermSubActivity;
use Illuminate\Http\Request;

class TermSubActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TermSubActivity::all();
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
            'title'=>'required',
            'level'=>'required',
            'measurment'=>'required',
            'added_by'=>'required',
            'term_activity_id'=>'required'
         ]);
        return TermSubActivity::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TermSubActivity $termActivity)
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
    public function update(Request $request, TermSubActivity $termSubActivity)
    {

     $request->validate([
        'title'=>'required',
        'level'=>'required',
        'measurment'=>'required',
        'added_by'=>'required',
        'term_activity_id'=>'required'
     ]);
      $termSubActivity->update($request->all());
      return $termSubActivity;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TermSubActivity $termSubActivity)
    {
        $termSubActivity->delete();
    }
}
