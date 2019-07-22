<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode</title>
            <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
</head>
<body>
    <div class="row">
      
    @foreach($products as $p)
        <div class="col-md-4">
            <div>
                <img src="data:image/png,' . {{DNS1D::getBarcodePNG("4", "C39+")}} . '" alt="barcode"   />';
                
            </div>
        </div>
    @endforeach
    </div>
    
</body>
</html>