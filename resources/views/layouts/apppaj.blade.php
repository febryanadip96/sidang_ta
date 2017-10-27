<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css') }}">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="{{asset('dist/css/skins/skin-red.min.css') }}">
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
<body class="hold-transition skin-red layout-top-nav">
	<div id="app">
		<div class="wrapper">
		  <header class="main-header">
		    <nav class="navbar navbar-static-top">
		      <div class="container">
		        <div class="navbar-header">
		          <a class="navbar-brand">Penjadwalan Sidang Tugas Akhir</a>
		          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
		            <i class="fa fa-bars"></i>
		          </button>
		        </div>

		        <!-- Collect the nav links, forms, and other content for toggling -->
		        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
		          	<ul class="nav navbar-nav">
			            <li><a href="{{ url('paj/jadwalsidang') }}">Jadwal Sidang TA</a></li>
			            <li><a href="{{ url('paj/mastermahasiswa') }}">Master Mahasiswa</a></li>
			            <li><a href="{{ url('paj/masterdosen') }}">Master Dosen</a></li>
			            <li><a href="{{ url('paj/masterperiode') }}">Master Periode</a></li>
			            <li><a href="{{ url('paj/mastertempat') }}">Master Tempat</a></li>
		          	</ul>
		        </div>
		        <!-- /.navbar-collapse -->
		        <!-- Navbar Right Menu -->
		        <div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
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
										<a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
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
		        <!-- /.navbar-custom-menu -->
		      </div>
		      <!-- /.container-fluid -->
		    </nav>
		  </header>
		  <!-- Full Width Column -->
		  <div class="content-wrapper">
		    <div class="container">
				@yield('content')

		    </div>
		    <!-- /.container -->
		  </div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				<div class="container">
				  <strong>Copyright &copy; Ubaya
				</div>
				<!-- /.container -->
			</footer>
		</div>
		<!-- ./wrapper -->
	</div>

	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}"></script>
	<!-- SlimScroll -->
	<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
	<script>
		$(function () {
			//Initialize Select2 Elements
		    $('.select2').select2();
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
			$('.alert').slideDown(500, function(){
			  	setTimeout(function(){
			      	$(".alert").slideUp(500);
			  	},5000);
			});
		});
	</script>
</body>
</html>
