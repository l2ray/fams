@extends("Layout/appLayout")
@section('content')
    <section class="container tableCenter">
        <a href="/instdepartment/create" class="btn btn-success btn-block">Add Department</a>
        <table class="table-bordered table">
            <tr>
                <th>Depatment Name</th>
                <th>Action</th>
            </tr>
        @for($x = 0; $x < count($assetDepartment); $x++)
            <tr>
                <td>{{$assetDepartment[$x] -> depName}}</td>
                <td>
                    <a href="/instdepartment/{{$assetDepartment[$x] -> id}}/edit" class="btn btn-primary">Modify</a>
                    @php
                        $id = $assetDepartment[$x] -> id;
                    @endphp
                    {{Form::open(["url"=>"/instdepartment/".$id,"style"=>"display:inline;"])}}
                        {{Form::hidden("_method","DELETE")}}
                        {{Form::submit("DELETE",["class"=>"btn btn-danger"])}}
                    {{Form::close()}}
                </td>
            </tr>
        @endfor

        </table>
    </section>
@endsection
