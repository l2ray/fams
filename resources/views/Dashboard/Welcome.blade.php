@extends('Layout/assetCreateLayout')
@section('createAsset')
<div class="container">
    <div class="row">
        <div class="col-lg-6 Q">
            <div  id="piechart" style="height:50%;" >sdfsd</div>
        </div>
        <div class="col-lg-6 Q">
           <iframe src="http://localhost:8000/depreciatedAssets" height="300" width="600"></iframe>
        </div>
        <div class="col-lg-12 Q">
            3
        </div>
    </div>
</div>





@endsection
<script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
<script src="{{ asset('js/highcharts.js') }}"></script>

<script>
$productCatId = [];
        var add = [];
        $.get("/getAssetList",function(data){
        for($x = 0; $x<data.length; $x++){
            $productCatId.push(data[$x].assetCategory);
        }
    });
    $.get("/getCategoryList",function(data){
        

         for($x = 0; $x < data.length; $x++){
             id = data[$x].id;
            
            $tmpCount = 0;
            for($y = 0; $y < $productCatId.length; $y++){
                 console.log("Lamin");
                if($productCatId[$y] == data[$x].id){
                    $tmpCount = $tmpCount+1;
                    console.log($tmpCount);
                    $productCatId
                }
                //console.log("tmpCount => "+$tmpCount);
            }
            
            cName = data[$x].catName;
            qty = $tmpCount;
            
       
             $tmp = [cName,qty];
             add.push($tmp);
        //     $dd = [cName,qty];
        //     add.push(23)
         };
         //console.log("in the Loop")
         //console.log(add); 
        //console.log(add);
        
       
    });
$(document).ready(function(){
    $assetCategoryList =[];
    
    //console.log($assetCategoryList);
    
  



    // for($x = 0; $x < $assetCategoryList.length; $x++)
    $xyz =  [
            [ "Test Category", 1 ],
            [ "Software", 4 ]
        ];


   // console.log("Out Side the Loop")
    console.log(add); 
    //console.log("sdfs")

Highcharts.chart('piechart', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: "Assets By Category"
    },
    tooltip: {
        pointFormat: '<b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        data: add
    }]
});

});

</script>