<?php

namespace App\Http\Controllers;

use App\Models\EmployeeActivity;
use Illuminate\Http\Request;

class EmployeeActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          return EmployeeActivity::all();
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
        'employee_id'=>'required',

      ]);

      return EmployeeActivity::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeActivity $employeeActivity)
    {
       return $employeeActivity;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,EmployeeActivity $employeeActivity)
    {
        $request->validate([
            'result'=>'required',
            'time_result'=>'required',
            'quality_result'=>'required',
            'quantity_result'=>'required',
            'term_id'=>'required',
            'employee_id'=>'required',

          ]);

         $employeeActivity->update($request->all());
         return $employeeActivity;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeActivity $employeeActivity)
    {
        $employeeActivity->delete();
    }
}
