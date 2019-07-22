@extends("Layout/appLayout")
@section("content")
<section >

    <div class="container tableCenter" >
        <a href="/departmentunit/create" class="btn btn-block btn-success">Add Department Unit</a>
        <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Unit Name</th>
      <th scope="col">Department Name</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($unitArr as $key=>$value)
    @php
        $x = explode(":",$key);
    @endphp
        <tr>
            <td scope="row">{{$x[1]}}</td>
            <td> {{$value}}</td>
            <td>
                <a href="/departmentunit/{{$x[0]}}/edit" class="btn btn-primary" >Modify</a>
                    {{ Form::open(array('url' => '/departmentunit/'.$x[0],'style'=>'display:inline;')) }}
                    {{ Form::hidden('_method', 'DELETE') }}
                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
            </td>
            <!-- <a href="/departmentunit/{{$x[0]}}" class="btn btn-danger">Modify</a></td> -->
        </tr>
    @endforeach

    
  </tbody>
</table>
    </div>
</section>
@endsection