<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssetCategory;
use App\AssetType;
use App\AssetLocation;
use App\Department;
use App\Asset;
use App\Unit;
use Picqer;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $allAssets = Asset::paginate(3);
        // $allAssets = Asset::all();
        $categoryName = array();
        $assetDepartment = array();
        $assetUnit = array();
        $location = array();
        $categoryNames = array();
        $barcodeImage = array();
        $count = 0;
        while($count < count($allAssets)){
            $categoryId = $allAssets[$count]->assetCategory;
            $typeId = $allAssets[$count]->assetType;
            $locationId = $allAssets[$count]->assetLocation;
            $unitId = $allAssets[$count]->aUnit;
            $depId = $allAssets[$count]-> aDep;
            $depName = Department::find($depId)->depName;
            $catName = AssetCategory::find($categoryId) -> catName;
            $locationName = AssetLocation::find($locationId) -> locationName;
            $unitName = Unit::find($unitId) -> unitName;
            $catName = AssetCategory::find($categoryId) -> catName;
            $code = $allAssets[$count]->barcode;
            $barcode = new Picqer\Barcode\BarcodeGeneratorPNG();
            $img = $barcode->getBarcode($code,$barcode::TYPE_CODE_128);
            array_push($barcodeImage,$img);
            
            array_push($categoryNames,$catName);
            array_push($assetUnit,$unitName);
            array_push($assetDepartment,$depName);
            array_push($location,$locationName);
            array_push($categoryName,$catName);

            $count++;
        }
        $data = array("barcodeImage"=>$barcodeImage,"categoryNames"=>$categoryNames,"allAsset"=>$allAssets,"assetUnit"=>$assetUnit,"catName"=>$categoryName,"location"=>$location,"assetDepartment"=>$assetDepartment);
        return view("Assets.View",$data);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $acategoryList = AssetCategory::pluck("catName","id");
        $assetLocation = AssetLocation::pluck("locationName","id");
        $departments = Department::pluck("depName","id");
        $data = array("depName"=>$departments,"acategory" => $acategoryList,"assetLocation"=>$assetLocation);
        return view("Assets.create",$data);
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
        $years = $request -> aUsagePeriod;
        $months = $years * 12;
        $storeAsset = new Asset();
            $storeAsset -> assetName = $request -> aName;
            $storeAsset -> assetCost = $request -> aCost;
            $storeAsset -> residualValue = $request -> rValue;
            $storeAsset -> assetCategory = $request -> aCategory;
            $storeAsset -> assetType = $request -> aType;
            $storeAsset -> assetLocation = $request -> aLocation;
            $storeAsset -> assetUsagePeriod = $request -> aUsagePeriod;
            $storeAsset -> assetMonthlyDepreciation = $request -> mDepreciation;
            $storeAsset -> assetBookValue = $request -> bValue;

            $storeAsset -> totalDepreciatedAmount = 0;
            $storeAsset -> totalMonthsLeft = $months;
            $storeAsset -> assetStartDate = $request -> aStartDate;

            $storeAsset -> assetStatus = 1;
            $storeAsset -> assetDescription = $request -> aDescription;
            $storeAsset -> barcode = $request -> bCode;

            $storeAsset -> totalMonthsDepreciated =  0;
            $storeAsset -> userAssigned = $request -> uAssigned;
            $storeAsset -> backTracked = 0;
            $storeAsset -> aUnit = $request -> unitId;
            $storeAsset -> aDep = $request -> aDep;

            $storeAsset->save();
            return redirect(("/asset"));
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
         $asset = Asset::find($id);
         $acategoryList = AssetCategory::pluck("catName","id");
         $assetLocation = AssetLocation::pluck("locationName","id");
        $departments = Department::pluck("depName","id");
        $data = array("asset"=>$asset,"depName"=>$departments,"acategory" => $acategoryList,"assetLocation"=>$assetLocation);
        return view("Assets.Modify",$data);
        return "Editing id $id";
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
               $storeAsset = Asset::find($id);
            $storeAsset -> assetName = $request -> aName;
            $storeAsset -> assetCost = $request -> aCost;
            $storeAsset -> residualValue = $request -> rValue;
            $storeAsset -> assetCategory = $request -> aCategory;
            $storeAsset -> assetType = $request -> aType;
            $storeAsset -> assetLocation = $request -> aLocation;
            $storeAsset -> assetUsagePeriod = $request -> aUsagePeriod;
            $storeAsset -> assetMonthlyDepreciation = $request -> mDepreciation;
            $storeAsset -> assetBookValue = $request -> bValue;

            $storeAsset -> totalDepreciatedAmount = 0;
            // $storeAsset -> totalMonthsLeft = $months;
            $storeAsset -> assetStartDate = $request -> aStartDate;

            $storeAsset -> assetStatus = 1;
            $storeAsset -> assetDescription = $request -> aDescription;
            $storeAsset -> barcode = $request -> bCode;

            $storeAsset -> totalMonthsDepreciated =  0;
            $storeAsset -> userAssigned = $request -> uAssigned;
            $storeAsset -> backTracked = 0;
            $storeAsset -> aUnit = $request -> unitId;
            $storeAsset -> aDep = $request -> aDep;

            $storeAsset->save();
            return redirect(("/asset"));

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
        $assetToDelete = Asset::find($id);
        $assetToDelete->delete();
        return redirect("/asset");
    }
}
