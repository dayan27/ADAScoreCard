<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return Department::with('user')->get();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $department=new Department();
        $request->validate([
            'name'=>'required',
            'phone_no'=>'required',
            'email'=>'required',
            'role'=>'required',

        ]);

        return Department::create($request->all());


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        $users=$department->users;
        $department_plans=$department->department_plans;
        return response()->json([
               'users'=>$users,
               'department_plans'=>$department_plans
        ]) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name'=>'required',
            'phone_no'=>'required',
            'email'=>'required',
            'role'=>'required',

        ]);

        $department->update($request->all());
        return $department;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {

      $department->delete();
    }

    public function assignManager($department_id){

       $dept= Department::find($department_id);
    //    return $dept->user_id;
       $dept->user_id=request()->user_id;

        $dept->save();
       $manager= User::find($dept->user_id);
      return  $manager->first_name;
       // return $dept;
    }

    // public function check_break(){
    //     $deps=Department::all();
    //     $all=[];
    //     foreach($deps as $dep){
    //         if($dep->id==3){
    //             continue;
    //         }
    //        array_push($all,$dep)  ;
    //     }
    //     return $all;

    // }
}
