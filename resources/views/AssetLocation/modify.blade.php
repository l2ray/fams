@extends("Layout/appLayout")
@section('content')


    <div class="centerIt">
        
    <div class="form-row">
        <div class="form-group col-md-12">

            {{Form::model($location, array('route' => array('assetlocation.update', $location->id), 'method' => 'PUT'))}}


            {!!Form::text("locationName","$location->locationName",['required','class'=>'form-control','placeholder'=>'Location Name'])!!}
            
        </div>
        <div class="form-group col-md-12">
            {!!Form::label("locationAddress","Location Address")!!}
            {!! Form::text("locationAddress","$location->locationAddress",['class'=>'form-control','placeholder'=>'Location Address','required'])!!}
        </div>
        {!!Form::submit("Update",['class'=>'btn btn-block btn-outline-success col-md-12'])!!}
         
        

    </div>
{!!Form::close()!!}
    </div>

@endsection