<div class="row">
<div class="col-lg-4">
<div class="row">
<div class="col-lg-1 col-md-3 col-sm-8">
UserName:
</div>
<div class="col-lg-5 col-md-9 col-sm-8">
{!!Form::text("userName", "", ['class'=>'form-control','placeholder'=>'User Name','required'])!!}

</div>
</div>
<br/>

<div class="row">
<div class="col-lg-1 col-md-3">
Password:
</div>
<div class="col-lg-5 col-md-9 col-sm-1">

{!! Form::password("pwd",['class'=>'form-control','placeholder'=>'Password','required']) !!}

</div>

</div>
<br />
<div class="row">
<div class="col-lg-1 col-md-3 col-sm-1">

</div>
<div class="col-lg-5 col-md-9 col-sm-1">
{!! Form::submit('Log In', ['class'=>'btn btn-primary btn-lg btn-block']) !!}
</div>
</div>
</div>
<div class="col-lg-3">
<div id="image">

<img src="{{asset('images/slogin.png')}}" id="loginIcon" />
</div>
</div>
</div>