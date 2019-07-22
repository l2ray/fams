@extends("Layout/appLayout")
@section('content')


    <div class="centerIt">
        
    <div class="form-row">
        <div class="form-group col-md-12">

            {{Form::model($unitList, array('route' => array('departmentunit.update', $unitList->id), 'method' => 'PUT'))}}
            {!!Form::text("instDepartmentUnitToUpdate",$unitList -> unitName,['required','class'=>'form-control','placeholder'=>''])!!}
            
        </div>
                    <div class="form-row ">
                <div class="form-group col-lg-2">
                    {{Form::Label("depId","Department")}}
                </div>
                <div class="form-group col-lg-10">
                    {!!Form::Select("depId",$depList,'S',['class'=>'form-control'])!!}
                </div>
</div>

        {!!Form::submit("Update",['class'=>'btn btn-block btn-outline-success col-md-12'])!!}
         
        

    </div>
{!!Form::close()!!}
    </div>

@endsection