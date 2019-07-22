<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class productController extends Controller
{
    //
    public function index(){
        $products = Product::all();
        $data = array("products"=>$products);
        return view('Products.view',$data);
    }
}
