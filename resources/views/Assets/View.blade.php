@extends('Layout/appLayout')
@section('content')
<!-- <h1>Viewing Assets</h1> -->
<!-- {{$allAsset}} -->
<section class="container tableCenter">
    <a href="/asset/create" class="btn btn-block btn-success">Add Asset</a>
    <table class="table table-bordered ">
        <tr>
            <th>Asset Name</th>
            <th>CategoryName</th>
            <th>Location</th>
            <th>Department Name</th>
            <th>Unit Name</th>
            <th>AssetCategory</th>
            <th>Barcode</th>
            <th>Book Value</th>
            <th>Months Left</th>
            <th>Action</th>
            
        </tr>
        @for($count = 0; $count < count($catName); $count++)
        @php
            $bookValue = $allAsset[$count] -> assetBookValue;
            $formatData = sprintf('%0.2f', $bookValue);
        @endphp
            <tr>
                <td style="text-align:center;">{{$allAsset[$count] -> assetName}}</td>
                <td>{{$catName[$count]}}</td>
                <td>{{$location[$count]}}</td>
                <td>{{$assetDepartment[$count]}}</td>
                <td>{{$assetUnit[$count]}}</td>
                <td>{{$categoryNames[$count]}}</td>

                <td>
                    <img src="data:image/png;base64,{{base64_encode($barcodeImage[$count])}}" width="100" height="50" />
                    <br/>{{$allAsset[$count]->barcode}}
                </td>
                <td>
                    {{$formatData}}
                </td>
                <td>{{$allAsset[$count]->totalMonthsLeft}}</td>
                <td>
                    <a href="asset/{{$allAsset[$count]->id}}/edit" class="btn btn-primary" style="margin-bottom:2px;">&nbsp;&nbsp;Edit&nbsp;&nbsp;</a>
                    <!-- <a href="#" class="btn btn-danger">Delete</!-->
                        {{Form::open(['url'=>'/asset/'.$allAsset[$count]->id,'style'=>'display:inline'])}}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                        {{Form::close()}}
                </td>
                
            </tr>

        @endfor

    </table>
    <div style="margin-right:100px;">{{$allAsset->links()}}</div>
</section>
@endsection