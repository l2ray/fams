<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BarCodeGenStatus;
use App\CatPostFix;
use App\Login;
use Illuminate\Support\Facades\Crypt;
use App\TrackMonth;
use App\Asset;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        

        $allAssets = BarCodeGenStatus::all();
        $countIt = count($allAssets);
        if($countIt == 0){
            $barCodeGenUsed = new BarCodeGenStatus();
            $barCodeGenUsed->status = 1;
            $barCodeGenUsed->save();
 	$perms = array("AAAAB","AAABB","AABBB","ABBBB","ABBBC","ABBCC","ABCCC","ABBCC","ACCCC","ACCCD","ACCDD","ACDDD","ADDDD");
        $unique = array();
        $finalPermutation = array();
       for($pams = 0; $pams < count($perms); $pams++){
            $start = $perms[$pams];
            $total = 0;
            for($x = 0; $x < strlen($start);$x++){
                if (array_key_exists($start[$x], $unique)) {
                    $unique[$start[$x]] = $unique[$start[$x]] + 1;
                    $total += 1;
               }
                else{
                    $unique[$start[$x]] = 1;
                    $total += 1;
                }
            }
            $numerator = 1;
            for($x = $total; $x >= 1; $x-- ){
               $numerator *= $x;
            }
        
            $denominator = 1;
            foreach($unique as $key => $val){
                for($x = $val; $x >= 1; $x--){
                    $denominator *= $x;
                }
            }
            $totalPermutation = $numerator / $denominator;
            $individ = explode(" ",$start);
            $pointer = strlen($start) - 1;
   //         
           if(!in_array($start,$finalPermutation)){
                    array_push($finalPermutation, $start);
               }
           for($x = 0; $x < $totalPermutation; $x++){
                $tmp = $start[$pointer];
               
                $tmp2 = $start[$pointer - 1];
                $start[$pointer] = $tmp2;
                $start[$pointer - 1] = $tmp;
                if(!in_array($start,$finalPermutation)){
                   array_push($finalPermutation, $start);
                }
               // echo "$start<br />";
          
       ///     
                if($x == strlen($start)-1){
                    //System.out.print(count);
                    break;
                }else{
                   // System.out.print(count);
                $pointer = $pointer-1;
                }

            
            }
     }
        $countIt = 1;
        foreach($finalPermutation as $sd){
           //$qExec = "INSERT INTO catPostfix(postFixTag,isUsed) values('$sd',0)";
            //sc_exec_sql($qExec);
            $catPostFix = new CatPostFix();
            $catPostFix -> postFixTab = $sd;
            $catPostFix -> isUsed = 0;
            $catPostFix->save();
	//echo "<h1>$sd</h1>";
            
        }
        }
        $users = Login::all();
        
        
        //$data = array("a"=>$users,"decy"=>Crypt::decrypt($users[1]->password));
        return view('Login.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return "Heyy";
    }

    /**
     * 
     *   
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $userName = $request -> userName;
        $password = $request -> pwd;

        $flag = false;
        $users = Login::all();
       // [{"id":1,"login":"lot","password":"4472897njieS_","name":"Lamin O. Touray","email":"ltouray@lastingsolutions.gm","active":"1","created_at":"2019-06-27 12:14:11","updated_at":"2019-06-27 12:14:11","phone":3830021},{"id":2,"login":"njies","password":"eyJpdiI6IlJXZ0c0ZzBqdGViZUphZ0orbWVRa0E9PSIsInZhbHVlIjoiUnFjc0pMd0Q2OTVER094bGhzWFwvSUE9PSIsIm1hYyI6ImJkNjNmMTM4YTUyYzllNmQyYzkzYzcxOTM5YmViMTg1M2JhYjAxNjkxODNiMDA2MDllY2ZkNTM0YjM3NGNiMTMifQ==","name":"njie","email":"njie@njie.com","active":"1","created_at":"2019-06-27 12:17:54","updated_at":"2019-06-27 12:17:54","phone":323}]
        for($x = 0; $x< count($users); $x++){
            $encPassword = $users[$x]->password;
            $encLogin = $users[$x] -> login;
            $userStatus = $users[$x]-> active;
            $userName = $users[$x]->login;

            
            $decPassword = Crypt::decrypt($encPassword);
            if($password == $decPassword && $encLogin == $userName){
                if($userStatus == 0){
                    return redirect()->back()->withErrors(["Please Contact the administrator. 
                    You are currently Suspended from using the System.Thank You."])->withInput();
                }
                
                $request->session()->put("uName",$encLogin);

                //////////////  Run Depreciation

                //////////  UPDATE DEPRECIATION  /////////////////////////////
    //$isTblEmpty="SELECT count(id) FROM trackMonths order by id DESC LIMIT 1";
    $totalRecord = count(TrackMonth::all());
    //return "$totalRecord";
	//sc_lookup(ite,$isTblEmpty);
	$curDate = date("Y-m-d");
	if($totalRecord != 0){
    //$lastQuery = "SELECT monthDepreciation FROM trackMonths order by id DESC LIMIT 1";
    $totalCounts = TrackMonth::all();
    $prevDate = $totalCounts[count($totalCounts)-1]->monthDepreciation;
   // return "$prevDate";
// sc_lookup(l,$lastQuery);

// $prevDate = {l[0][0]};
// sc_error_message($prevDate." is the previous Date from db");

	
$dateMassage = explode("-",$prevDate);
$prevYear = $dateMassage[0];
$prevMonth = $dateMassage[1];
$prevDay = $dateMassage[2];

$curDateMassage = explode("-",$curDate) ;
$curYear = $curDateMassage[0] ;
$curMonth = $curDateMassage[1] ;    
$curDay = $curDateMassage[2] ;
$totalDepMonth = 0 ;
	
	if(($curYear - $prevYear) == 0){
		
		$totalDepMonth = $curMonth - $prevMonth -1;
		//sc_error_message($totalDepMonth);
	}
	else if((($curYear - $prevYear) >0) && ($curMonth == $prevMonth)){
		$totalDepMonth = (($curYear - $prevYear) *12) -1;
	}
	else{
		$mToSub = $prevMonth - $curMonth;
		$totalMonth = (($curYear - $prevYear) * 12) - 1;
		$totalDepMonth = $totalMonth - $mToSub;
	}
			//$checkIfMDepreciated = ;
			for($y = 1; $y <=$totalDepMonth; $y++){

            ///////        lot Function Begin();

          // sc_lookup(c,"select count(*) from Assets WHERE AssetStatus = 0  and TotalMonthsLeft>0");
            $assetToDepreciate = Asset::where("AssetStatus","=",0)->where("TotalMonthsLeft",">",0)->get();
            //return $assetToDepreciate;
  $assets = "SELECT id,AssetBookValue,TotalDepreciatedAmount,AssetMonthlyDepreciation,TotalMonthsDepreciated,TotalMonthsLeft,
  AssetStartDate from Assets WHERE AssetStatus = 0  and TotalMonthsLeft>0";
                 // sc_lookup(a,$assets);
        $assets = Asset::where("AssetStatus","=",0)->where("TotalMonthsLeft",">",0)->get();

  for($tmp = 0; $tmp < count($assetToDepreciate); $tmp++){
	  	$curId =$assets[$tmp]->id;// {a[$tmp][0]};  // Getting the Id of the Current Asset
		$currBookVal = $assets[$tmp]->AssetBookValue; // Getting the current book value of the asset
		$currTotalDepAmount = $assets[$tmp]->TotalDepreciatedAmount; // Getting the total amount depreciated from this asset
		$mnthDep = $assets[$tmp]-> AssetMonthlyDepreciation; // Getting the total Depreciated Months for the current Asset
		$totalMonthsDepreciated = $assets[$tmp]->TotalMonthsDepreciated; 
		$monthsLeft = $assets[$tmp]->TotalMonthsLeft;
        $sDate = $assets[$tmp]->AssetStartDate;
        
		$newMonthsLeft = $monthsLeft-1;
		$newMOnthsDepreciated = $totalMonthsDepreciated + 1;
                 
        if($monthsLeft > 0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
                          $newBookVal = $currBookVal - $mnthDep;
                          $newTotalDep = $currTotalDepAmount + $mnthDep;
                          $updateAssetVal = "update Assets set AssetBookValue= $newBookVal,TotalDepreciatedAmount=$newTotalDep,
                          TotalMonthsDepreciated =$newMOnthsDepreciated ,TotalMonthsLeft=$newMonthsLeft where id = $curId";
                          $assetToUpdate = Asset::find($curId);
                          $assetToUpdate -> AssetBookValue = $newBookVal;
                          $assetToUpdate -> TotalDepreciatedAmount = $newTotalDep;
                          $assetToUpdate -> TotalMonthsDepreciated = $newMOnthsDepreciated;
                          $assetToUpdate -> TotalMonthsLeft = $newMonthsLeft;
                          $assetToUpdate->save();
                        //   $assetToUpdate -> 
                        //  sc_exec_sql($updateAssetVal);
                          if($newMonthsLeft == 0){
                               $assetToUpdate = Asset::find($curId);
                               $assetToUpdate -> $AssetStatus = 1;
                               $assetToUpdate -> save();

                                  //$updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
                                 //sc_exec_sql($updateAssetStatus);
                          }
                  }
	/*
	  
                  else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
					  
                          $newBookVal = 0;
                          $newTotalDep =$currTotalDepAmount + $currBookVal;
					  	  $newMonthsLeft = 0;
	  					  $newMOnthsDepreciated = $totalMonthsDepreciated + 1;
					   
                          $updateAssetVal = "update Assets set AssetBookValue= $newBookVal,TotalDepreciatedAmount=$newTotalDep,TotalMonthsDepreciated =$newMOnthsDepreciated ,TotalMonthsLeft=$newMonthsLeft,AssetStatus = 1 where id = $curId";
                          //sc_exec_sql($updateAssetVal);
                            
                          //$updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
                          //sc_exec_sql($updateAssetStatus);        
                  }
			*/	   
         
                  
  
 }

            
            /////           LOT FUNCTION ENDS()
		}
	//$this->sync_prev_month();
		}
	//
	////////////////////////  END DEPRECIATION  ///////////////////////////////////////

