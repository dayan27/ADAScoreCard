<?php

namespace App\Http\Controllers;

use App\Models\EmployeeSubActivity;
use Illuminate\Http\Request;

class EmployeeSubActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return EmployeeSubActivity::all();
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
            'isAccepeted'=>'required',
            'term_sub_activity_id'=>'required',
            'employee_id'=>'required',
            'employee_activity_id'=>'required',

        ]);

        return  EmployeeSubActivity::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeSubActivity $employeeSubActivity)
    {
        return $employeeSubActivity;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeSubActivity $employeeSubActivity)
    {
        $request->validate([
            'title'=>'required',
            'isAccepeted'=>'required',
            'term_sub_activity_id'=>'required',
            'employee_id'=>'required',
            'employee_activity_id'=>'required',

        ]);

        $employeeSubActivity->update($request->all());

        return $employeeSubActivity;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeSubActivity $employeeSubActivity)
    {
        $employeeSubActivity->delete();
    }
}
