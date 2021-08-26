<?php

namespace App\Http\Controllers;

use App\Models\Perspective;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PerspectiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Hash::make('password');
        return Perspective::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $perspective=new Perspective();
        $request->validate([
            'title'=>'required',
            'description'=>'required',

        ]);
        $perspective->title=$request->title;
        $perspective->description=$request->description;
        $perspective->save();
        return $perspective;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Perspective $perspective)
    {
        return $perspective;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perspective $perspective)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',

        ]);
        $perspective->title=$request->title;
        $perspective->description=$request->description;
        $perspective->save();
        return $perspective;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perspective $perspective)
    {
        $perspective->delete();
    }
}
