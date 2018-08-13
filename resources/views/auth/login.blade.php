@extends('layouts.app')

@section('title')
    SignUp
@endsection

@section('styles')

    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <link rel="stylesheet" href="/css_register/style.css">
  <style type="text/css">
.form .h1 {
  font-weight: 100;
  margin: 0;
}

.form .btn {
  background-color: #8E8E8E;
  border: 0;
  border-radius: 3px;
  color: #FFF;
  cursor: pointer;
  box-shadow: 2px 2px 2px #111;
  width: 100%;
  height: 40px;
  text-align: left;
  position: relative;
  padding: 0;
  margin: 10px 0;
}

.form .btn span {
  font-size: 16px;
  line-height: 40px;
}

.form .btn:active {
  top: 1px;
  box-shadow: 1px 1px 2px #000;
}

.form .btn i {
  margin-right: 10px
}

.form .facebook {
  background-color: #3B5998;
}

.form .facebook i {
  float: left;
  width: 44px;
  height: 40px;
  background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAoCAYAAACFFRgXAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAN1JREFUeNpi/P//P8NQAoyjDh518KiDRx086uBh62AtIOZE4r8A4qcUmwpyMJWxKxA//I8J2qlhPguVQ9UMiLcAMRutoo2Jyub10tKxtEjDb4FYCIn/C4jXA/FHIN4BZQ8qB38AYn4k/kQgLhjMSQIdfB/saXhIlMMGQDwHic2MJHcBiE8h8ZsoLYup4WAbID5MhLq/QMxLaTKhZ5K4SY00TU8HX6CKKVSulh/SojpGxkOulBh18KiDRx086uDRxg9eoIvW46BOx3O0mz/q4FEHjzp41MGjDiYXAAQYAJmVcB6iaE2HAAAAAElFTkSuQmCC") no-repeat center center;
}

.form .twitter {
  background-color: #1CB5E8;
}

.form .twitter i {
  float: left;
  width: 44px;
  height: 40px;
  background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAoCAYAAACFFRgXAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAi5JREFUeNrs2M1LVFEYx3GvDoWvEKSMhhqBSrhQjCwXRuDKjbVoIYgQbVy0CXduWgT+BS5cSgUJvdmmVb4giIHRSpTEUjcGLnwtDUy7fQ88wnVQ5zlzzyyE88AHFY7n/uaZc+85M0EYhjnnqXJzzln5wD6wD+wD+8DWdRV9+IxFfMRDFETGFKFBNZvZ6ZTuotFivHELX/EvPF4HeIU6tGEEzzRzai9chHG5eJXyf2qwEJ5dO/JzCmWaebVLogQVaMJ7NKcZn4cnqE0zrhjbWECvyzUcSAhTN/ABj3HhlPGluK+c26zlLqy5XMMlGE15O826nEYnLiOIjK89Yd2eVht4oL0vEsou7OAN2lK63iLm8Akz+IFL+HvGOxCtbxjXPnISFuNe4yYeSdho1QtTm/gdWUKaynP9HE5iQH5fTzPWdLfSIsRP7Lru8B6uy1Pi0PHG8l3md9rhDby0ffs09zzms7U1v8A7x91dli07K4FNl3vQj1XpTtyalCWRtcOPWWtLcqG9mGHNo/K57QtPWF5kH/fQ4aC7I/LCLVe93enLqMaXMF4tWRyiMjqtnRR6EKv4Yxl2C+0ZXjfjwEeuYdgi7C664lxTOzA35e+kHLzfYl8Zdg3dMRukvunuoBX5svU2y66nrTE8xXTcO1Ub2Oz3F+WzWLnF/BMYkvPzLxc7TWD57WVSDvCm47dxBYXyPD+QUCvSSRN2Flsut8bAf93qA/vAPrAP7APb1H8BBgDZp0G+vm9PBgAAAABJRU5ErkJggg==") no-repeat center center;
}

.form .plus {
  padding-left: 54px;
  background-color: #393838;
}

.form .plus .i {
  border-radius: 3px;
  position: absolute;
  border-top: 8px solid #D64335;
  width: 44px;
  top: 0;
  bottom: 0;
  left: 0;
  margin-left: 0;
  border-right: 1px solid #343434;
  line-height: 26px;
}

.form .plus i:before {
  content: "g";
  font: 26px "Palatino Linotype", Georgia, serif;
  text-shadow: 1px 1px 1px #444;
  line-height: 0px;
  margin-left: 10px;
}

.form .plus i:after {
  content: "+";
  border-left: 11px solid #426AAD;
  background-color: #32A45E;
  border-right: 11px solid #F8CA32;
  width: 11px;
  font: 18px "Palatino Linotype", Georgia, serif;
  line-height: 38px;
  position: absolute;
  top: -8px;
  left: 12px;
  height: 8px;
}

      </style>

@endsection

@section('content')
 
<div class="field-wrap">
         
</div>
  </div>
     <div class="form" >
      <h1 > welcome back ! </h2>
    <ul class="tab-group">
       <div class="col right">
           <a href="/login/facebook" class="btn facebook" data-provider="facebook"><i></i><span>Facebook</span></a>
            <a href="/login/twitter" class="btn twitter" data-provider="twitter"><i></i><span>Twitter</span></a>
            <a href="/login/google" class="btn plus" data-provider="google plus"><span class="i"><i></i></span><span>Google Plus</span></a>
        </div>
    </ul>

    <div class="tab-content" >
      <ul class="tab-group" >
        <li class="tab" ><a href="#login">Log in using Email.. </a></li>
      </ul>
        
      <div id="login" class="text-center">   
        <form  method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

          <div class="field-wrap">
            <label>
              Email Address<span class="req">*</span>
            </label>
            <input name="email" type="email" required autocomplete="off"/>

              @if($errors->has('email'))
                   
                        @foreach($errors->get('email') as $error)
                             <span id="email-error" class="form-text text-danger">
                                * {{$error}}
                             </span>
                        @endforeach
                   
              @endif
          </div>
          
          <div class="field-wrap">
            <label>
              Password<span class="req">*</span>
            </label>
            <input name="password" type="password" required autocomplete="off"/>
              @if($errors->has('password'))
                   
                        @foreach($errors->get('password') as $error)
                             <span id="password-error" class="form-text text-danger">
                                * {{$error}}
                             </span>
                        @endforeach
                   
              @endif
          </div>
          
           <p class="forgot"><a href="#">Forgot Password?</a></p>
            <button class="button button-block"/>Log In</button>
         </form>

      </div>
    </div><!-- tab-content -->
  </div> <!-- /form -->
  

@endsection


@section('scripts')
    
      <script  src="/js_register/index.js"></script>
@endsection

