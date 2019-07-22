<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
      
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/customStyles.css')}}" rel="stylesheet" type="text/css"/>
    </head>
    <body id="loginBackground">
         @include('inc/nav')
            @yield('createAsset') 
        <!-- <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script> -->
        <script src="{{asset('js/bootstrap.min.js')}}"></script>

   
    </body>

</html>