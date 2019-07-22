@extends("Layout/appLayout")
@section('content')


    <div class="centerIt">
        
    <div class="form-row">
        <div class="form-group col-md-12">

            {{Form::model($instDepartmentToUpdate, array('route' => array('instdepartment.update', $instDepartmentToUpdate->id), 'method' => 'PUT'))}}
            {!!Form::text("instDepartmentToUpdate",$instDepartmentToUpdate -> depName,['required','class'=>'form-control','placeholder'=>''])!!}
            
        </div>

        {!!Form::submit("Update",['class'=>'btn btn-block btn-outline-success col-md-12'])!!}
         
        

    </div>
{!!Form::close()!!}
    </div>

@endsection

