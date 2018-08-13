<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

 
    <title>Discussion Section</title>
  
    <link rel="stylesheet" href="{{asset('css/mainthread.css')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">

    <link rel="stylesheet" href="https://bootswatch.com/3/paper/bootstrap.min.css">
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/atom-one-dark.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/css/selectize.min.css">

    <style type="text/css">

      body
      {
        background-color:#272727;
        
      }
      .navbar-inverse{
        background-color: black;
        font-weight: 900;
        position: fixed;
        top: 0;
        width: 100%;
      }

    
    </style>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @yield('styles')
</head>
<body >
<div id="app">
    
    

    <br><br>
    <br><br>
    
    <div class="container">

        

        

            <div class="row">
        
             
            

                <div class="col-md-9">
                    <div class="content-wrap ">
                        @yield('content')
                    </div>
                </div>
            </div>

    </div>
</div>



<script src="{{asset('js/app.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
 

</body>
</html>