/**
 * Adding one month(30days) to the due date
 */
/*
 * This macro calculates and returns increments and decrements using dates.
 */
$today ="2019-02-28";// $curDate;//"2019-01-31";//date("Y-m-d"); // "2020-02-29"


$dateArr = explode("-",$today);
$month = $dateArr[1];
$day = $dateArr[2];
	$mRange1 = array(9,4,6,11); // Months that end with 30 days;
	$mRange2 = array(1,3,5,7,8,10,12); // Months that end with 31 days;

	if (in_array($month, $mRange1)) {
					//$checkIfMDepreciated = "SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'";
		
    //sc_lookup(check,"SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
    $check =TrackMonth::where("monthDepreciation","=",$today)->count();

/////////////////////////sdfsdfs sdfwerr sdsfsddfs

					if($day == 30){
// Codes to be returned.
					//$checkIfMDepreciated = "SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'";
		
    // sc_lookup(check,"SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
    // $check =TrackMonth::where("monthDepreciation","=",$today)->count();

                            //sc_lookup(check,"SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
                            
        $check = TrackMonth::where("monthDepreciation","=",$today)->count();
       //return $check;
        if($check == 0){
            $newTrackMonth = new TrackMonth();
            $newTrackMonth -> monthDepreciation = $today;
            // $newTrackMonth->save();
            // $recCurrentMonth = "INSERT INTO `trackMonths`(`monthDepreciation`) VALUES ('$today')";
            // sc_exec_sql($recCurrentMonth);
            $totalAssetNumberToDepreciate = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">=", 0)->count();
            $totalAssetToDepreciate = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">=", 0)->get();

                //return "About Depreciate $totalAssetToDepreciate";
            for($x = 0; $x < $totalAssetNumberToDepreciate; $x++){
                $currBookVal = $totalAssetToDepreciate[$x]-> assetBookValue;
                
                $currTotalDepAmount = $totalAssetToDepreciate[$x]->totalDepreciatedAmount;
                
                $mnthDep = $totalAssetToDepreciate[$x]->assetMonthlyDepreciation;

                $newBookVal = $currBookVal - $mnthDep;
                $newTotalDep = $currTotalDepAmount + $mnthDep;
                $curId = $totalAssetToDepreciate[$x]->id;
                $currTotalMonthsDepreciated = $totalAssetToDepreciate[$x]->totalMonthsDepreciated;
                $curTotalMonthsLeft = $totalAssetToDepreciate[$x]->totalMonthsLeft;
                $newTotalMonthsDepreciated = $currTotalMonthsDepreciated + 1;
                $newTotalMonthsLeft = $curTotalMonthsLeft -1;
                $startDate = $totalAssetToDepreciate[$x]->assetStartDate;
                $dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
                $currDateSub = substr($today,0,7);
                
                ///  TO BE CONTD
                if($currDateSub >= $dY){

                if($curTotalMonthsLeft>0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
                $newBookVal = $currBookVal - $mnthDep;
                $newTotalDep = $currTotalDepAmount + $mnthDep;
                
                $updateAssetVal = Asset::find($curId);// = "update Assets set 
                //return $updateAssetVal;
                $updateAssetVal -> assetBookValue= $newBookVal;
                $updateAssetVal -> totalDepreciatedAmount = $newTotalDep;
                $updateAssetVal -> totalMonthsLeft = $newTotalMonthsLeft;
                $updateAssetVal -> totalMonthsDepreciated = $newTotalMonthsDepreciated; 
                $updateAssetVal -> save();
                //sc_exec_sql($updateAssetVal);
                if( $newTotalMonthsLeft ==0){
                $updateAssetStatus =Asset::find($curId);
                $updateAssetStatus-> assetStatus = 1;
                $updateAssetStatus -> save();                                          
                //sc_exec_sql($updateAssetStatus);
                }
                    }

        else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
            $newBookVal = 0;
                $newTotalDep =$currTotalDepAmount + $currBookVal;
            
                $updateAssetVal = Asset::find($curId);
                
                $updateAssetVal -> assetBookValue= $newBookVal;
                $updateAssetVal -> totalDepreciatedAmount=$newTotalDep;
                //$updateAssetVal -> TotalMonthsLeft=$newTotalMonthsLeft;
                //$updateAssetVal -> TotalMonthsDepreciated=$newTotalMonthsDepreciated;
                $updateAssetVal -> assetStatus = 1;
                $updateAssetVal -> save(); 
                //sc_exec_sql($updateAssetVal);
                
                //$updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
                //sc_exec_sql($updateAssetStatus);        
                
        }
            }
            }
        }
					}


