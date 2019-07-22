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
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/customStyles.css')}}" rel="stylesheet" type="text/css"/>
    </head>
    <body id="loginBackground">
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <a class="navbar-brand" href="#">LOGO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Dropdown link
                </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
            </li>
        </ul>
    </div>
</nav>



                <div id="wrapper" class=" container">
                                <div class=" containers">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-8">
                            UserName:
                    </div>
                        <div class="col-lg-9 col-md-9 col-sm-8">
                            <input type="text" placeholder="User Name" required  style="width:100%;"/>
                        </div>
                </div>
                <br/>
 
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        Password:
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-1">
                        <input type="password" required placeholder="Password" style="width:100%;" />
                    </div>
                    
                </div>
                <br />
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-1">
                        
                    </div>
                        <div class="col-lg-9 col-md-9 col-sm-1">
                                <input type="Button" value="LOGIN" class="btn btn-primary btn-block" />
                        </div>
                    </div>
            </div>
                    <div id="image">

                    <img src="{{asset('images/slogin.png')}}" id="loginIcon" />
                    </div>
                </div>
            
    

            <!-- <script src="{{asset('js/collapse.js')}}"></script> -->
            <!-- <script src="{{asset('js/dropdown.js')}}"></script> -->
            <script src="{{asset('js/jquery-3.3.1.slim.min.js')}}"></script>
            <script src="{{asset('js/bootstrap.min.js')}}"></script>
   
    </body>
</html>
