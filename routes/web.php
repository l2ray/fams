<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('barcode','productController@index');
Route::get('/', "LoginController@index");
Route::resource('/login','LoginController');
Route::resource('/assetcategory', 'AssetCategoryController');
Route::resource('/assetlocation','AssetLocationController');
Route::resource('/instdepartment','InstutionDepartmentController');
Route::resource('/departmentunit','DepartmentUnitController');
Route::resource('/user','UserController');
Route::resource('/trackmovement',"TrackAssetMovementController");
Route::resource("/asset",'AssetController');

Route::get("bbb","BarcodeController@makeBarcode");
Route::get("fetchData/{input}","fetchData@getData");

Route::get("getUnitDep/{id}","fetchData@getDepUnit");
Route::get("getSourceUnit/{id}","fetchData@getSourceUnit");
Route::get("getdestUnit/{id}","fetchData@getDestUnit");
Route::get("getAssetInDep/{id}","fetchData@assetindep");
Route::get("getDepartments/{id}","fetchData@noDupDepartment");
Route::GET("depreciatedAssets","fetchData@getDepreciatedAssets");
Route::get("valuableAssets","fetchData@getValuableAssets");
Route::get("getAssetList","fetchData@getAssetList");
Route::get("getCategoryList","fetchData@getCategoryList");
Route::get("xyz","fetchData@aTwoMonthsLeft");
Route::get("yyy",function(){
    return view("xyz");
});

// healthprioritiesorg__!!1

// 10.0.0.0 - 10.255.255.255
// 172.16.0.0 - 172.31.255.255
// 192.168.0.0 - 192.168.255.255

/*
$.get("/getDrugList",function(dat){
    var pQty = [];
    for(var x = 0; x<dat.length; x++){
        var actQ = parseInt(dat[x].pQuantity);

        var obj = {name:dat[x].pName,data:[actQ]};
         
        pQty.push(obj);
     }

                */