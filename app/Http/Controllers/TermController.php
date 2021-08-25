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
        $request->validate([

            'term_no'=>'required',
            'title'=>'required',
            'year'=>'required',
            'department_id'=>'required'
        ]);
       return Term::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
            'year'=>'required',
            'department_id'=>'required'
        ]);
        $term->update($request->all());
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
}
