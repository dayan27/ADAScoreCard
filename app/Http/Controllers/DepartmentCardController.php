<?php

namespace App\Http\Controllers;

use App\Models\DepartmentCard;
use Illuminate\Http\Request;

class DepartmentCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DepartmentCard::all();
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
                'year'=>'required',
                'number_of_term'=>'required',

            ]
            );

            return DepartmentCard::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DepartmentCard  $departmentCard
     * @return \Illuminate\Http\Response
     */
    public function show(DepartmentCard $departmentCard)
    {
        return $departmentCard;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DepartmentCard  $departmentCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DepartmentCard $departmentCard)
    {
        $request->validate(
            [
                'year'=>'required',
                'number_of_term'=>'required',

            ]
            );

            $departmentCard->update($request->all());
            return $departmentCard;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DepartmentCard  $departmentCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(DepartmentCard $departmentCard)
    {
        $departmentCard->delete();
    }
}
