<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Picqer;

class BarcodeController extends Controller
{
    //
    public function makeBarcode(Request $request){
        $code = "A0044BBCC";
        $barcode =  new Picqer\Barcode\BarcodeGeneratorPNG();
        $img1 = $barcode->getBarcode($code, $barcode::TYPE_CODE_128);
        $img2 = $barcode->getBarcode("A0002AAAA",$barcode::TYPE_CODE_128);
         $img3 = $barcode->getBarcode("A0001BBBC", $barcode::TYPE_CODE_128);
        $img4 = $barcode->getBarcode("A0005AAAA",$barcode::TYPE_CODE_128);
         $img5 = $barcode->getBarcode("A0005BBBB", $barcode::TYPE_CODE_128);
        $img6 = $barcode->getBarcode("A0007AAAA",$barcode::TYPE_CODE_128);
        //. base64_encode($generator->getBarcode('081231723897', $generator::TYPE_CODE_128)) . '">';
         $data = array("OnlyImage"=>array($img1,$img2,$img3,$img4,$img5,$img6));
        
        return view("Assets.barcode",$data);
    }
}
