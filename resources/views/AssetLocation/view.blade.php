@extends('Layout/appLayout')
@section('content')

<section>
    <div class="container tableCenter">
        <a href="/assetlocation/create" class="btn btn-block btn-success">Add Location</a>
        <table class="table table-bordered">
            <tr>
                <th>
                    Location Name
                </th>
                <th>
                    Location Address
                </th>
                <th>
                    Action
                </th>
            </tr>

            @foreach($ll as $key=> $value)
            @php
                $x = explode(":",$key);
            @endphp
                <tr>
                    <td>
                        {{$x[1]}}
                    </td>
                    <td>
                        {{$value}}
                    </td>
                    <td>
                        <a href="/assetlocation/{{$x[0]}}/edit" class="btn btn-primary" >Modify</a>
                        {{Form::open(['url'=>'/assetlocation/'.$x[0],'style'=>'display:inline'])}}
                        {{Form::hidden('_method','DELETE')}}
                        {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                        {{Form::close()}}
                    </td>
                </tr>
            @endforeach
        </table>
        {{$location->links()}}
    </div>
</section>
@endsection