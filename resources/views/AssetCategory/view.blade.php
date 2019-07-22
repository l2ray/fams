@extends('Layout/appLayout')
@section('content')
    <section class="container tableCenter">
        <a href="/assetcategory/create" class="btn btn-block btn-success">Add Asset Category</a>
        <table class="table table-bordered ">
            <tr>
                <th>Category Name</th>
                <th>Category Description</th>
                <th>Category Tag</th>
                <th>Action</th>
            </tr>
            @php
                $x = 0;
            @endphp
            @foreach($aCategory as $key => $value)
            @php 
                $catId = $assetCatId[$x];
            @endphp
                <tr>
                    <td>{{$key}}</td>
                    <td>{{$value}}</td>
                    <td>{{$catTag[$x]}}</td>
                    <td>
                        <a href="/assetcategory/{{$catId}}/edit" class="btn btn-primary"> Modify </a>

                        {{Form::open(["url"=>"/assetcategory/".$catId,"style"=>"display:inline;"])}}
                            {{Form::hidden("_method","DELETE")}}
                            {{Form::submit("Delete",["class"=>"btn btn-danger"])}}
                        {{Form::close()}}
                    </td>
                </tr>
                @php
                    $x++;

                @endphp
            @endforeach

        </table>
    </section>

@endsection