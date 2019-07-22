<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Asset;

class TrackAssetMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return "<h1>HEYY!!!</h1>";
    }

    // <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=Gambia%20Tourism%20Board&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.vpnchief.com">vpn subscription</a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div>


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $department = Department::pluck("depName","id");
        $destDep = $department;
        $data = array("depNames"=>$department,"destDep"=>$destDep);
        return view("TrackAssetMovement/moveAssets",$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        //
        $srcDep = $r ->srcDep;
        $srcUnit = $r -> srcId;
        $assetToMove = $r -> aToMoveId;
        $destDep = $r ->destDepId;
        $destUnit = $r -> destUnitId;

        // if()

        $data = "Source Department: ".$srcDep.
                "<br/>Source Unit : ".$srcUnit.
                "<br/>Destination Department: ".$destDep.
                "<br/>Destination Unit".$destUnit.
                "<br/>Asset To Move".$assetToMove;

                $asset = Asset::find($assetToMove);
                $asset -> aDep = $destDep;
                $asset -> aUnit = $destUnit;
                $asset->save();

                return redirect("/trackmovement/create");

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
    }
}
