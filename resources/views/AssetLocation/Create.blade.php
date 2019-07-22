@extends("Layout/appLayout")
@section('content')


    <div class="centerIt">
        {!!Form::open(['action'=>'AssetLocationController@store','method'=>'POST'])!!}
    <div class="form-row">
        <div class="form-group col-md-12">
            {!!Form::label("locationName","Location Name",["class"=>"centerText"])!!}
            
            {!!Form::text("locationName","",['required','class'=>'form-control','placeholder'=>'Location Name'])!!}
            
        </div>
        <div class="form-group col-md-12">
            {!!Form::label("locationAddress","Location Address")!!}
            {!! Form::text("locationAddress","",['class'=>'form-control','placeholder'=>'Location Address','required'])!!}
        </div>
        {!!Form::submit("Submit",['class'=>'btn btn-block btn-outline-success col-md-12'])!!}
         
        

    </div>
{!!Form::close()!!}
    </div>

@endsection