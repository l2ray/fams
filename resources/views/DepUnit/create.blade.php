@extends("Layout/appLayout")
@section("content")
    <div class="centerIt col-lg-12 col-md-6 col-sm-3">
        {{Form::open(['action'=>'DepartmentUnitController@store','method'=>'POST'])}}
            <div class="form-row">
                <div class="form-group col-lg-2">
                    {{Form::Label("uName","Unit Name")}}
                </div>
                <div class="form-group col-lg-10 col-md-5">
                    {{Form::Text("uName","",['class'=>'form-control'])}}
                </div>
            </div>
            <div class="form-row ">
                <div class="form-group col-lg-2">
                    {{Form::Label("depId","Department")}}
                </div>
                <div class="form-group col-lg-10">
                    {!!Form::Select("depId",$unitList,'S',['class'=>'form-control'])!!}
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-lg-2">
                    {{Form::Label(" "," ")}}
                </div>
                <div class="form-group col-lg-10">
                    {{Form::Submit("Submit",['class'=>"form-control btn btn-primary btn-block"])}}
                </div>
            </div>
        {{Form::close()}}
    </div>
@endsection