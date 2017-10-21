<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Sidang Tugas Akhir</title>

	<!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">


    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/business-casual.css')}}" rel="stylesheet">

  </head>

  <body>
	<div id="app">
	    <div class="tagline-upper text-center text-heading text-shadow text-white mt-5 d-none d-lg-block">Penjadwalan Sidang Tugas Akhir</div>
	    <div class="tagline-lower text-center text-expanded text-shadow text-uppercase text-white mb-5 d-none d-lg-block">Universitas Surabaya</div>

	    <!-- Navigation -->
	    <nav class="navbar navbar-expand-lg navbar-light bg-faded py-lg-4">
	    	<div class="container">
	        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Penjadwalan Sidang TA</a>
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	          	<span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" id="navbarResponsive">
	        	<ul class="navbar-nav mx-auto">
		            <li class="nav-item active px-lg-4">
		              	<a class="nav-link text-uppercase text-expanded" href="index.html">Jadwal Sidang TA
		                	<span class="sr-only">(current)</span>
		              	</a>
		            </li>
		            <li class="nav-item px-lg-4">
		              	<a class="nav-link text-uppercase text-expanded" href="about.html">Master Mahasiswa</a>
		            </li>
		            <li class="nav-item px-lg-4">
		              	<a class="nav-link text-uppercase text-expanded" href="blog.html">Master Dosen</a>
		            </li>
		            <li class="nav-item px-lg-4">
		              	<a class="nav-link text-uppercase text-expanded" href="contact.html">Master Periode</a>
		            </li>
					<li class="nav-item px-lg-4">
		              	<a class="nav-link text-uppercase text-expanded" href="contact.html">Master Tempat</a>
		            </li>
	          	</ul>
				<!-- Right Side Of Navbar -->
				<ul class="nav navbar-nav navbar-right">
				  	<!-- Authentication Links -->
				  	@guest
					  	<li><a href="{{ route('login') }}">Login</a></li>
				  	@else
						<li class="dropdown">
						  	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							  	{{ Auth::user()->name }} <span class="caret"></span>
						  	</a>

							<ul class="dropdown-menu" role="menu">
							  	<li>
								  	<a href="{{ route('logout') }}"
									  onclick="event.preventDefault();
											   document.getElementById('logout-form').submit();">
									  	Logout
								  	</a>

								  	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
									  	{{ csrf_field() }}
								  	</form>
							  </li>
						  </ul>
					  </li>
				  @endguest
			  </ul>
	        </div>
	      </div>
	    </nav>

		@yield('content')

	    <footer class="bg-faded text-center py-5">
	      <div class="container">
	        <p class="m-0">Copyright &copy; Sidang TA Ubaya</p>
	      </div>
	    </footer>
	</div>

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/popper/popper.min.js')}}"></script>
    <script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>

  </body>

</html>
