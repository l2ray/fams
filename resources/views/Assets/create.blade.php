	 <!-- Student	=>	SIJ-924 Miss. Isatou Jallow -->
	 @extends("Layout/assetCreateLayout")
@section('createAsset')
	 <section class="centerIt">
		{{Form::open(['action'=>'AssetController@store','method'=>'POST'])}}
	 		<div class="c">
				<div class="form-row ">
					<div class="form-group col-lg-3">
						{{Form::Label('aName','Asset Name')}}
					</div>
					<div class="form-group col-lg-9">
						{{Form::Text('aName',"",['class'=>'form-control','placeholder'=>'Asset Name','required'])}}
					</div>	
				</div>
				<div class="form-row">
					<div class="form-group col-lg-3">
						{{Form::Label('aCost','Asset Cost')}}
					</div>
					<div class="form-group col-lg-9">
						{{Form::number('aCost',"",['class'=>'form-control','placeholder'=>'Asset Cost','required',"id"=>"aCost"])}}
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-lg-3">
						{{Form::Label('aUsagePeriod','Asset Usage Period')}}
					</div>
					<div class="form-group col-lg-9">
						{{Form::number('aUsagePeriod','',['class'=>'form-control','placeholder'=>'Asset Usage Period','required',"id"=>"aUPeriod"])}}
					</div>
				</div>
				<div class="form-row">
					<div class="from-group col-lg-3">
						{{Form::Label('rValue','Residual Value')}}
					</div>
					<div class="form-group col-lg-9">
						{{Form::number('rValue','',['class'=>'form-control','placeholder'=>'Residual Value','required',"id"=>"rValue"])}}
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-lg-3">
						{{Form::Label('bValue','Book Value')}}
					</div>
					<div class="form-group col-lg-9">
						{{Form::text('bValue','',['class'=>'form-control',"id"=>"bVal"] )}}
					</div>

				</div>
				<div class="form-row">
					<div class="form-group col-lg-3">
						{{Form::Label('mDepreciation','Monthly Depreciation')}}
					</div>
					<div class="form-group col-lg-9">
						{{Form::text('mDepreciation','',['class'=>'form-control',"id"=>"mDepreciation"])}}
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-lg-3">
						{{Form::Label('aStartDate','Asset Start Date')}}
					</div>
					<div class="form-group col-lg-9">
						{{Form::date("aStartDate","",['class'=>'form-control'])}}
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
					{{Form::text("uAssigned","",["class"=>"form-control",'placeholder'=>'User Assingned'])}}
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
			<div class="form-row">
	 			<div class="form-group col-lg-3">
	 				{{Form::Label("aType","Asset Type")}}
				</div>
				<div class="form-group col-lg-9">
					{{Form::Select("aType",["Type 1","Type 2","Type 3","Type 4"],"S",["class"=>"form-control","width"=>"100"])}}
				</div>
			</div>
			<div class="form-row">
	 			<div class="form-group col-lg-3">
	 				{{Form::Label("aLocation","Asset Location")}}
				 </div>
				 <div class="form-group col-lg-9">
					 {{Form::Select("aLocation",$assetLocation,"SS",["class"=>"form-control"])}}
				 </div>
			</div>
			<div class="form-row">
				 <div class="form-group col-lg-3">
					 {{Form::Label("aDescription","Asset Description")}}
				 </div>
				 <div class="form-group col-lg-9">
	 				{{Form::textarea("aDescription","",["class"=>"form-control","placeholder"=>"Asset Description","required",'rows'=>'4'])}}
				 </div>
			</div>
			<div class="form-row">
				<div class="form-group col-lg-3">
	 				{{Form::Label("bCode","Barcode")}}
				</div>
				<div class="form-group col-lg-9">
	 				{{Form::text("bCode","",["class"=>"form-control","readonly","id"=>"bCode"])}}
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-lg-3">
					{{Form::Label("aDep","Asset Department")}}
				</div>
				<div class="form-group col-lg-9">
					{{Form::Select("aDep",$depName,"",["id"=>"department","class"=>"form-control"])}}
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-lg-3">
					{{Form::Label("aUnit","Asset's Unit")}}
				</div>
				<div class="form-group col-lg-9">
					{{Form::Select("aUnit",[],"",["id"=>"aUnit","class"=>"form-control"])}}
					{{Form::Text('unitId',"",["id"=>"unitId","hidden"])}}
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

