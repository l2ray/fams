<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CatPostFix;
use Illuminate\Support\Facades\App;
use App\AssetCategory;
use BarCode;

class AssetCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        
        $assetCategory = AssetCategory::all();
        $assetCat = array();
        $catTag = array();
        $assetCatId = array();
        for($x = 0; $x < count($assetCategory); $x++){
            $assetTag = $assetCategory[$x] -> categoryTag;
            $tagName = CatPostFix::find($assetTag)->postFixTab;
            array_push($catTag,$tagName);
            array_push($assetCatId,$assetCategory[$x] ->id);
            $assetCat[$assetCategory[$x] -> catName] = $assetCategory[$x]-> catDescription;
        }
        
        $data = array("aCategory"=>$assetCat,"catTag"=>$catTag,"assetCatId"=>$assetCatId);
        return  view('AssetCategory.view',$data);

        


//                           $bar2 = App::make('BarCode');
// $barcontent2 = $bar2->barcodeFactory("BarCode")
//                   ->renderBarcode(
//                           $filepath ='', 
//                           $text="A0004ABBBC", 
//                           $size='50', 
//                           $orientation="horizontal", 
//                           $code_type="code128",// code_type : code128,code39,code128b,code128a,code25,codabar 
//                           $print=true, 
//                           $sizefactor=1
//                   );
// return '<img alt="testing" src="'.$barcontent2.'"/>';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $catTag = CatPostFix::pluck('postFixTab','id');
        $arr = array("sd"=>"sdf","swe"=>"32sf");
         $test = CatPostFix::where("isUsed","==",0)->get();//where("created_at","<=",$endDate)->orderBy('created_at', 'asc')->get();
        $countIt = count($test);
        $tags = array();
        for($x = 0; $x<$countIt; $x++){
            $id = $test[$x]->id;
            $tagLbl = $test[$x]->postFixTab;
            $tags[$id] = $tagLbl;
            //$test[$x]->id => $test[$x]->sdf,$tags);
        }
        $data = array("catTag"=>$catTag,"arr"=>$test,"tags"=>$tags);

        return view('AssetCategory.Create',$data);
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
        $tag = $request -> catTag;
        $catName = $request -> categoryName;
        $catDesc = $request -> catDesc;

        $assetCategory = new AssetCategory;
        $assetCategory -> catName = $catName;
        $assetCategory -> catDescription = $catDesc;
        $assetCategory -> categoryTag = $tag;

        $updateCatStatus = CatPostFix::find($tag);
        $updateCatStatus-> isUsed = 1;
        $updateCatStatus->save();
        $assetCategory->save();
        return redirect('/assetcategory');
        //return view('AssetCategory.view');
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
     *https://admissiontable.com/52-computer-science-masters-degree-in-germany-in-english/
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = AssetCategory::find($id);
        $data = array("category"=>$category);

        return view('AssetCategory.modify',$data);
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
        $assetCategoryToUpdate = AssetCategory::find($id);
        $assetCategoryToUpdate -> catName = $request-> categoryName;
         $assetCategoryToUpdate -> catDescription = $request-> categoryDescription;
        $assetCategoryToUpdate->save();

        return redirect('/assetcategory');
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
        $assetCat = AssetCategory::find($id);
        $assetCat->delete();

        return redirect('/assetcategory');
    }
}
