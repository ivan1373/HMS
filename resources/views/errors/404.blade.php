<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Stranica ne postoji</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}" defer></script>
  <style>
  body {
      font: 20px 'Playfair Display', serif;
      line-height: 1.8;
      color: #f5f6f7;
  }
  p {font-size: 16px;}
  .margin {margin-bottom: 45px;}
  .bg-1 { 
      background-color: #36AC96; /* Green */
      color: #ffffff;
  }
  .bg-2 { 
      background-color: #474e5d; /* Dark Blue */
      color: #ffffff;
  }
  
  .container-fluid {
      padding-top: 70px;
      padding-bottom: 70px;
  }
  
  
  </style>
</head>
<body>



<!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <h1 class="margin">GREŠKA 404</h1>
  <img src="{{url('images/error.png')}}" class="img-responsive img-circle margin" style="display:inline" alt="Bird" width="350" height="350">
  <h3>Stranica ne postoji</h3>
</div>

<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  <h3 class="margin">Šta možete učiniti?</h3>
  <p>Vratite se na početnu stranicu</p>
  <a href="{{url('')}}" class="btn btn-primary btn-lg">
     Home <i class="fa fa-home"></i>
  </a>
</div>

</body>
</html>