//////////////////////////sdfsdf sdfsdf sfwserw 


		// if($check == 0){
		// 	if($day == 30){
		// 		//sc_lookup(check,"SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
		// 			//if({check[0][0]} == 0){
        //                 $recCurrentMonth = new TrackMonth();
        //                 $recCurrentMonth -> monthDepreciation = $today;
        //                 $recCurrentMonth->save(); 
        //                 //"INSERT INTO `trackMonths`(`monthDepreciation`) VALUES ('$today')";
                        
		// 				//sc_exec_sql($recCurrentMonth);
        //                 $countIt = TrackMonth::where("AssetStatus","=",0)->where("TotalMonthsLeft",">=",0)->count();
        //                 //"SELECT count(*) from Assets where AssetStatus = 0 and TotalMonthsLeft>0";//"SELECT count(*) from Assets  where AssetStatus = 0";
		// 				//sc_lookup(c,$countIt);
		// 				$assets = "SELECT id,AssetBookValue,TotalDepreciatedAmount,AssetMonthlyDepreciation,TotalMonthsDepreciated,
        //                 TotalMonthsLeft,AssetStartDate from Assets where AssetStatus = 0 and TotalMonthsLeft>0";
        //                 $assetsToDepreciate = Asset::where("AssetStatus", "=", 0 )->where("TotalMonthsLeft",">=",0)->get();
        //                // return $countIt;
		// 				//sc_lookup(a,$assets);
		// 				//for($x = 0; $x < $countIt[0][0]; $x++){
        //                 for($x = 0; $x < $countIt; $x++){
        //                     $updateAsset = Asset::find($assetsToDepreciate[$x]->id);
		// 					$curId = $updateAsset[$x]->id;
		// 					$currBookVal = $updateAsset[$x]->AssetBookValue;
		// 					$currTotalDepAmount = $updateAsset[$x]->TotalDepreciatedAmount;
		// 					$mnthDep = $updateAsset[$x]-> AssetMonthlyDepreciation;
		// 					$newBookVal = $currBookVal - $mnthDep;
		// 					$newTotalDep = $currTotalDepAmount + $mnthDep;
		// 					$currTotalMonthsDepreciated = $updateAsset[$x]->TotalMonthsDepreciated;
		// 					$curTotalMonthsLeft = $updateAsset[$x] -> TotalMonthsLeft;
		// 					$newTotalMonthsDepreciated = $currTotalMonthsDepreciated + 1;
		// 					$newTotalMonthsLeft = $curTotalMonthsLeft -1;
		// 					$startDate = $updateAsset[$x] -> AssetStartDate;
		// 					$dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
		// 					$currDateSub = substr($today,0,7);
		// 					if($currDateSub >= $dY){
								
		// 				  if($curTotalMonthsLeft>0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
        //                   $newBookVal = $currBookVal - $mnthDep;
        //                   $newTotalDep = $currTotalDepAmount + $mnthDep;
        //                   $updateAssetVal = "update Assets set ";
        //                   $updateAsset -> AssetBookValue= $newBookVal;
        //                   $updateAsset -> TotalDepreciatedAmount=$newTotalDep;
        //                   $updateAsset -> TotalMonthsLeft=$newTotalMonthsLeft;
        //                   $updateAsset -> TotalMonthsDepreciated=$newTotalMonthsDepreciated;// where id = $curId";
        //                   $updateAsset -> save();
        //                  // sc_exec_sql($updateAssetVal);
        //                   if($newTotalMonthsLeft ==0){
        //                       $updateAsset -> AssetStatus = 1;
        //                       $updateAsset -> save();

        //                       //    $updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
        //                       //    sc_exec_sql($updateAssetStatus);
        //                   }
        //           }
	
	  
        //           else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
					  
        //                   $newBookVal = 0;
        //                   $newTotalDep =$currTotalDepAmount + $currBookVal;
					   
        //                   //$updateAssetVal = "update Assets set 

        //                   $updateAsset -> AssetBookValue = $newBookVal;
        //                   $updateAsset -> TotalDepreciatedAmount = $newTotalDep;
        //                   //$updateAsset -> TotalMonthsLeft = $newTotalMonthsLeft;
        //                   //$updateAsset -> TotalMonthsDepreciated = $newTotalMonthsDepreciated;
        //                   $updateAsset -> AssetStatus = 1; // where id = $curId";
        //                   $updateAsset -> save();
        //                   //sc_exec_sql($updateAssetVal);
                            
        //                   //$updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
        //                  // sc_exec_sql($updateAssetStatus);        
        //           }
		// 				//}
								
		// 					}
		// 			}
		// 	}
		// }

    }
    
	else if (in_array($month, $mRange2)) {
			
		//sync_prev_month();  ------------- to be called later
		/////// Code Watch!!!
					if($day == 31){ // Begin Check if day  is 31
// Codes to be returned.
					//$checkIfMDepreciated = "SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'";
		
    // sc_lookup(check,"SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
    // $check =TrackMonth::where("monthDepreciation","=",$today)->count();

                            //sc_lookup(check,"SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
                            
        $check = TrackMonth::where("monthDepreciation","=",$today)->count();
       
        if($check == 0){
            $newTrackMonth = new TrackMonth();
            $newTrackMonth -> monthDepreciation = $today;
            // $newTrackMonth->save();
            // $recCurrentMonth = "INSERT INTO `trackMonths`(`monthDepreciation`) VALUES ('$today')";
            // sc_exec_sql($recCurrentMonth);
            $totalAssetNumberToDepreciate = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">=", 0)->count();
            $totalAssetToDepreciate = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">=", 0)->get();

                //return "About Depreciate $totalAssetToDepreciate";
            for($x = 0; $x < $totalAssetNumberToDepreciate; $x++){
                $currBookVal = $totalAssetToDepreciate[$x]-> assetBookValue;
                
                $currTotalDepAmount = $totalAssetToDepreciate[$x]->totalDepreciatedAmount;
                
                $mnthDep = $totalAssetToDepreciate[$x]->assetMonthlyDepreciation;

                $newBookVal = $currBookVal - $mnthDep;
                $newTotalDep = $currTotalDepAmount + $mnthDep;
                $curId = $totalAssetToDepreciate[$x]->id;
                $currTotalMonthsDepreciated = $totalAssetToDepreciate[$x]->totalMonthsDepreciated;
                $curTotalMonthsLeft = $totalAssetToDepreciate[$x]->totalMonthsLeft;
                $newTotalMonthsDepreciated = $currTotalMonthsDepreciated + 1;
                $newTotalMonthsLeft = $curTotalMonthsLeft -1;
                $startDate = $totalAssetToDepreciate[$x]->assetStartDate;
                $dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
                $currDateSub = substr($today,0,7);
                
                ///  TO BE CONTD
                if($currDateSub >= $dY){

                if($curTotalMonthsLeft>0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
                $newBookVal = $currBookVal - $mnthDep;
                $newTotalDep = $currTotalDepAmount + $mnthDep;
                
                $updateAssetVal = Asset::find($curId);// = "update Assets set 
                //return $updateAssetVal;
                $updateAssetVal -> assetBookValue= $newBookVal;
                $updateAssetVal -> totalDepreciatedAmount = $newTotalDep;
                $updateAssetVal -> totalMonthsLeft = $newTotalMonthsLeft;
                $updateAssetVal -> totalMonthsDepreciated = $newTotalMonthsDepreciated; 
                $updateAssetVal -> save();
                //sc_exec_sql($updateAssetVal);
                if( $newTotalMonthsLeft ==0){
                $updateAssetStatus =Asset::find($curId);
                $updateAssetStatus-> assetStatus = 1;
                $updateAssetStatus -> save();                                          
                //sc_exec_sql($updateAssetStatus);
                }
                    }

        else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
            $newBookVal = 0;
                $newTotalDep =$currTotalDepAmount + $currBookVal;
            
                $updateAssetVal = Asset::find($curId);
                
                $updateAssetVal -> assetBookValue= $newBookVal;
                $updateAssetVal -> totalDepreciatedAmount=$newTotalDep;
                //$updateAssetVal -> TotalMonthsLeft=$newTotalMonthsLeft;
                //$updateAssetVal -> TotalMonthsDepreciated=$newTotalMonthsDepreciated;
                $updateAssetVal -> assetStatus = 1;
                $updateAssetVal -> save(); 
                //sc_exec_sql($updateAssetVal);
                
                //$updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
                //sc_exec_sql($updateAssetStatus);        
                
        }
            }
            }
        }
					} // End Check if day  is 31
		
		
		/////////////////////////////////////  Codes Check!!!
	}

	else{
        // Begin Leap year Check
        
        $year = $dateArr[0];
                    	if($year % 4 == 0){
		if($year % 100 == 0){
			if($year %400 == 0){
                // It is a leap year
				if($day == 29){
                $check = TrackMonth::where("monthDepreciation","=",$today)->count();
        if($check == 0){
            $newTrackMonth = new TrackMonth();
            $newTrackMonth -> monthDepreciation = $today;
            // $newTrackMonth->save();
            // $recCurrentMonth = "INSERT INTO `trackMonths`(`monthDepreciation`) VALUES ('$today')";
            // sc_exec_sql($recCurrentMonth);
            $totalAssetNumberToDepreciate = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">=", 0)->count();
            $totalAssetToDepreciate = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">=", 0)->get();

                //return "About Depreciate $totalAssetToDepreciate";
            for($x = 0; $x < $totalAssetNumberToDepreciate; $x++){
                $currBookVal = $totalAssetToDepreciate[$x]-> assetBookValue;
                
                $currTotalDepAmount = $totalAssetToDepreciate[$x]->totalDepreciatedAmount;
                
                $mnthDep = $totalAssetToDepreciate[$x]->assetMonthlyDepreciation;

                $newBookVal = $currBookVal - $mnthDep;
                $newTotalDep = $currTotalDepAmount + $mnthDep;
                $curId = $totalAssetToDepreciate[$x]->id;
                $currTotalMonthsDepreciated = $totalAssetToDepreciate[$x]->totalMonthsDepreciated;
                $curTotalMonthsLeft = $totalAssetToDepreciate[$x]->totalMonthsLeft;
                $newTotalMonthsDepreciated = $currTotalMonthsDepreciated + 1;
                $newTotalMonthsLeft = $curTotalMonthsLeft -1;
                $startDate = $totalAssetToDepreciate[$x]->assetStartDate;
                $dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
                $currDateSub = substr($today,0,7);
                
                ///  TO BE CONTD
                if($currDateSub >= $dY){

                if($curTotalMonthsLeft>0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
                $newBookVal = $currBookVal - $mnthDep;
                $newTotalDep = $currTotalDepAmount + $mnthDep;
                
                $updateAssetVal = Asset::find($curId);// = "update Assets set 
                //return $updateAssetVal;
                $updateAssetVal -> assetBookValue= $newBookVal;
                $updateAssetVal -> totalDepreciatedAmount = $newTotalDep;
                $updateAssetVal -> totalMonthsLeft = $newTotalMonthsLeft;
                $updateAssetVal -> totalMonthsDepreciated = $newTotalMonthsDepreciated; 
                $updateAssetVal -> save();
                //sc_exec_sql($updateAssetVal);
                if( $newTotalMonthsLeft ==0){
                $updateAssetStatus =Asset::find($curId);
                $updateAssetStatus-> assetStatus = 1;
                $updateAssetStatus -> save();                                          
                //sc_exec_sql($updateAssetStatus);
                }
                    }

        else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
            $newBookVal = 0;
                $newTotalDep =$currTotalDepAmount + $currBookVal;
            
                $updateAssetVal = Asset::find($curId);
                
                $updateAssetVal -> assetBookValue= $newBookVal;
                $updateAssetVal -> totalDepreciatedAmount=$newTotalDep;
                //$updateAssetVal -> TotalMonthsLeft=$newTotalMonthsLeft;
                //$updateAssetVal -> TotalMonthsDepreciated=$newTotalMonthsDepreciated;
                $updateAssetVal -> assetStatus = 1;
                $updateAssetVal -> save(); 
                //sc_exec_sql($updateAssetVal);
                
                //$updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
                //sc_exec_sql($updateAssetStatus);        
                
        }
            }
            }
        }
                }
			}
			else{
                
                // It is not a leap year
                // $massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
                if($day == 28){
                   
                           $check = TrackMonth::where("monthDepreciation","=",$today)->count();
       
        if($check == 0){
            $newTrackMonth = new TrackMonth();
            $newTrackMonth -> monthDepreciation = $today;
            // $newTrackMonth->save();
            // $recCurrentMonth = "INSERT INTO `trackMonths`(`monthDepreciation`) VALUES ('$today')";
            // sc_exec_sql($recCurrentMonth);
            $totalAssetNumberToDepreciate = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">=", 0)->count();
            $totalAssetToDepreciate = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">=", 0)->get();

                //return "About Depreciate $totalAssetToDepreciate";
            for($x = 0; $x < $totalAssetNumberToDepreciate; $x++){
                $currBookVal = $totalAssetToDepreciate[$x]-> assetBookValue;
                
                $currTotalDepAmount = $totalAssetToDepreciate[$x]->totalDepreciatedAmount;
                
                $mnthDep = $totalAssetToDepreciate[$x]->assetMonthlyDepreciation;

                $newBookVal = $currBookVal - $mnthDep;
                $newTotalDep = $currTotalDepAmount + $mnthDep;
                $curId = $totalAssetToDepreciate[$x]->id;
                $currTotalMonthsDepreciated = $totalAssetToDepreciate[$x]->totalMonthsDepreciated;
                $curTotalMonthsLeft = $totalAssetToDepreciate[$x]->totalMonthsLeft;
                $newTotalMonthsDepreciated = $currTotalMonthsDepreciated + 1;
                $newTotalMonthsLeft = $curTotalMonthsLeft -1;
                $startDate = $totalAssetToDepreciate[$x]->assetStartDate;
                $dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
                $currDateSub = substr($today,0,7);
                
                ///  TO BE CONTD
                if($currDateSub >= $dY){

                if($curTotalMonthsLeft>0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
                $newBookVal = $currBookVal - $mnthDep;
                $newTotalDep = $currTotalDepAmount + $mnthDep;
                
                $updateAssetVal = Asset::find($curId);// = "update Assets set 
                //return $updateAssetVal;
                $updateAssetVal -> assetBookValue= $newBookVal;
                $updateAssetVal -> totalDepreciatedAmount = $newTotalDep;
                $updateAssetVal -> totalMonthsLeft = $newTotalMonthsLeft;
                $updateAssetVal -> totalMonthsDepreciated = $newTotalMonthsDepreciated; 
                $updateAssetVal -> save();
                //sc_exec_sql($updateAssetVal);
                if( $newTotalMonthsLeft ==0){
                $updateAssetStatus =Asset::find($curId);
                $updateAssetStatus-> assetStatus = 1;
                $updateAssetStatus -> save();                                          
                //sc_exec_sql($updateAssetStatus);
                }
                    }

        else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
            $newBookVal = 0;
                $newTotalDep =$currTotalDepAmount + $currBookVal;
            
                $updateAssetVal = Asset::find($curId);
                
                $updateAssetVal -> assetBookValue= $newBookVal;
                $updateAssetVal -> totalDepreciatedAmount=$newTotalDep;
                //$updateAssetVal -> TotalMonthsLeft=$newTotalMonthsLeft;
                //$updateAssetVal -> TotalMonthsDepreciated=$newTotalMonthsDepreciated;
                $updateAssetVal -> assetStatus = 1;
                $updateAssetVal -> save(); 
                //sc_exec_sql($updateAssetVal);
                
                //$updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
                //sc_exec_sql($updateAssetStatus);        
                
        }
            }
            }
        }
                }
			}	
		}
		else{
            // It's is a leap year. 
            // $massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
            if($day == 29){
                            $check = TrackMonth::where("monthDepreciation","=",$today)->count();
       
        if($check == 0){
            $newTrackMonth = new TrackMonth();
            $newTrackMonth -> monthDepreciation = $today;
            // $newTrackMonth->save();
            // $recCurrentMonth = "INSERT INTO `trackMonths`(`monthDepreciation`) VALUES ('$today')";
            // sc_exec_sql($recCurrentMonth);
            $totalAssetNumberToDepreciate = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">=", 0)->count();
            $totalAssetToDepreciate = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">=", 0)->get();

                //return "About Depreciate $totalAssetToDepreciate";
            for($x = 0; $x < $totalAssetNumberToDepreciate; $x++){
                $currBookVal = $totalAssetToDepreciate[$x]-> assetBookValue;
                
                $currTotalDepAmount = $totalAssetToDepreciate[$x]->totalDepreciatedAmount;
                
                $mnthDep = $totalAssetToDepreciate[$x]->assetMonthlyDepreciation;

                $newBookVal = $currBookVal - $mnthDep;
                $newTotalDep = $currTotalDepAmount + $mnthDep;
                $curId = $totalAssetToDepreciate[$x]->id;
                $currTotalMonthsDepreciated = $totalAssetToDepreciate[$x]->totalMonthsDepreciated;
                $curTotalMonthsLeft = $totalAssetToDepreciate[$x]->totalMonthsLeft;
                $newTotalMonthsDepreciated = $currTotalMonthsDepreciated + 1;
                $newTotalMonthsLeft = $curTotalMonthsLeft -1;
                $startDate = $totalAssetToDepreciate[$x]->assetStartDate;
                $dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
                $currDateSub = substr($today,0,7);
                
                ///  TO BE CONTD
                if($currDateSub >= $dY){

                if($curTotalMonthsLeft>0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
                $newBookVal = $currBookVal - $mnthDep;
                $newTotalDep = $currTotalDepAmount + $mnthDep;
                
                $updateAssetVal = Asset::find($curId);// = "update Assets set 
                //return $updateAssetVal;
                $updateAssetVal -> assetBookValue= $newBookVal;
                $updateAssetVal -> totalDepreciatedAmount = $newTotalDep;
                $updateAssetVal -> totalMonthsLeft = $newTotalMonthsLeft;
                $updateAssetVal -> totalMonthsDepreciated = $newTotalMonthsDepreciated; 
                $updateAssetVal -> save();
                //sc_exec_sql($updateAssetVal);
                if( $newTotalMonthsLeft ==0){
                $updateAssetStatus =Asset::find($curId);
                $updateAssetStatus-> assetStatus = 1;
                $updateAssetStatus -> save();                                          
                //sc_exec_sql($updateAssetStatus);
                }
                    }

        else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
            $newBookVal = 0;
                $newTotalDep =$currTotalDepAmount + $currBookVal;
            
                $updateAssetVal = Asset::find($curId);
                
                $updateAssetVal -> assetBookValue= $newBookVal;
                $updateAssetVal -> totalDepreciatedAmount=$newTotalDep;
                //$updateAssetVal -> TotalMonthsLeft=$newTotalMonthsLeft;
                //$updateAssetVal -> TotalMonthsDepreciated=$newTotalMonthsDepreciated;
                $updateAssetVal -> assetStatus = 1;
                $updateAssetVal -> save(); 
                //sc_exec_sql($updateAssetVal);
                
                //$updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
                //sc_exec_sql($updateAssetStatus);        
                
        }
            }
            }
        }
                }
		}	
	}

	else{
        
        // It's not a leap year.
        // $massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
        	if($day == 28){
                
               $check = TrackMonth::where("monthDepreciation","=",$today)->count();
        //return $check;
        if($check == 0){
            $newTrackMonth = new TrackMonth();
            $newTrackMonth -> monthDepreciation = $today;
            // $newTrackMonth->save();
            // $recCurrentMonth = "INSERT INTO `trackMonths`(`monthDepreciation`) VALUES ('$today')";
            // sc_exec_sql($recCurrentMonth);
            $totalAssetNumberToDepreciate = Asset::where("AssetStatus", "=", 0) -> where("totalMonthsLeft", ">=", 0)->count();
            $totalAssetToDepreciate = Asset::where("AssetStatus", "=", 0) -> where("totalMonthsLeft", ">=", 0)->get();
           
            // return $totalAssetToDepreciate;
                //return "About Depreciate $totalAssetToDepreciate";
            for($x = 0; $x < $totalAssetNumberToDepreciate; $x++){
                $currBookVal = $totalAssetToDepreciate[$x]-> assetBookValue;
                $currTotalDepAmount = $totalAssetToDepreciate[$x]->totalDepreciatedAmount;
                $mnthDep = $totalAssetToDepreciate[$x]->assetMonthlyDepreciation;
                $newBookVal = $currBookVal - $mnthDep;
                $newTotalDep = $currTotalDepAmount + $mnthDep;
                $curId = $totalAssetToDepreciate[$x]->id;
                $currTotalMonthsDepreciated = $totalAssetToDepreciate[$x]->totalMonthsDepreciated;
                $curTotalMonthsLeft = $totalAssetToDepreciate[$x]->totalMonthsLeft;
                $newTotalMonthsDepreciated = $currTotalMonthsDepreciated + 1;
                $newTotalMonthsLeft = $curTotalMonthsLeft -1;
                $startDate = $totalAssetToDepreciate[$x]->assetStartDate;
                $dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
                $currDateSub = substr($today,0,7);
                
                ///  TO BE CONTD
                if($currDateSub >= $dY){
                if($curTotalMonthsLeft>0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
                $newBookVal = $currBookVal - $mnthDep;
                $newTotalDep = $currTotalDepAmount + $mnthDep;
                
                $updateAssetVal = Asset::find($curId);
                $updateAssetVal -> assetBookValue= $newBookVal;
                $updateAssetVal -> totalDepreciatedAmount = $newTotalDep;
                $updateAssetVal -> totalMonthsLeft = $newTotalMonthsLeft;
                $updateAssetVal -> totalMonthsDepreciated = $newTotalMonthsDepreciated; 
               // $updateAssetVal -> save();
                //sc_exec_sql($updateAssetVal);
                if( $newTotalMonthsLeft ==0){
                $updateAssetStatus =Asset::find($curId);
                $updateAssetStatus-> assetStatus = 1;
                $updateAssetStatus -> save();                                          
                //sc_exec_sql($updateAssetStatus);
                }
                    }

        else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
            $newBookVal = 0;
                $newTotalDep =$currTotalDepAmount + $currBookVal;
            
                $updateAssetVal = Asset::find($curId);
                
                $updateAssetVal -> assetBookValue= $newBookVal;
                $updateAssetVal -> totalDepreciatedAmount=$newTotalDep;
                //$updateAssetVal -> TotalMonthsLeft=$newTotalMonthsLeft;
                //$updateAssetVal -> TotalMonthsDepreciated=$newTotalMonthsDepreciated;
                $updateAssetVal -> assetStatus = 1;
                $updateAssetVal -> save(); 
                //sc_exec_sql($updateAssetVal);
                
                //$updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
                //sc_exec_sql($updateAssetStatus);        
                
        }
            }
            }
        }
                    //return "Good";
                }
    }
    
    ///////////// To Be Delete Below.... 



                //         	if( ($year%400==0 || $year%100!=0) &&($year%4==0)){
                //             if($day == 29){
                //                 $check = TrackMonth::where("monthDepreciation","=",$today)->count();
                //                 //$check = Asset::where(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
                //                     if($check == 0){

                //                         $newTrackMonth = new TrackMonth();
                //                         $newTrackMonth -> monthDepreciation = $today;
                //                         $newTrackMonth->save();

                //                         $countIt = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">", 0)->count();

                //                         // "SELECT count(*) from Assets where AssetStatus = 0 And  TotalMonthsLeft > 0";

                //                         // sc_lookup(c,$countIt);
                //                         $assets = "SELECT id,AssetBookValue,TotalDepreciatedAmount,AssetMonthlyDepreciation ,TotalMonthsDepreciated,
                //                         TotalMonthsLeft,AssetStartDate from Assets where AssetStatus = 0 AND TotalMonthsLeft > 0";
                //                         //sc_lookup(a,$assets);
                //                         $assets =Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">", 0)->get();
                                        
                //                         for($x = 0; $x < $countIt; $x++){
                //                             $currBookVal = $assets[$x]-> AssetBookValue;
                //                             $currTotalDepAmount = $assets[$x]-> TotalDepreciatedAmount;
                //                             $mnthDep = $assets[$x]-> AssetMonthlyDepreciation;
                //                             $newBookVal = $currBookVal - $mnthDep;
                //                             $newTotalDep = $currTotalDepAmount + $mnthDep;
                //                             $curId = $assets[$x]-> id;;
                //                             $currTotalMonthsDepreciated = $assets[$x]-> TotalMonthsDepreciated;;;
				// 			$curTotalMonthsLeft = $assets[$x]-> TotalMonthsLeft;
				// 			$newTotalMonthsDepreciated = $currTotalMonthsDepreciated + 1;
				// 			$newTotalMonthsLeft = $curTotalMonthsLeft -1;
				// 			$startDate = $assets[$x]-> AssetStartDate;
				// 			$dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
				// 			$currDateSub = substr($today,0,7);
                //             if($currDateSub >= $dY){
				// 					    if($curTotalMonthsLeft>0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
				// 					    $newBookVal = $currBookVal - $mnthDep;
                //                         $newTotalDep = $currTotalDepAmount + $mnthDep;

                //                         $updateAssetVal -> AssetBookValue= $newBookVal;
                //                         $updateAssetVal -> TotalDepreciatedAmount=$newTotalDep;
                //                         $updateAssetVal -> TotalMonthsLeft=$newTotalMonthsLeft;
                //                         $updateAssetVal -> TotalMonthsDepreciated=$newTotalMonthsDepreciated;
                //                         $updateAssetVal -> save();
                //                         sc_exec_sql($updateAssetVal);
                                        
				// 					    if($newTotalMonthsLeft ==0){
                //                                 $updateAssetStatus = Asset::find($curId);
                //                                 $updateAssetStatus -> AssetStatus = 1;// where id = ";
                //                                 $updateAssetStatus -> save();
				// 					            //sc_exec_sql($updateAssetStatus);
				// 					    }
				// 			    }
												
												  
				// 							                  else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
																  
				// 							                          $newBookVal = 0;
				// 							                          $newTotalDep =$currTotalDepAmount + $currBookVal;
																   
				// 							                          $updateAssetVal = "update Assets set AssetBookValue= $newBookVal,TotalDepreciatedAmount=$newTotalDep,TotalMonthsLeft=0,TotalMonthsDepreciated=$newTotalMonthsDepreciated,AssetStatus = 1 where id = $curId";
				// 							                         // sc_exec_sql($updateAssetVal);
											                            
				// 							                          //$updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
				// 							                        //  sc_exec_sql($updateAssetStatus);        
				// 							                  }
				// 														}
				// 													}
				// 												}
				// 										}
                // 			    $massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
                // 			}
                // 			else{
				// 			if($day == 28){
                //                 $check = TrackMonth::where("monthDepreciation","=",$today)->count();
                //    // sc_lookup(check,"SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
                                
				//   				if($check == 0){

                //                     $newTrackMonth = new TrackMonth();
                //                     $newTrackMonth -> monthDepreciation = $today;
                //                     $newTrackMonth -> save();
                                    
                //                     $countIt = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">", 0)->count();

				//   					// $recCurrentMonth = "INSERT INTO `trackMonths`(`monthDepreciation`) VALUES ('$today')";
                //                     // sc_exec_sql($recCurrentMonth);
                                      
				//   					$aToUpdate = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">", 0)->get();
				//   					//sc_lookup(c,$countIt);
				//   					$assets = "SELECT id,AssetBookValue,TotalDepreciatedAmount,AssetMonthlyDepreciation,
                //                     TotalMonthsDepreciated,TotalMonthsLeft,AssetStartDate from Assets where AssetStatus = 0 AND TotalMonthsLeft > 0";
				//   					sc_lookup(a,$assets);
				//   					for($x = 0; $x < $countIt; $x++){
				//   						$currBookVal = $aToUpdate[$x] -> AssetBookValue;//[1]};
				//   						$currTotalDepAmount = $aToUpdate[$x]->TotalDepreciatedAmount;// = [2]};
				//   						$mnthDep = $aToUpdate[$x] -> AssetMonthlyDepreciation;//[3]};
				//   						$newBookVal = $currBookVal - $mnthDep;
				//   						$newTotalDep = $currTotalDepAmount + $mnthDep;
				//   						$curId = $aToUpdate[$x]->id;// = [0]};
				// 						$currTotalMonthsDepreciated = $aToUpdate[$x]-> TotalMonthsDepreciated;// = [4]};;
				// 			$curTotalMonthsLeft = $aToUpdate[$x]-> TotalMonthsLeft;
				// 			$newTotalMonthsDepreciated = $currTotalMonthsDepreciated + 1;
				// 			$newTotalMonthsLeft = $curTotalMonthsLeft -1;
				// 			$startDate = $aToUpdate[$x]->AssetStartDate;
				// 			$dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
				// 			$currDateSub = substr($today,0,7);
				// 											if($currDateSub >= $dY){

				// 												if($curTotalMonthsLeft>0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
				// 					                          $newBookVal = $currBookVal - $mnthDep;
				// 					                          $newTotalDep = $currTotalDepAmount + $mnthDep;
                //                                               $updateAssetVal = Asset::find($curId);
                //                                               $updateAssetVal -> AssetBookValue= $newBookVal;
                //                                               $updateAssetVal -> TotalDepreciatedAmount=$newTotalDep;
                //                                               $updateAssetVal -> TotalMonthsLeft=$newTotalMonthsLeft;
                //                                               $updateAssetVal -> TotalMonthsDepreciated=$newTotalMonthsDepreciated;
                //                                               $updateAssetVal -> save();
				// 					                          // sc_exec_sql($updateAssetVal);
				// 					                          if( $newTotalMonthsLeft ==0){
                //                                                       $updateAssetStatus = Asset::find($curId);
                //                                                       $updateAssetStatus -> AssetStatus = 1;//
                //                                                       $updateAssetStatus -> save();
				// 					                                  //sc_exec_sql($updateAssetStatus);
				// 					                          }
				// 					                  }
										
										  
				// 					                  else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
														  
				// 					                          $newBookVal = 0;
				// 					                          $newTotalDep =$currTotalDepAmount + $currBookVal;
														   
                //                                               $updateAssetVal = Asset::find($curId);
                //                                               $updateAssetVal -> AssetBookValue= $newBookVal;
                //                                               $updateAssetVal -> TotalDepreciatedAmount=$newTotalDep;
                //                                               $updateAssetVal -> TotalMonthsLeft=0;
                //                                               $updateAssetVal -> TotalMonthsDepreciated=$newTotalMonthsDepreciated;
                //                                               $updateAssetVal -> AssetStatus = 1;
                //                                               $updateAssetVal -> save();// where id = $curId";
				// 					                        //  sc_exec_sql($updateAssetVal);
									                            
				// 					                         // $updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
				// 					                         // sc_exec_sql($updateAssetStatus);        
				// 					                  }
				// 											}
				//   										}
				//   									}
				//  	 						}
                //         		$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
                //             }
                //             //////////// End to be <delete class=""></delete>
                            ////////////////////// end Else for leap year check
						}
						

                ////////////////
                return view("Dashboard/Welcome");
            }
        }
                    return redirect()->back()->withErrors(["Sorry There is a problem with your authentication.
Please check to ensure both your user name and password are corrent to successfully login. Thank You."])->withInput();
        // return redirect("/login");

        
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
        return "sdfsd";
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

    public function sync_prev_month(){
    # This is a program that counts the total months between a previous date to the current date.

//$lastQuery = "SELECT monthDepreciation FROM trackMonths order by id DESC LIMIT 1";
$lastQuery = TrackMonth::all();
$prevDate = $lastQuery[count($lastQuery)-1]->monthDepreciation;

// $prevDate = {l[0][0]};
//sc_error_message($prevDate." is the previous Date from db");
$curDate = date("Y-m-d");

//sc_error_message($curDate);

$dateMassage = explode("-",$prevDate);
$prevYear = $dateMassage[0];
$prevMonth = $dateMassage[1];
$prevDay = $dateMassage[2];
$mRange1 = array(9,4,6,11); // Months that end with 30 days;
$mRange2 = array(1,3,5,7,8,10,12); // Months that end with 31 days;
$curDateMassage = explode("-",$curDate);
$curYear = $curDateMassage[0];
$curMonth = $curDateMassage[1];
$curDay = $curDateMassage[2];

if(($curYear - $prevYear) == 0){
	//$split = explode("-",$prevDate);


	//$tmp = $prevDate;
	$tmpOutput = "";
	$tmpDay = 0;
	$tmpMonth = $prevMonth;
	//$tmpYear = 0;

	$totalDepMonth = $curMonth - $prevMonth -1;
	
	//sc_error_message($totalDepMonth);
	
		
	for($y = 1; $y <= $totalDepMonth ; $y++){
		$tmpMonth =$tmpMonth+ 1;
		//$tmpYear = $prevYear;$tmpYear
		//$tmpDay = $split[2];;
		if (in_array($tmpMonth, $mRange1)) {
			$recYear = $prevYear."-".$tmpMonth."-30";
		}
		else if(in_array($tmpMonth, $mRange2)){
			$recYear = $prevYear."-".$tmpMonth."-31";
		}

		/////////////////////  Check if the year is a leap year or not  //////////////////////
		else{
            
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////!!!!
            	if($prevYear % 4 == 0){
		if($prevYear % 100 == 0){
			if($prevYear %400 == 0){
				$recYear = $prevYear."-".$tmpMonth."-29";
			}
			else{
				$recYear = $prevYear."-".$tmpMonth."-28";
			}	
		}
		else{
			$recYear = $prevYear."-".$tmpMonth."-29";//	
		}	
	}

	else{
		$recYear = $prevYear."-".$tmpMonth."-28";	
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////!!!!!!
			// if( ($prevYear%400==0 || $prevYear%100!=0) && ($prevYear%4==0)){
			// 	$recYear = $prevYear."-".$tmpMonth."-29";
			// }
			// else{
    		//     $recYear = $prevYear."-".$tmpMonth."-28";
			// }


		}		///////////////////$tmpYear///////////////////////////////////////////////////////////////////////
        $recover = new TrackMonth();
        $recover -> monthDepreciation = $recYear;
        $recover -> save();
         // $recover = "INSERT INTO trackMonths(monthDepreciation) VALUES('$recYear')";
		//sc_exec_sql($recover);		
	}
	
	
}
  

else if((($curYear - $prevYear) >0) && ($curMonth == $prevMonth)){
    $totalMonth = (($curYear - $prevYear) *12) -1;
	
	$tmpPrevYear = $prevYear;
    $tmpPrevMonth = $prevMonth;
    $tmpCurMonth = $curMonth;
    $massage = "" ;
    for($count = 1; $count <=$totalMonth; $count++){
        				 $tmpPrevMonth = $tmpPrevMonth + 1;
				    if($tmpPrevMonth > 12){
						 $tmpPrevMonth = 1;
						 $tmpPrevYear = $tmpPrevYear + 1;
                         if(in_array($tmpPrevMonth , $mRange1)){
                             $massage = $tmpPrevYear."-".$tmpPrevMonth."-30";

                         }
                         else if(in_array($tmpPrevMonth,$mRange2)){
                             $massage = $tmpPrevYear."-".$tmpPrevMonth."-31";

                         }
                         else{
                             /////////////////////////////////////////////////////////////////////////////////////////////////!!!!!
                             	if($prevYear % 4 == 0){
		if($prevYear % 100 == 0){
			if($prevYear %400 == 0){
                // It is a leap year
                $massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
			}
			else{
                // It is not a leap year
                $massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
			}	
		}
		else{
            // It is a leap year	
            $massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
		}	
	}

	else{
        // It is not a leap year.	
        $massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
	}
                             /////////////////////////////////////////////////////////////////////////////////////////////////!!!!!
                        	// if( ($prevYear%400==0 || $prevYear%100!=0) &&($prevYear%4==0)){
                			//     $massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
                			// }
                			// else{
                        	// 	$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
                            // }
                        }

                            ///lot $massage = $tmpPrevYear."-".$tmpPrevMonth."-30"
                 }
                 else{
                     if(in_array($tmpPrevMonth , $mRange1)){
                             $massage = $tmpPrevYear."-".$tmpPrevMonth."-30";

                         }
                         else if(in_array($tmpPrevMonth,$mRange2)){
                             $massage = $tmpPrevYear."-".$tmpPrevMonth."-31";

                         }
                         else{
                             /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////!!!!
            	if($prevYear % 4 == 0){
		if($prevYear % 100 == 0){
			if($prevYear %400 == 0){
                // It is a leap year
				$massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
			}
			else{
                // It is not a leap year
				$recYear = $prevYear."-".$tmpMonth."-28";
			}	
		}
		else{
            // It's is a leap year. 
			$massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
		}	
	}

	else{
        // It's not a leap year.
		$recYear = $prevYear."-".$tmpMonth."-28";	
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////!!!!!!
                        	// if( ($prevYear%400==0 || $prevYear%100!=0) &&($prevYear%4==0)){
                			//     $massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
                			// }
                			// else{
                        	// 	$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
                            // }
                        }
                 }
                         $recover2 = new TrackMonth();
                         $recover2 -> monthDepreciation = $massage;
                         $recover2 -> save();
                 //$recover = "INSERT INTO trackMonths(monthDepreciation) VALUES('$massage')";
		        //sc_exec_sql($recover);	
    }

}

else if((($curYear - $prevYear) >0) && ($curMonth > $prevMonth)){
$yDifference = $curYear - $prevYear;
$totalMonth = (12*$yDifference) +($curMonth - $prevMonth -1);
		$tmpPrevYear = $prevYear;
    $tmpPrevMonth = $prevMonth;
    $tmpCurMonth = $curMonth;
    $massage = "" ;
	for($count = 1; $count <=$totalMonth; $count++){
        				 $tmpPrevMonth = $tmpPrevMonth + 1;
				    if($tmpPrevMonth > 12){
						 $tmpPrevMonth = 1;
						 $tmpPrevYear = $tmpPrevYear + 1;
                         if(in_array($tmpPrevMonth , $mRange1)){
                             $massage = $tmpPrevYear."-".$tmpPrevMonth."-30";

                         }
                         else if(in_array($tmpPrevMonth,$mRange2)){
                             $massage = $tmpPrevYear."-".$tmpPrevMonth."-31";

                         }
                         else{
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////!!!!
            	if($prevYear % 4 == 0){
		if($prevYear % 100 == 0){
			if($prevYear %400 == 0){
                // It is a leap year
				$massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
			}
			else{
                // It is not a leap year
				$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
			}	
		}
		else{
            // It's is a leap year. 
			$massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
		}	
	}

	else{
        // It's not a leap year.
		$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";	
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////!!!!!!


                        	// if( ($prevYear%400==0 || $prevYear%100!=0) &&($prevYear%4==0)){
                			//     $massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
                			// }
                			// else{
                        	// 	$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
                            // }
                        }

                            ///lot $massage = $tmpPrevYear."-".$tmpPrevMonth."-30"
                 }
                 else{
                     if(in_array($tmpPrevMonth , $mRange1)){
                             $massage = $tmpPrevYear."-".$tmpPrevMonth."-30";

                         }
                         else if(in_array($tmpPrevMonth,$mRange2)){
                            $massage = $tmpPrevYear."-".$tmpPrevMonth."-31";
                         } 
                         else{
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////!!!!
            	if($prevYear % 4 == 0){
		if($prevYear % 100 == 0){
			if($prevYear %400 == 0){
                // It is a leap year
				$massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
			}
			else{
                // It is not a leap year
				$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
			}	
		}
		else{
            // It's is a leap year. 
			$massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
		}	
	}

	else{
        // It's not a leap year.
		$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";	
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////!!!!!!

                        	// if( ($prevYear%400==0 || $prevYear%100!=0) &&($prevYear%4==0)){
                			//     $massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
                			// }
                			// else{
                        	// 	$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
                            // }
                        }
                 }
                         $recover = new TrackMonth();
                         $recover -> monthDepreciation = $massage;
                         $recover -> save();
                //$recover = "INSERT INTO trackMonths(monthDepreciation) VALUES('$massage')";
		        //sc_exec_sql($recover);	
    }
}
else{
$mToSub = $prevMonth - $curMonth;
$totalMonth = (($curYear - $prevYear) * 12) - 1;
$finalMonth = $totalMonth - $mToSub;
	
	$tmpPrevYear = $prevYear;
    $tmpPrevMonth = $prevMonth;
    $tmpCurMonth = $curMonth;
    $massage = "" ;
	for($count = 1; $count <=$finalMonth; $count++){
        				 $tmpPrevMonth = $tmpPrevMonth + 1;
				    if($tmpPrevMonth > 12){
						 $tmpPrevMonth = 1;
						 $tmpPrevYear = $tmpPrevYear + 1;
                         if(in_array($tmpPrevMonth , $mRange1)){
                             $massage = $tmpPrevYear."-".$tmpPrevMonth."-30";

                         }
                         else if(in_array($tmpPrevMonth,$mRange2)){
                             $massage = $tmpPrevYear."-".$tmpPrevMonth."-31";

                         }
                         else{
                             /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////!!!!
            	if($prevYear % 4 == 0){
		if($prevYear % 100 == 0){
			if($prevYear %400 == 0){
                // It is a leap year
				$massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
			}
			else{
                // It is not a leap year
				$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
			}	
		}
		else{
            // It's is a leap year. 
			$massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
		}	
	}

	else{
        // It's not a leap year.
		$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";	
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////!!!!!!

                        	// if( ($prevYear%400==0 || $prevYear%100!=0) &&($prevYear%4==0)){
                			//     $massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
                			// }
                			// else{
                        	// 	$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
                            // }
                        }

                            ///lot $massage = $tmpPrevYear."-".$tmpPrevMonth."-30"
                 }
                 else{
                     if(in_array($tmpPrevMonth , $mRange1)){
                             $massage = $tmpPrevYear."-".$tmpPrevMonth."-30";

                         }
                         else if(in_array($tmpPrevMonth,$mRange2)){
                             $massage = $tmpPrevYear."-".$tmpPrevMonth."-31";

                         }
                         else{

                            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////!!!!
            	if($prevYear % 4 == 0){
		if($prevYear % 100 == 0){
			if($prevYear %400 == 0){
                // It is a leap year
				$massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
			}
			else{
                // It is not a leap year
				$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
			}	
		}
		else{
            // It's is a leap year. 
			$massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
		}	
	}

	else{
        // It's not a leap year.
		$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";	
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////!!!!!!

                        	// if( ($prevYear%400==0 || $prevYear%100!=0) &&($prevYear%4==0)){
                			//     $massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
                			// }
                			// else{
                        	// 	$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
                            // }
                        }
                 }
                 $recover = new TrackMonth();
                 $recover -> monthDepreciation = $massage;
                 $recover -> save();

                 // $recover = "INSERT INTO trackMonths(monthDepreciation) VALUES('$massage')";
		         // sc_exec_sql($recover);	
    }
}
}
public function depreciateAsset($today){
    // Codes to be returned.
					//$checkIfMDepreciated = "SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'";
		
    // sc_lookup(check,"SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
    // $check =TrackMonth::where("monthDepreciation","=",$today)->count();

                            //sc_lookup(check,"SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
                            
        $check = TrackMonth::where("monthDepreciation","=",$today)->count();
       
        if($check == 0){
            $newTrackMonth = new TrackMonth();
            $newTrackMonth -> monthDepreciation = $today;
            // $newTrackMonth->save();
            // $recCurrentMonth = "INSERT INTO `trackMonths`(`monthDepreciation`) VALUES ('$today')";
            // sc_exec_sql($recCurrentMonth);
            $totalAssetNumberToDepreciate = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">=", 0)->count();
            $totalAssetToDepreciate = Asset::where("AssetStatus", "=", 0)->where("TotalMonthsLeft", ">=", 0)->get();

                //return "About Depreciate $totalAssetToDepreciate";
            for($x = 0; $x < $totalAssetNumberToDepreciate; $x++){
                $currBookVal = $totalAssetToDepreciate[$x]-> assetBookValue;
                
                $currTotalDepAmount = $totalAssetToDepreciate[$x]->totalDepreciatedAmount;
                
                $mnthDep = $totalAssetToDepreciate[$x]->assetMonthlyDepreciation;

                $newBookVal = $currBookVal - $mnthDep;
                $newTotalDep = $currTotalDepAmount + $mnthDep;
                $curId = $totalAssetToDepreciate[$x]->id;
                $currTotalMonthsDepreciated = $totalAssetToDepreciate[$x]->totalMonthsDepreciated;
                $curTotalMonthsLeft = $totalAssetToDepreciate[$x]->totalMonthsLeft;
                $newTotalMonthsDepreciated = $currTotalMonthsDepreciated + 1;
                $newTotalMonthsLeft = $curTotalMonthsLeft -1;
                $startDate = $totalAssetToDepreciate[$x]->assetStartDate;
                $dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
                $currDateSub = substr($today,0,7);
                
                ///  TO BE CONTD
                if($currDateSub >= $dY){

                if($curTotalMonthsLeft>0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
                $newBookVal = $currBookVal - $mnthDep;
                $newTotalDep = $currTotalDepAmount + $mnthDep;
                
                $updateAssetVal = Asset::find($curId);// = "update Assets set 
                //return $updateAssetVal;
                $updateAssetVal -> assetBookValue= $newBookVal;
                $updateAssetVal -> totalDepreciatedAmount = $newTotalDep;
                $updateAssetVal -> totalMonthsLeft = $newTotalMonthsLeft;
                $updateAssetVal -> totalMonthsDepreciated = $newTotalMonthsDepreciated; 
                $updateAssetVal -> save();
                //sc_exec_sql($updateAssetVal);
                if( $newTotalMonthsLeft ==0){
                $updateAssetStatus =Asset::find($curId);
                $updateAssetStatus-> assetStatus = 1;
                $updateAssetStatus -> save();                                          
                //sc_exec_sql($updateAssetStatus);
                }
                    }

        else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
            $newBookVal = 0;
                $newTotalDep =$currTotalDepAmount + $currBookVal;
            
                $updateAssetVal = Asset::find($curId);
                
                $updateAssetVal -> assetBookValue= $newBookVal;
                $updateAssetVal -> totalDepreciatedAmount=$newTotalDep;
                //$updateAssetVal -> TotalMonthsLeft=$newTotalMonthsLeft;
                //$updateAssetVal -> TotalMonthsDepreciated=$newTotalMonthsDepreciated;
                $updateAssetVal -> assetStatus = 1;
                $updateAssetVal -> save(); 
                //sc_exec_sql($updateAssetVal);
                
                //$updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
                //sc_exec_sql($updateAssetStatus);        
                
        }
            }
            }
        }
}

}