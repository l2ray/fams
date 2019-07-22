@extends("Layout/appLayout")
@section("content")
    <div class="centerIt col-lg-12 col-md-6 col-sm-8">
        {{Form::open(['action'=>'InstutionDepartmentController@store','method'=>'POST'])}}
           <div class="form-row ">
                <div class="form-group col-md-1 col-sm-12 col-lg-2">
                    {{Form::Label("depName","Department Name")}}
                </div>
            <div class="form-group col-md-6 col-sm-12 col-lg-10">
                {{Form::Text("depName","",['class'=>'form-control','required'])}}
            </div>
           </div>
           <div class="form-row">
                <div class="form-group col-md-1 col-sm-12 col-lg-2">
                    {{Form::Label(" "," ")}}
                </div>
                 
                <div class="form-group col-md-6 col-sm-12 col-lg-10" >
                  {{Form::submit("Submit",['class'=>'btn btn-block btn-primary'])}}
                </div>
           </div>
        {{Form::close()}}
    </div>
@endsection