@foreach($OnlyImage as $img)
    <img src="data:image/png;base64,{{base64_encode($img)}}" width="100" height="50"/><br/><br/>
@endforeach

