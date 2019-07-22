<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssetCategory;
use App\CatPostFix;
use App\Asset;
use App\Unit;
use App\Department;
use Picqer;
use App\AssetLocation;

class fetchData extends Controller
{
    //
//         public function getData($input){
//            //$test = Input::get('pID');
//     $pPrice = Product::find($input);
//    // return response()->json(...);
//     return \Response::json($pPrice);

//       //  return ("<h1>$input</h1>");
//     }

 public function getAssetList(){
      $aList = Asset::all();
      return \Response::json($aList);
    }
     public function getCategoryList(){
         $catList = AssetCategory::all();
         return \Response::json($catList);
     }

    public function getData($input){
             $category = AssetCategory::find($input);
             $catId = $category -> categoryTag;
             $catTag = CatPostFix::find($catId)->postFixTab; 
             $sCatListCount = Asset::where('barcode', 'LIKE', '%' . $catTag)->get();
             $tmp = "";
             if(count($sCatListCount) > 0){
                $sCatList = Asset::where('barcode', 'LIKE', '%' . $catTag)
                ->orderby("barcode","DESC")
                ->limit(1)
                ->get()[0]
                ->barcode; 
                $pFix = $sCatList;
                    $len = strlen($pFix);
                    $sbstr = substr($pFix,1,4);
                    $sbstr = $sbstr+1;
                    $length = strlen($sbstr);
                    if($length == 1){
                            $tmp = "A000".$sbstr.$catTag;
                        }
                    else if($length ==2){
                            $tmp = "A00".$sbstr.$catTag;
                    }
                    else if($length == 3){
                            $tmp = "A0".$sbstr.$catTag;
                    }
                    else{
                            $tmp = "A".$sbstr.$catTag;
                    }
            }
            else{
                $tmp = "A0001".$catTag;
            } 
                 return \Response::json($tmp);
    }

    public function getDepUnit($id){
      $unitList = Unit::where("department",$id)->get();
      return \Response::json($unitList);
    
    }
    public function getSourceUnit($id){
        $sourceUnitList = Unit::where("department",$id)->get();
        return \Response::json($sourceUnitList);
    }
    public function getDestUnit($id){
        $destUnit = Unit::where("department",$id)->get();

        return \Response::json($destUnit);
    }
    public function assetindep($id){
        $assetInCurDep = Asset::where("aDep",$id)->get();

        return \Response::json($assetInCurDep);
    }
    public function noDupDepartment($id){
        $departments = Department::where("id", "!=",$id)->get();
        
        return \Response::json($departments);
    }
    public function getDepreciatedAssets(){
            //Assets = Asset::paginate(3);
         $depreciatedAssets = Asset::where("assetStatus",1)->get();
        $categoryName = array();
        $assetDepartment = array();
        $assetUnit = array();
        $location = array();
        $categoryNames = array();
        $barcodeImage = array();
        $count = 0;
        while($count < count($depreciatedAssets)){
            $categoryId = $depreciatedAssets[$count]->assetCategory;
            $typeId = $depreciatedAssets[$count]->assetType;
            $locationId = $depreciatedAssets[$count]->assetLocation;
            $unitId = $depreciatedAssets[$count]->aUnit;
            $depId = $depreciatedAssets[$count]-> aDep;
            $depName = Department::find($depId)->depName;
            $catName = AssetCategory::find($categoryId) -> catName;
            $locationName = AssetLocation::find($locationId) -> locationName;
            $unitName = Unit::find($unitId) -> unitName;
            $catName = AssetCategory::find($categoryId) -> catName;
            $code = $depreciatedAssets[$count]->barcode;
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
        $data = array("barcodeImage"=>$barcodeImage,"categoryNames"=>$categoryNames,"allAsset"=>$depreciatedAssets,"assetUnit"=>$assetUnit,"catName"=>$categoryName,"location"=>$location,"assetDepartment"=>$assetDepartment);
        return view("Malecious.depreciatedAsset",$data);
    }
    public function getValuableAssets(){
                //
        //$valuableAssets = Asset::paginate(3);
         $valuableAssets = Asset::where("assetStatus",0)->get();
        $categoryName = array();
        $assetDepartment = array();
        $assetUnit = array();
        $location = array();
        $categoryNames = array();
        $barcodeImage = array();
        $count = 0;
        while($count < count($valuableAssets)){
            $categoryId = $valuableAssets[$count]->assetCategory;
            $typeId = $valuableAssets[$count]->assetType;
            $locationId = $valuableAssets[$count]->assetLocation;
            $unitId = $valuableAssets[$count]->aUnit;
            $depId = $valuableAssets[$count]-> aDep;
            $depName = Department::find($depId)->depName;
            $catName = AssetCategory::find($categoryId) -> catName;
            $locationName = AssetLocation::find($locationId) -> locationName;
            $unitName = Unit::find($unitId) -> unitName;
            $catName = AssetCategory::find($categoryId) -> catName;
            $code = $valuableAssets[$count]->barcode;
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
        $data = array("barcodeImage"=>$barcodeImage,"categoryNames"=>$categoryNames,"allAsset"=>$valuableAssets,"assetUnit"=>$assetUnit,"catName"=>$categoryName,"location"=>$location,"assetDepartment"=>$assetDepartment);
        return view("Malecious.valuableAsset",$data);
        //return view("Assets.View",$data);
    }
    public function aTwoMonthsLeft(){
        $valuableAssets = Asset::where("totalMonthsLeft","=",2)->get();
        $categoryName = array();
        $assetDepartment = array();
        $assetUnit = array();
        $location = array();
        $categoryNames = array();
        $barcodeImage = array();
        $count = 0;
        while($count < count($valuableAssets)){
            $categoryId = $valuableAssets[$count]->assetCategory;
            $typeId = $valuableAssets[$count]->assetType;
            $locationId = $valuableAssets[$count]->assetLocation;
            $unitId = $valuableAssets[$count]->aUnit;
            $depId = $valuableAssets[$count]-> aDep;
            $depName = Department::find($depId)->depName;
            $catName = AssetCategory::find($categoryId) -> catName;
            $locationName = AssetLocation::find($locationId) -> locationName;
            $unitName = Unit::find($unitId) -> unitName;
            $catName = AssetCategory::find($categoryId) -> catName;
            $code = $valuableAssets[$count]->barcode;
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
        $data = array("barcodeImage"=>$barcodeImage,"categoryNames"=>$categoryNames,"allAsset"=>$valuableAssets,"assetUnit"=>$assetUnit,"catName"=>$categoryName,"location"=>$location,"assetDepartment"=>$assetDepartment);
        return view("fetchData.assetToDepreciateTwoMonths",$data);
        // return view();
    }
    
}
