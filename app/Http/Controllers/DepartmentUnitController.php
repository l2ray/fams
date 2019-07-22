<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Unit;

class DepartmentUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departmentUnits = Unit::all();
        $unitArr = array();
        $unitArrDep = array();
        for($count = 0; $count < count($departmentUnits); $count++){
            $unitId = $departmentUnits[$count] -> id;
            $unitName = $unitId.":".$departmentUnits[$count] -> unitName;
            $unitDep = $departmentUnits[$count] -> department;

            $actDepName = Department::find($unitDep) -> depName;
            $unitArr[$unitName] = $actDepName;
            
            array_push($unitArrDep,$actDepName);
            
        }
        $data = array("departmentUnits" => $departmentUnits,"unitArr"=>$unitArr,"unitArrDep"=>$unitArrDep);

        return view("DepUnit.view",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $unitList = Department::pluck("depName","id");
        $data = array("unitList" => $unitList);
        return view("DepUnit.create",$data);
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
        $depUnit = new Unit();
        $depUnit -> unitName = $request -> uName;
        $depUnit -> department = $request -> depId;
        $depUnit -> save();

        return view("DepUnit.view");

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
        $unitList = Unit::find($id);
        $depList = Department::pluck("depName","id");
        $data = array("unitList"=>$unitList,"depList" => $depList);
        return view("DepUnit.modify",$data);
        
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
        $depUnit = Unit::find($id);
        $depUnit -> unitName = $request -> instDepartmentUnitToUpdate;
        $depUnit -> department = $request -> depId; 
        $depUnit -> save();
        return redirect("/departmentunit");
        
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
        $depUnit = Unit::find($id);
        $depUnit -> delete();
        return redirect("/departmentunit");
    }
}
