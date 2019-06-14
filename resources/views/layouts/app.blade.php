<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shop Homepage - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="{{URL::asset('css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="{{asset('css/shop-homepage.css')}}" rel="stylesheet" type="text/css">
  <link href="{{asset('/css/style.css')}}" rel="stylesheet">

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('/js/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('/js/jquery/jquery.zoom.min.js')}}"></script>
  <script src="{{asset('/js/bootstrap.bundle.min.js')}}"></script>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{url('/')}}">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/')}}/about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/')}}/contact_us">Contact</a>
          </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          @if(Auth::check())
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <span class="glyphicon-user"></span> Logout
            </a>            
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#"><span class="glyphicon-user"></span> {{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}
            </a>                        
          </li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/login') }}">
            <span class="glyphicon-user"></span> Login
            </a>            
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/register') }}">
            <span class="glyphicon-user"></span> Register
            </a>            
          </li>
          @endif          
        </ul>

      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">


   @yield('content')

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  

</body>

</html>