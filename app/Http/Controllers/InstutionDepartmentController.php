<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
//use App\DepartmentLocation;
use App\AssetLocation;

class InstutionDepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$location = AssetLocation::all();
        //$data = array("location"=>$location);
        $assetDepartment = Department::all();
        $data = array("assetDepartment"=>$assetDepartment);
        return view("InstutionDepartment.View",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //$department = DepartmentLocation::all();
        return view('InstutionDepartment.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $department = new Department();
        $department -> depName= $request -> depName;
        $department -> save();

        return redirect("/instdepartment");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $instDepartmentToUpdate = Department::find($id);
        $data = array("instDepartmentToUpdate" => $instDepartmentToUpdate);
        return view("InstutionDepartment.Edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $departmentToUpdate = Department::find($id);
        $departmentToUpdate -> depName = $request -> instDepartmentToUpdate;
        $departmentToUpdate -> save();
        return redirect('/instdepartment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //$actId = $id->id;
        $deleteDepartment = Department::find($id);
        $deleteDepartment->delete();
        return redirect("/instdepartment");
    }
}
