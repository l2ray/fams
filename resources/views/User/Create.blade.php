@extends("Layout/appLayout")
@section("content")
    <div class="centerIt col-lg-12 col-md-6 col-sm-3">
        {{Form::open(['action'=>'UserController@store','method'=>'POST'])}}
            <div class="form-row">
                <div class="form-group col-lg-2">
                    {{Form::Label("uName","User Name")}}
                </div>
                <div class="form-group col-lg-10 col-md-5">
                    {{Form::Text("uName","",['class'=>'form-control',"placeholder" => "User Name"])}}
                </div>
            </div>
            <div class="form-row ">
                <div class="form-group col-lg-2">
                    {{Form::Label("password","Password")}}
                </div>
                <div class="form-group col-lg-10">
                    {!!Form::password("password",['class'=>'form-control','placeholder'=>'Password'])!!}
                </div>
            </div>
            <div class="form-row ">
                <div class="form-group col-lg-2">
                    {{Form::Label("conPassword","Confirm Password")}}
                </div>
                <div class="form-group col-lg-10">
                    {{Form::password("conPassword",['class'=>'form-control','placeholder'=>'Confirm Password'])}}
                </div>
            </div>

                        <div class="form-row">
                <div class="form-group col-lg-2">
                    {{Form::Label("email","Email")}}
                </div>
                <div class="form-group col-lg-10 col-md-5">
                    {{Form::email("email","",['class'=>'form-control'])}}
                </div>
            </div>
            <div class="form-row ">
                <div class="form-group col-lg-2">
                    {{Form::Label("fName","Name")}}
                </div>
                <div class="form-group col-lg-10">
                    {!!Form::Text("fName","",['class'=>'form-control'])!!}
                </div>
            </div>
                        <div class="form-row ">
                <div class="form-group col-lg-2">
                    {{Form::Label("pno","Contact Number")}}
                </div>
                <div class="form-group col-lg-10">
                    {!!Form::number("pno","",['class'=>'form-control'])!!}
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