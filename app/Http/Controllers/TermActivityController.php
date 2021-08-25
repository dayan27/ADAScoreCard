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

        return TermActivity::create($request->all());
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

        $termActivity->update($request->all());
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
