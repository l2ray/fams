

var productName = "";
    var productId = 0;
    var isTaxable = 0;
    var initTotal = 0;
    var vat = 0;
    $(document).ready(function(){
            // $('#rValue').blur(function(){
            //     $assetCost = parseInt($("#aCost").val());
            //     $lifeSpan = parseInt($("#aUPeriod").val());
            //     $salvageVal = parseInt($("#rValue").val());
            //     if($assetCost < $salvageVal){
            //         alert("Sorry The Asset Cost ("+$assetCost+") cannot be less than the Salvage Value ("+$salvageVal+")");
            //     }
            //     else{
            //          $annualDepreciation = ($assetCost - $salvageVal) / $lifeSpan;
            //          $monthlyDepreciation = $annualDepreciation/12;
                    
            //         // [totalMonthsToDepreciate] = $lifeSpan * 12;//floor($assetCost/$monthlyDepreciation);
            //          $monthlyDepre = parseFloat($monthlyDepreciation.toFixed(2));
            //          $("#mDepreciation").val($monthlyDepre);
            //          //{AssetBookValue} = $assetCost;
            //     }
            // });
/////////////////////////////////////////////////////////////////////
            $('#aCost').blur(function(){
                $lot = $('#aCost').val();
                console.log($lot);
                $('#bVal').val($lot);
            });
            $("#aCategory").change(function(){
                var catId = $("#aCategory").val()
                //console.log(catId);
                $.get("/fetchData/"+catId,function(data){
                    $("#bCode").val(data);
                });
            });
             $("#aUnit").change(function(){
                $xxx = $("#aUnit").find('option:selected').val(); // Selecting the value of the current unit as Id
                $("#unitId").val($xxx);
             });
            $("#department").change(function(){
                console.log("sf");
                $("#aUnit").html("");
                $option2 = "<option id=\"3\">Name3</option>";
                $option3 = "<option id=\"2\">Name2</option>";
                $depId = $("#department").val();
                //console.log($depId);
                $.get("/getUnitDep/"+$depId,function(data){
                    for($x = 0; $x<data.length; $x++){
                        $id = data[$x].id;
                        $depName = data[$x].unitName;
                        $option = "<option id=\""+$id+"\" value=\""+$id+"\">"+$depName+"</option>";
                        $("#aUnit").append($option);
                        //console.log($id+" : "+$depName);
                    }
                });
            })
        $("#aToMove").change(function(){
            $curSelVal = $("#aToMove").val();
            $("#aToMoveId").val($curSelVal);
        })
        $("#srcDep").change(function(){
            $srcDepId = $("#srcDep").val();
            $("#srcUnit").html("");

            // console.log("#aToMove");
            $("#destDep").html("");
            $.get("/getDepartments/"+$srcDepId,function(data){

                $("#destDep").append("<option value=\"-1\">Please select an asset to move</option>");
                for ($x = 0; $x < data.length; $x++) {
                    $id = data[$x].id;
                    $depName = data[$x].depName;
                    $option = "<option id=\"" + $id + "\" value = \"" + $id + "\">" + $depName + "</option>";
                    $("#destDep").append($option);
                }
            });

            $("#aToMove").html("");
            $.get("/getAssetInDep/"+$srcDepId,function(data){
                $("#aToMove").append("<option value=\"-1\">Please select an asset to move</option>");
                for($x = 0; $x < data.length; $x++){
                    $id = data[$x].id;
                    $aName = data[$x].assetName;
                    $option = "<option id=\"" + $id + "\" value = \"" + $id + "\">" + $aName + "</option>";
                    $("#aToMove").append($option);
                }
            });

            $.get("/getSourceUnit/"+$srcDepId,function(data){
                for($x = 0; $x < data.length; $x++){
                    $id=data[$x].id;
                    $unitName = data[$x].unitName;
                    $option = "<option id=\""+$id+"\" value = \""+$id+"\">"+$unitName+"</option>";
                    $("#srcUnit").append($option);
                    
                    // console.log($option);
                }
           
            });

            //console.log($val);
        })
        $("#destDep").change(function () {
            $destDepId = $("#destDep").val();
            console.log($destDepId);
            $("#destDepId").val($destDepId);
            $("#destUnit").html("");
            $defaultOption = "<option value = \"-1\">Please select unit to Move Asset</option>";
            $("#destUnit").append($defaultOption);
            $.get("/getdestUnit/"+$destDepId,function(data){
                for($x = 0; $x<data.length; $x++){
                    $id = data[$x].id;
                    $option = "<option id=\""+$id+"\" value=\""+$id+"\">"+data[$x].unitName+"</option>"
                    $("#destUnit").append($option); 
                }
            });

        })
        $("#srcUnit").change(function(){
            $srcId = $("#srcUnit").val();
            $("#srcId").val($srcId); 
        })
        $("#destUnit").change(function(){

            $unitId = $("#destUnit").val();
            $("#destUnitId").val($unitId);
        });

/////////////////////////////////////////////////////////////////////
        // $("#productSubmit").on('click',function(){
        //      $("#tblSales").find("tr:gt(0)").remove();
        // });
            
           
            //alert("This is a test.");
        //     $("#proId").blur(function(){
        //        var tmp = $( "#proId" ).val();
               
        //     //console.log(tmp);
        //     $.get("/test/"+tmp,function(data){
        //         productName = data.pName
        //         productId = data.id;
        //         isTaxable = data.isTax;
        //         console.log(isTaxable);
        //         console.log(data);
        //         $("#unitPrice").val(data.pUnitPrice);
        //         $("#watchForId").val(productId);
        //        // console.log(productId);
        //     });
        //     // 8gb hdd 500
        // });
        
        // $("#proGId").blur(function(){
        //     var tmp = $( "#proGId" ).val();
               
        //     //console.log(tmp);
        //     $.get("/test/"+tmp,function(data){
        //         productName = data.pName
        //         productId = data.id;
        //         isTaxable = data.isTax;
        //         console.log(isTaxable);
        //         $("#unitPrice").val(data.pUnitPrice);
        //         $("#watchForId").val(productId);
        //        // console.log(productId);
        //     });
        // })

        // $("#isGeneric").click(function(){
        //     $flag = $("#isGeneric").is(":Checked");
        //     if($flag){
        //         //console.log("Yes");
               
        //         $("#isGeneric1").css("display","block");
        //         $("#proId1").css("display","none");
        //     }
        //     else{
        //         console.log("No It is not checked");
        //                 //$("#isGeneric1").css("display","none");                      

        //         $("#isGeneric1").css("display","none");
        //         $("#proId1").css("display","block");
        //     }

        // });
        
        // $("#pQuantity").blur(function(){
        //      //curId = 0;
        //     //console.log(productId+" is the curProduct");
        //     if(isTaxable == 1){
        //     var uPrice = $("#unitPrice").val();
        //     var quantity = $("#pQuantity").val();
        //     var totalPrice = 0;
        //     var initTotal = parseFloat(quantity) * parseFloat(uPrice);//= parseInt($("#totalPrice").val());
        //     var totalPrice = parseFloat(quantity) * parseFloat(uPrice);
        //     var initTot = parseFloat($("#totalPrice").val());
        //     vat = totalPrice*(15/100);
        //     initTotal = initTotal;
        //     totalPrice = initTot+totalPrice;
        //      $("#totalPrice").val(totalPrice);
        //     }
        //     else{
        //     var uPrice = $("#unitPrice").val();
        //     var quantity = $("#pQuantity").val();
        //     var initTotal = parseFloat(quantity) * parseFloat(uPrice);//= parseInt($("#totalPrice").val());
        //     var totalPrice = parseFloat(quantity) * parseFloat(uPrice);
        //     var initTot = parseFloat( $("#totalPrice").val());
        //     totalPrice = initTot+totalPrice;
        //     $("#totalPrice").val(totalPrice);
        //     }

            
        //    //totalPrice = q*uPrice;
        //     //alert(x*y);
          

        //     // $('#tblSales').append("<tr id='l'><td>"+ productName+".</td><td>"+ quantity+". </td><td>"+initTotal+
        //     //     ".</td><td><button onClick='test("+productId+")'class='btn btn-danger '"+"_"+initTotal+"_"+">Remove Product</button></td></tr>");//var tblRow = "<tr>";
        //     //     var formatD = productName+","+quantity+","+initTotal+","+productId+","+vat.toFixed(2);
        //     //    // alert(formatD);
        //     //     $.get('/addTmpData/'+formatD,function(data){

        //     //     })
        // });
        // $("#productSubmit").on('click',function(e){
        //    // $('#l').remove();
        //     // $("table").find('input[name="record"]').each(function(){
        //     // 	if($(this).is(":checked")){
        //     //         $(this).parents("tr").remove();
        //     //     }
        //     // });$("#tblSales")
        // })
        // $('#tblSales').on('click', 'button', function(e){
        //     e.preventDefault();
        //     //<button onclick="test(2)" class="btn btn-danger " 2="">Remove Product</button>
            
        //     //console.log(curPId);
        //     var tmp = window.confirm("Are You sure You want to remove this Product From the Chart list?");
        //     //alert(tmp);
        //     if(tmp){
  

        //         curPId = e.target.outerHTML.split("(")[1].split(")")[0];
        //         $.get('/deleteProduct/'+curPId,function(data){});
        //         var xyz = $(this).parents('tr').remove();

        //         var reverse = parseFloat(e.target.outerHTML.split("_")[1]); //To get the amount of the deleted item
        //         var prevAmount = parseFloat($("#totalPrice").val()); // to get the amount before a delete
        //         var backTrack = prevAmount - reverse;
        //         if(backTrack === NaN){
        //             $("#totalPrice").val(0);
        //         }else{
        //             $("#totalPrice").val(backTrack);
        //         }
               
        //     return false;
        //     }
        //     else{
        //         return true;
        //     }
        // });
    });
    function test(input){
        //alert(input);
        
    }