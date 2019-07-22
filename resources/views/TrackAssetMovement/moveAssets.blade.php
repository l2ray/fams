@extends('Layout/assetCreateLayout')
@section('createAsset')

    <section class="centerIt">
        {{Form::open(["action"=>"TrackAssetMovementController@store","method"=>"POST"])}}
                <div class="form-row">
                    <div class="form-group col-lg-3">
                        {{Form::Label("srcDep","Source Department")}}
                    </div>
                    <div class="form-group col-lg-9">
                        {{Form::Select("srcDep",$depNames,"",["class"=>"form-control","id"=>"srcDep"])}}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-3">
                        {{Form::Label("srcUnit","Source Unit")}}
                    </div>
                    <div class="form-group col-lg-9">
                        {{Form::Select("srcUnit",[],"",["class"=>"form-control","id"=>"srcUnit"])}}
                    </div>
                    {{Form::text("srcId","",["id"=>"srcId","hidden"])}}
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-3">
                        {{Form::Label("aToMove","Asset To Move")}}
                    </div>
                    <div class="form-group col-lg-9">
                        {{Form::Select("aToMove",[],"",["class"=>"form-control","id"=>"aToMove"])}}
                        {{Form::text("aToMoveId","",["id"=>"aToMoveId"])}}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-3">
                        {{Form::Label("destDep","Destination Department")}}
                    </div>
                    <div class="form-group col-lg-9">
                        {{Form::Select("destDep",[],"",["class"=> "form-control","id"=>"destDep"])}}
                        {{Form::text("destDepId","",["id"=>"destDepId"])}}
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-3">
                        {{Form::Label("destUnit","Destination Unit")}}
                    </div>
                    <div class="form-group col-lg-9">
                        {{Form::Select("destUnit",[],"",["class"=>"form-control","id"=>"destUnit"])}}
                    </div>
                    {{Form::text("destUnitId","",["id"=> "destUnitId","hidden"])}}
                </div>
                <div class="form-row">
                    <div class="form-group col-lg-3">
                        
                    </div>
                    <div class="form-group col-lg-9">
                        {{Form::Submit("Submit",["class"=>"btn btn-success form-control"])}}
                    </div>
                </div>
        {{Form::close()}}
    </section>

		<script src="{{asset('js/jquery-3.3.1.js') }}"></script>
		<script src="{{asset('js/assets.js')}}"></script>

@endsection