@extends("Layout/appLayout")
@section('content')

<section>

    <div class="container tableCenter">
        <a href="/user/create" class="btn btn-block btn-success">Add User</a>
        <table class="table table-bordered">
            <tr>
                <th>
                    Name
                </th>
                <th>
                    User Name
                </th>
                <th>
                    Email
                </th>
                <th>
                    Status
                </th>
                <th>
                    Action
                </th>
            </tr>
                @foreach($l as $b)
                <tr>
                    <td>
                    {{$b->name}}
                    </td>
                    <td>
                        {{ $b -> login}}
                    </td>
                    <td>
                        {{$b -> email}}
                    </td>
                    <td>
                        @if($b -> active == 1)
                            Active
                        @else
                            Not Active
                        @endif
                    </td>
		    <td>
			@php
				$id = $b->id;
			@endphp
			<a href="/user/{{$b->id}}/edit" class="btn btn-primary">Modify</a>
	{{Form::open(['url'=>'/user/'.$b->id,'style'=>'display:inline'])}}

{{Form::hidden('_method','DELETE')}}
{{Form::submit('Delete',['class'=>'btn btn-danger'])}}

{{Form::close()}}
                    </td>
                </tr>
            @endforeach
        </table>

    </div>
</section>

@endsection
