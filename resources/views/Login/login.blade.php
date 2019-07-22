@extends('Layout/loginLayout')
@section('loginLayout')



                <div id="wrapper" class="container">
                    {!!Form::open(['action'=>'LoginController@store','method'=>'post'])!!}
                                <!-- <div class=" containers"> -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    UserName:
                                </div>
                                <div class="col-lg-9 col-md-12 col-sm-12">
                                    {!!Form::text("userName", "", ['class'=>'form-control','placeholder'=>'User Name','required'])!!}

                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-lg-3 col-md-12 col-sm-12">
                                    Password:
                                </div>
                                <div class="col-lg-9 col-md-12 col-sm-12">
                                    {!! Form::password("pwd",['class'=>'form-control','placeholder'=>'Password','required']) !!}
                                </div>

                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-lg-3 col-md-12 col-sm-12">

                                </div>
                                <div class="col-lg-9 col-md-12 col-sm-12">
                                    {!! Form::submit('Log In', ['class'=>'btn btn-primary btn-lg btn-block']) !!}
                                </div>
                            </div>
                            @if($errors->any())
                            <div>
                                <h4 style="text-align:center; color:red">{{$errors->first()}}</h4>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-4">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div id="image">
                                    <img src="{{asset('images/slogin.png')}}" id="loginIcon" />
                                </div>
                            </div>
                        </div>
                    </div>
                   
            <!-- </div> -->

                    {!!Form::close()!!}
                </div>
@endsection
            
    

            <!-- <script src="{{asset('js/collapse.js')}}"></script> -->
            <!-- <script src="{{asset('js/dropdown.js')}}"></script> -->
<!-- 
                            <div class="row">
                    <div class="col-lg-1 col-md-3 col-sm-8">
                            UserName:
                    </div>
                        <div class="col-lg-9 col-md-9 col-sm-8">
                            {!!Form::text("userName", "", ['class'=>'form-control','placeholder'=>'User Name','required'])!!}
                          
                        </div>
                </div>
                <br/>
 
                <div class="row">
                    <div class="col-lg-1 col-md-3">
                        Password:
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-1">
                         
                        {!! Form::password("pwd",['class'=>'form-control','placeholder'=>'Password','required']) !!}
                        
                    </div>
                    
                </div>
                <br />
                <div class="row">
                    <div class="col-lg-1 col-md-3 col-sm-1">
                        
                    </div>
                        <div class="col-lg-9 col-md-9 col-sm-1">
                            {!! Form::submit('Log In', ['class'=>'btn btn-primary btn-lg btn-block']) !!}
                        </div>
                    </div> -->