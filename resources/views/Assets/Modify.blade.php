	 <!-- Student	=>	SIJ-924 Miss. Isatou Jallow -->
	 @extends("Layout/assetCreateLayout")
@section('createAsset')
	 <section class="centerIt">
		 {{Form::model($asset,array('route'=>array('asset.update',$asset->id),'method'=>'PUT'))}}
		<!-- Form::open(['action'=>'AssetController@store','method'=>'POST']) -->
	 		<div class="c">
				<div class="form-row ">
					<div class="form-group col-lg-3">
						{{Form::Label('aName','Asset Name')}}
					</div>
					<div class="form-group col-lg-9">
						{{Form::Text('aName',"$asset->assetName",['class'=>'form-control','placeholder'=>'Asset Name','required'])}}
					</div>	
				</div>
				
				<div class="form-row">
					<div class="form-group col-lg-3">
						{{Form::Label('aCost','Asset Cost')}}
					</div>
					<div class="form-group col-lg-9">
						{{Form::number('aCost',"$asset->assetCost",['class'=>'form-control','placeholder'=>'Asset Cost','required',"id"=>"aCost"])}}
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-lg-3">
						{{Form::Label('aUsagePeriod','Asset Usage Period')}}
					</div>
					<div class="form-group col-lg-9">
						{{Form::number('aUsagePeriod',"$asset->assetUsagePeriod",['class'=>'form-control','placeholder'=>'Asset Usage Period','required',"id"=>"aUPeriod"])}}
					</div>
				</div>
				<div class="form-row">
					<div class="from-group col-lg-3">
						{{Form::Label('rValue','Residual Value')}}
					</div>
					<div class="form-group col-lg-9">
						{{Form::number('rValue',"$asset->residualValue",['class'=>'form-control','placeholder'=>'Residual Value','required',"id"=>"rValue"])}}
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-lg-3">
						{{Form::Label('bValue','Book Value')}}
					</div>
					<div class="form-group col-lg-9">
						{{Form::text('bValue',"$asset->assetBookValue",['class'=>'form-control',"id"=>"bVal","readonly"] )}}
					</div>

				</div>
				<div class="form-row">
					<div class="form-group col-lg-3">
						{{Form::Label('mDepreciation','Monthly Depreciation')}}
					</div>
					<div class="form-group col-lg-9">
						{{Form::text('mDepreciation',"$asset->assetMonthlyDepreciation",["readonly",'class'=>'form-control',"id"=>"mDepreciation"])}}
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-lg-3">
						{{Form::Label('aStartDate','Asset Start Date')}}
					</div>
					<div class="form-group col-lg-9">
						{{Form::date("aStartDate","$asset->assetStartDate",['class'=>'form-control'])}}
					</div>
				</div>
			 </div>

<!-- ////////////////////////////////////////////////////////////////////////////// -->

			<div class="c">
	 				<div class="form-row">
	 			<div class="form-group col-lg-3">
	 				{{Form::Label("uAssigned","User Assingned")}}
				</div>
				<div class="form-group col-lg-9">
					{{Form::text("uAssigned","$asset->userAssigned",["class"=>"form-control",'placeholder'=>'User Assingned'])}}
				</div>
			</div>
	 		<div class="form-row">
	 			<div class="form-group col-lg-3">
	 				{{Form::Label("aCategory","Asset Category")}}
				</div>
				<div class="form-group col-lg-9">
					{{Form::select("aCategory",$acategory,"S",["class"=>"form-control","id"=>"aCategory"])}}
				</div>
			</div>
			<!-- <div class="form-row">
	 			<div class="form-group col-lg-3">
	 				{{Form::Label("aType","Asset Type")}}
				</div>
				<div class="form-group col-lg-9">
					{{Form::Select("aType",["Type 1","Type 2","Type 3","Type 4"],"S",["class"=>"form-control","width"=>"100"])}}
				</div>
			</div> -->
			<div class="form-row">
	 			<div class="form-group col-lg-3">
	 				{{Form::Label("aLocation","Asset Location")}}
				 </div>
				 <div class="form-group col-lg-9">
					 {{Form::Select("aLocation",$assetLocation,"SS",["required","class"=>"form-control"])}}
				 </div>
			</div>
			<div class="form-row">
				 <div class="form-group col-lg-3">
					 {{Form::Label("aDescription","Asset Description")}}
				 </div>
				 <div class="form-group col-lg-9">
	 				{{Form::textarea("aDescription","$asset->assetDescription",["required","class"=>"form-control","placeholder"=>"Asset Description","required",'rows'=>'4'])}}
				 </div>
			</div>
			<div class="form-row">
				<div class="form-group col-lg-3">
	 				{{Form::Label("bCode","Barcode")}}
				</div>
				<div class="form-group col-lg-9">
	 				{{Form::text("bCode","$asset->barcode",["required","class"=>"form-control","readonly","id"=>"bCode"])}}
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-lg-3">
					{{Form::Label("aDep","Asset Department")}}
				</div>
				<div class="form-group col-lg-9">
					{{Form::Select("aDep",$depName,"",["required","id"=>"department","class"=>"form-control"])}}
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-lg-3">
					{{Form::Label("aUnit","Asset's Unit")}}
				</div>
				<div class="form-group col-lg-9">
					{{Form::Select("aUnit",[],"",["id"=>"aUnit","class"=>"form-control"])}}
					{{Form::Text('unitId',"",["id"=>"unitId","hidden","required"])}}
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-lg-3">
					{{Form::Label("","")}}
				</div>
				<div class="form-group col-lg-9">
					{{Form::Submit("Submit",["class"=>"form-control btn btn-success"])}}
				</div>
			</div>
			</div>
	 	{{Form::close()}}
	 </section>

		<script src="{{asset('js/jquery-3.3.1.js') }}"></script>
		<script src="{{asset('js/assets.js')}}"></script>
@endsection