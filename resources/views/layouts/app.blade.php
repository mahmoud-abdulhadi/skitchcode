<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}') </title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/master.css')}}">
     <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/atom-one-dark.min.css">

    
  
   


     <script>
      
      window.App = {!!
          json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check()
            ])

        !!}; 
    </script>

        @yield('styles')
</head>
<body style="padding-top:100px;">
    <div id="app">
   
       @include('layouts.includes.nav')
        <div class="container-fluid">
          
        @yield('content')
        
        
        </div>
        

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>



     
      $('#create-button').click(function(){

           
           $('#create-dropdown').slideToggle();


         

      });

      $('#manage-button').click(function(){


        $('#manage-menu').slideToggle();
      });

      $('#notification-button').click(function(){

          $('#notification-dropdown').slideToggle();



      });
      $('#avatar-button').click(function(){

          $('#user-dropdown').slideToggle();



      });

   
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    @yield('scripts')
</body>
</html>
