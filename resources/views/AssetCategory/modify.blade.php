@extends("Layout/appLayout")
@section('content')


    <div class="centerIt">
        
    <div class="form-row">
        <div class="form-group col-md-12">

            {{Form::model($category, array('route' => array('assetcategory.update', $category->id), 'method' => 'PUT'))}}


            {!!Form::text("categoryName","$category->catName",['required','class'=>'form-control','placeholder'=>''])!!}
            
        </div>
        <div class="form-group col-md-12">
            {!!Form::label("categoryDescription","Category Description")!!}
            {!! Form::textarea("categoryDescription","$category->catDescription",['class'=>'form-control','placeholder'=>'','required','rows='>'3','cols'=>'5'])!!}
        </div>
        {!!Form::submit("Update",['class'=>'btn btn-block btn-outline-success col-md-12'])!!}
         
        

    </div>
{!!Form::close()!!}
    </div>

@endsection