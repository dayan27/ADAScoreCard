<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use Illuminate\Http\Request;

class BehaviorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Behavior::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title'=>'required',
                'weight'=>'required',
]
            
            );

        return Behavior::create($request->all());


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Behavior $behavior)
    {
        return $behavior;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Behavior $behavior)
    {
        $request->validate(
            [
                'title'=>'required',
                'weight'=>'required',

            ]
            );

            return  $behavior->update($request->all());
         return $behavior;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Behavior $behavior)
    {
      $behavior->delete();
    }
}
