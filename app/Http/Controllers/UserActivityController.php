<?php

namespace App\Http\Controllers;

use App\Models\UserActivity;
use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return UserActivity::all();
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
        'result'=>'required',
        'time_result'=>'required',
        'quality_result'=>'required',
        'quantity_result'=>'required',
        'term_id'=>'required',
        'user_id'=>'required',

      ]);

      return UserActivity::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserActivity $userActivity)
    {
       return $userActivity;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,UserActivity $userActivity)
    {
        $request->validate([
            'result'=>'required',
            'time_result'=>'required',
            'quality_result'=>'required',
            'quantity_result'=>'required',
            'term_id'=>'required',
            'employee_id'=>'required',

          ]);

         $userActivity->update($request->all());
         return $userActivity;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserActivity $userActivity)
    {
        $userActivity->delete();
    }
}
