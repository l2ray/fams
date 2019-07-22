 for($x = 0; $x< count($users); $x++){
            $encPassword = $users[$x]->password;
            $encLogin = $users[$x] -> login;

            $decPassword = Crypt::decrypt($encPassword);
            if($password == $decPassword && $encLogin == $userName){

                //////////////  Run Depreciation

                	//////////  UPDATE DEPRECIATION  /////////////////////////////
    $isTblEmpty="SELECT count(id) FROM trackMonths order by id DESC LIMIT 1";
    $totalRecord = count(TrackMonth::all());
	//sc_lookup(ite,$isTblEmpty);
	$curDate = date("Y-m-d");
	if($totalRecord != 0){
    $lastQuery = "SELECT monthDepreciation FROM trackMonths order by id DESC LIMIT 1";
    $totalCounts = TrackMonth::all();
    $prevDate = $totalCounts[count($totalCounts)-1]->monthDepreciation;
// sc_lookup(l,$lastQuery);

// $prevDate = {l[0][0]};
// sc_error_message($prevDate." is the previous Date from db");

	
$dateMassage = explode("-",$prevDate);
$prevYear = $dateMassage[0];
$prevMonth = $dateMassage[1];
$prevDay = $dateMassage[2];

$curDateMassage = explode("-",$curDate);
$curYear = $curDateMassage[0];
$curMonth = $curDateMassage[1];
$curDay = $curDateMassage[2];
	$totalDepMonth = 0;
	
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
			lot();
		}
	sync_prev_month();
		}
	//
	////////////////////////  END DEPRECIATION  ///////////////////////////////////////

/**
 * Adding one month(30days) to the due date
 */
/*
 * This macro calculates and returns increments and decrements using dates.
 */
$today = $curDate;//"2019-01-31";//date("Y-m-d"); // "2020-02-29"


$dateArr = explode("-",$today);
$month = $dateArr[1];
$day = $dateArr[2];
	$mRange1 = array(9,4,6,11); // Months that end with 30 days;
	$mRange2 = array(1,3,5,7,8,10,12); // Months that end with 31 days;

	if (in_array($month, $mRange1)) {
					//$checkIfMDepreciated = "SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'";
		
    //sc_lookup(check,"SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
    $check =TrackMonth::where("monthDepreciation","=",$today)->count();
		if($check == 0){
			if($day == 30){
				//sc_lookup(check,"SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
					//if({check[0][0]} == 0){
                        $recCurrentMonth = new TrackMonth();
                        $recCurrentMonth -> monthDepreciation = $today;
                        $recCurrentMonth->save(); 
                        //"INSERT INTO `trackMonths`(`monthDepreciation`) VALUES ('$today')";
                        
						//sc_exec_sql($recCurrentMonth);
                        $countIt = TrackMonth::where("AssetStatus","=",0)->where("TotalMonthsLeft",">",0)->count();
                        //"SELECT count(*) from Assets where AssetStatus = 0 and TotalMonthsLeft>0";//"SELECT count(*) from Assets  where AssetStatus = 0";
						//sc_lookup(c,$countIt);
						$assets = "SELECT id,AssetBookValue,TotalDepreciatedAmount,AssetMonthlyDepreciation,TotalMonthsDepreciated,TotalMonthsLeft,AssetStartDate from Assets where AssetStatus = 0 and TotalMonthsLeft>0";
						//sc_lookup(a,$assets);
						//for($x = 0; $x < $countIt[0][0]; $x++){
                        for($x = 0; $x < $countIt; $x++){
							$curId = {a[$x][0]};
							$currBookVal = {a[$x][1]};
							$currTotalDepAmount = {a[$x][2]};
							$mnthDep = {a[$x][3]};
							$newBookVal = $currBookVal - $mnthDep;
							$newTotalDep = $currTotalDepAmount + $mnthDep;
							$currTotalMonthsDepreciated = {a[$x][4]};;
							$curTotalMonthsLeft = {a[$x][5]};
							$newTotalMonthsDepreciated = $currTotalMonthsDepreciated + 1;
							$newTotalMonthsLeft = $curTotalMonthsLeft -1;
							$startDate = {a[$x][6]};
							$dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
							$currDateSub = substr($today,0,7);
							if($currDateSub >= $dY){
								
						  if($curTotalMonthsLeft>0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
                          $newBookVal = $currBookVal - $mnthDep;
                          $newTotalDep = $currTotalDepAmount + $mnthDep;
                          $updateAssetVal = "update Assets set AssetBookValue= $newBookVal,TotalDepreciatedAmount=$newTotalDep,TotalMonthsLeft=$newTotalMonthsLeft,TotalMonthsDepreciated=$newTotalMonthsDepreciated where id = $curId";
                          sc_exec_sql($updateAssetVal);
                          if($newTotalMonthsLeft ==0){
                                  $updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
                                  sc_exec_sql($updateAssetStatus);
                          }
                  }
	
	  
                  else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
					  
                          $newBookVal = 0;
                          $newTotalDep =$currTotalDepAmount + $currBookVal;
					   
                          $updateAssetVal = "update Assets set AssetBookValue= $newBookVal,TotalDepreciatedAmount=$newTotalDep,TotalMonthsLeft=$newTotalMonthsLeft,TotalMonthsDepreciated=$newTotalMonthsDepreciated,AssetStatus = 1 where id = $curId";
                          //sc_exec_sql($updateAssetVal);
                            
                          //$updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
                         // sc_exec_sql($updateAssetStatus);        
                  }
						//}
								
							}
					}
			}
		}

	}
	else if (in_array($month, $mRange2)) {
			
		//sync_prev_month();  ------------- to be called later
		/////// Code Watch!!!
					if($day == 31){
// Codes to be returned.
												sc_lookup(check,"SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
							if({check[0][0]} == 0){
								$recCurrentMonth = "INSERT INTO `trackMonths`(`monthDepreciation`) VALUES ('$today')";
								sc_exec_sql($recCurrentMonth);
								$countIt = "SELECT count(*) from Assets where AssetStatus = 0 And TotalMonthsLeft > 0";
								sc_lookup(c,$countIt);
								
								$assets = "SELECT id,AssetBookValue,TotalDepreciatedAmount,AssetMonthlyDepreciation,TotalMonthsDepreciated,TotalMonthsLeft,AssetStartDate from Assets where AssetStatus = 0 And TotalMonthsLeft > 0";
								sc_lookup(a,$assets);
								for($x = 0; $x < {c[0][0]}; $x++){
									$currBookVal = {a[$x][1]};
									$currTotalDepAmount = {a[$x][2]};
									$mnthDep = {a[$x][3]};
									$newBookVal = $currBookVal - $mnthDep;
									$newTotalDep = $currTotalDepAmount + $mnthDep;
									$curId = {a[$x][0]};
									$currTotalMonthsDepreciated = {a[$x][4]};;
									$curTotalMonthsLeft = {a[$x][5]};
									$newTotalMonthsDepreciated = $currTotalMonthsDepreciated + 1;
									$newTotalMonthsLeft = $curTotalMonthsLeft -1;
									$startDate = {a[$x][6]};
									$dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
									$currDateSub = substr($today,0,7);
									
									$updateAssetVal = "update Assets set AssetBookValue= 600,TotalDepreciatedAmount=1,TotalMonthsLeft=11,TotalMonthsDepreciated=32 where id = $curId";
		                          sc_exec_sql($updateAssetVal);
									
									//$startDate = ${a[$x][6]};
									//$dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
									//$currDateSub = substr($today,0,7);
									if($currDateSub >= $dY){

									if($curTotalMonthsLeft>0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
		                          $newBookVal = $currBookVal - $mnthDep;
		                          $newTotalDep = $currTotalDepAmount + $mnthDep;
		                          $updateAssetVal = "update Assets set AssetBookValue= $newBookVal,TotalDepreciatedAmount=$newTotalDep,TotalMonthsLeft=$newTotalMonthsLeft,TotalMonthsDepreciated=$newTotalMonthsDepreciated where id = $curId";
		                          sc_exec_sql($updateAssetVal);
		                          if( $newTotalMonthsLeft ==0){
		                                  $updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
		                                  sc_exec_sql($updateAssetStatus);
		                          }
										}
		                 
			
			  
		                  else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
							   $newBookVal = 0;
		                          $newTotalDep =$currTotalDepAmount + $currBookVal;
							   
		                          $updateAssetVal = "update Assets set AssetBookValue= $newBookVal,TotalDepreciatedAmount=$newTotalDep,TotalMonthsLeft=$newTotalMonthsLeft,TotalMonthsDepreciated=$newTotalMonthsDepreciated,AssetStatus = 1 where id = $curId";
		                          //sc_exec_sql($updateAssetVal);
		                            
		                          //$updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
		                          //sc_exec_sql($updateAssetStatus);        
		                         
		                  }
							 }//} Start DAte Check End
								}
							}
					}
		
		
		/////////////////////////////////////  Codes Check!!!
	}

	else{
		$year = $dateArr[0];
                        	if( ($year%400==0 || $year%100!=0) &&($year%4==0)){
														if($day == 29){
															sc_lookup(check,"SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
																if({check[0][0]} == 0){
																	$recCurrentMonth = "INSERT INTO `trackMonths`(`monthDepreciation`) VALUES ('$today')";
																	sc_exec_sql($recCurrentMonth);
																	$countIt = "SELECT count(*) from Assets where AssetStatus = 0 And  TotalMonthsLeft > 0";
																	sc_lookup(c,$countIt);
																	$assets = "SELECT id,AssetBookValue,TotalDepreciatedAmount,AssetMonthlyDepreciation ,TotalMonthsDepreciated,TotalMonthsLeft,AssetStartDate from Assets where AssetStatus = 0 AND TotalMonthsLeft > 0";
																	sc_lookup(a,$assets);
																	for($x = 0; $x < {c[0][0]}; $x++){
																		$currBookVal = {a[$x][1]};
																		$currTotalDepAmount = {a[$x][2]};
																		$mnthDep = {a[$x][3]};
																		$newBookVal = $currBookVal - $mnthDep;
																		$newTotalDep = $currTotalDepAmount + $mnthDep;
																		$curId = {a[$x][0]};
																		$currTotalMonthsDepreciated = {a[$x][4]};;
							$curTotalMonthsLeft = {a[$x][5]};
							$newTotalMonthsDepreciated = $currTotalMonthsDepreciated + 1;
							$newTotalMonthsLeft = $curTotalMonthsLeft -1;
							$startDate = {a[$x][6]};
							$dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
							$currDateSub = substr($today,0,7);
if($currDateSub >= $dY){
																		if($curTotalMonthsLeft>0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
											                          $newBookVal = $currBookVal - $mnthDep;
											                          $newTotalDep = $currTotalDepAmount + $mnthDep;
											                          $updateAssetVal = "update Assets set AssetBookValue= $newBookVal,TotalDepreciatedAmount=$newTotalDep,TotalMonthsLeft=$newTotalMonthsLeft,TotalMonthsDepreciated=$newTotalMonthsDepreciated where id = $curId";
											                          sc_exec_sql($updateAssetVal);
											                          if(  $newTotalMonthsLeft ==0){
											                                  $updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
											                                  sc_exec_sql($updateAssetStatus);
											                          }
											                  }
												
												  
											                  else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
																  
											                          $newBookVal = 0;
											                          $newTotalDep =$currTotalDepAmount + $currBookVal;
																   
											                          $updateAssetVal = "update Assets set AssetBookValue= $newBookVal,TotalDepreciatedAmount=$newTotalDep,TotalMonthsLeft=0,TotalMonthsDepreciated=$newTotalMonthsDepreciated,AssetStatus = 1 where id = $curId";
											                         // sc_exec_sql($updateAssetVal);
											                            
											                          //$updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
											                        //  sc_exec_sql($updateAssetStatus);        
											                  }
																		}
																	}
																}
														}
                			    $massage = $tmpPrevYear."-".$tmpPrevMonth."-29";
                			}
                			else{
												if($day == 28){
				 								 sc_lookup(check,"SELECT count(monthDepreciation) from trackMonths where monthDepreciation = '$today'");
				  									if({check[0][0]} == 0){
				  										$recCurrentMonth = "INSERT INTO `trackMonths`(`monthDepreciation`) VALUES ('$today')";
				  										sc_exec_sql($recCurrentMonth);
				  										$countIt = "SELECT count(*) from Assets where AssetStatus = 0 AND TotalMonthsLeft > 0";
				  										sc_lookup(c,$countIt);
				  										$assets = "SELECT id,AssetBookValue,TotalDepreciatedAmount,AssetMonthlyDepreciation,TotalMonthsDepreciated,TotalMonthsLeft,AssetStartDate from Assets where AssetStatus = 0 AND TotalMonthsLeft > 0";
				  										sc_lookup(a,$assets);
				  										for($x = 0; $x < {c[0][0]}; $x++){
				  											$currBookVal = {a[$x][1]};
				  											$currTotalDepAmount = {a[$x][2]};
				  											$mnthDep = {a[$x][3]};
				  											$newBookVal = $currBookVal - $mnthDep;
				  											$newTotalDep = $currTotalDepAmount + $mnthDep;
				  											$curId = {a[$x][0]};
															$currTotalMonthsDepreciated = {a[$x][4]};;
							$curTotalMonthsLeft = {a[$x][5]};
							$newTotalMonthsDepreciated = $currTotalMonthsDepreciated + 1;
							$newTotalMonthsLeft = $curTotalMonthsLeft -1;
							$startDate = {a[$x][6]};
							$dY = substr($startDate,0,7); // Just get the Year and the Month from the Asset Start Date
							$currDateSub = substr($today,0,7);
															if($currDateSub >= $dY){

																if($curTotalMonthsLeft>0){//(($currBookVal > $currTotalDepAmount) && (($currBookVal - $mnthDep) >= $mnthDep)){
									                          $newBookVal = $currBookVal - $mnthDep;
									                          $newTotalDep = $currTotalDepAmount + $mnthDep;
									                          $updateAssetVal = "update Assets set AssetBookValue= $newBookVal,TotalDepreciatedAmount=$newTotalDep,TotalMonthsLeft=$newTotalMonthsLeft,TotalMonthsDepreciated=$newTotalMonthsDepreciated where id = $curId";
									                          sc_exec_sql($updateAssetVal);
									                          if( $newTotalMonthsLeft ==0){
									                                  $updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
									                                  sc_exec_sql($updateAssetStatus);
									                          }
									                  }
										
										  
									                  else{ //  if(($curTotalDepAmount > $curBookVal ) && ($curBookVal != 0))
														  
									                          $newBookVal = 0;
									                          $newTotalDep =$currTotalDepAmount + $currBookVal;
														   
									                          $updateAssetVal = "update Assets set AssetBookValue= $newBookVal,TotalDepreciatedAmount=$newTotalDep,TotalMonthsLeft=0,TotalMonthsDepreciated=$newTotalMonthsDepreciated,AssetStatus = 1 where id = $curId";
									                        //  sc_exec_sql($updateAssetVal);
									                            
									                         // $updateAssetStatus = "UPDATE Assets set AssetStatus = 1 where id = $curId";
									                         // sc_exec_sql($updateAssetStatus);        
									                  }
															}
				  										}
				  									}
				 	 						}
                        		$massage = $tmpPrevYear."-".$tmpPrevMonth."-28";
                            }
						}
						

                ////////////////
                return view("Dashboard/Welcome");
            }
        }