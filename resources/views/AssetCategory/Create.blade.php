@extends("Layout/appLayout")
@section('content')


    <div class="centerIt">
        {!!Form::open(['action'=>'AssetCategoryController@store','method'=>'POST'])!!}
    <div class="form-row">
        <div class="form-group col-md-12">
            {!!Form::label("categoryName","Category Name",["class"=>"centerText"])!!}
            
            {!!Form::text("categoryName","",['required','class'=>'form-control','placeholder'=>'Category Name'])!!}
            
        </div>

        <div class="form-group col-md-12">
            {!!Form::label("catDesc","Category Description")!!}
            {!! Form::textarea("catDesc","",['class'=>'form-control','placeholder'=>'Category Description','required','rows'=>3,'cols'=>10])!!}
        </div>
        <div class="form-group col-md-12">
            {!! Form::label("catTag","Category Tag") !!}
            {!!Form::select('catTag', $tags, 'S',['class'=>'form-control'])!!}
        </div>
        {!!Form::submit("Submit",['class'=>'btn btn-block btn-outline-success col-md-12'])!!}
         
        <!-- array('ABAAA' => 'ABAAA', 'ABCCB' => 'ABCCB','ACCCC' => 'ACCCC', 'ACCDD' => 'ACCDD','ADDDD' => 'ADDDD', 'ACDDD' => 'ACDDD') -->

    </div>
{!!Form::close()!!}
    </div>

@endsection