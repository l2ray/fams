<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssetLocation;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\App;
use Milon\Barcode\DNS1D;


class AssetLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
// $bar2 = App::make('BarCode');
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
//                   $bar3 = App::make('BarCode');
// $barcontent3 = $bar3->barcodeFactory("BarCode")
//                   ->renderBarcode(
//                           $filepath ='', 
//                           $text="A0004AAABC", 
//                           $size='50', 
//                           $orientation="horizontal", 
//                           $code_type="code128",// code_type : code128,code39,code128b,code128a,code25,codabar 
//                           $print=true, 
//                           $sizefactor=1
//                   );
//  I'm so much dissapointed 
/*

A Loan Calculator:
A Company has a loan policy with their interest rates respectively. 

1000 to 10000 has an interest rate of 15%

Loans of 10001 to 50000 has an interest rate of 20%

loans of 50001 to 150000 has an interest rate of 25%;

Implement a program that helps the company compute the the interest amount of a loan and displays 
the total amounts payable and  months the loan should span.

Your Program should contain a constructor with an argument for the loan amount applied,
the name of the applicant, Contact number of the Applicant.

It should provide a method called computeInterestAmount that calculates the interest amount to paid

and a method computerLifeSpan to calculate and return the number of years or months it'll take to
complete the loan payment.

Note: Any Amount below 1000 or above 150000 for loan must be rejected by the system.


*/


               //$images = array('<img alt="testing" src="'.$barcontent2.'"/>','<img alt="testing" src="'.$barcontent3.'"/>');
              //$data = array("barcode"=>$images);
             //return view('AssetLocation.view');
            // return view('AssetCategory.testTest',$data);
           //$generator = new Picqer\Barcode\BarcodeGeneratorHTML();
          //return $generator->getBarcode('081231723897', $generator::TYPE_CODE_128);
         $location = AssetLocation::paginate(2);

        $locationDetail = array();
        
        for($count = 0; $count < count($location); $count++){
            $key = $location[$count]->id.":".$location[$count]->locationName;
            $locationDetail[$key] = $location[$count]->locationAddress;
        }

        $data = array("ll"=>$locationDetail,"location"=>$location);
        return view('AssetLocation.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('AssetLocation.Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $AssetLocation = new AssetLocation();
        $AssetLocation -> locationAddress = $request  -> locationAddress;
        $AssetLocation -> locationName    = $request  -> locationName;

        $AssetLocation->save();
         $location = AssetLocation::all();

        $locationDetail = array();
        
        for($count = 0; $count < count($location); $count++){
            $key = $location[$count]->id.":".$location[$count]->locationName;
            $locationDetail[$key] = $location[$count]->locationAddress;
        }
        $data = array("ll"=>$locationDetail);
        return redirect('/assetlocation');
        //
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
        $location = AssetLocation::find($id);
        $data = array("location"=>$location);
        return view('AssetLocation.modify',$data);
        // return view('AssetCategory.modify');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function modify(Request $request,$id){

    }
    public function update(Request $request, $id)
    {
        // //
        // $rules = array(
        //     'locationName' => 'required',
        //     'locationAddress' => 'required'
        // );

        // $validator = Validator::make(Input::all(),$rules);
        $locationToUpdate = AssetLocation::find($id);
        $locationToUpdate -> locationAddress = $request  -> locationAddress;
        $locationToUpdate -> locationName    = $request  -> locationName;
        $locationToUpdate -> save();

        return redirect("/assetlocation");
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
         $locationToDelete = AssetLocation::find($id);
          $locationToDelete -> delete();
         return redirect("/assetlocation");
    } 
}
