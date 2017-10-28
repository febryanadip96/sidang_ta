<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css') }}">
	<!-- Select2 -->
    <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css') }}">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
	   folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="{{asset('dist/css/skins/skin-red.min.css') }}">
	<!-- Google Font -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	
	<!-- jQuery 3 -->
	<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<!-- InputMask -->
	<script src="{{ asset('plugins/input-mask/jquery.inputmask.js') }}"></script>
	<script src="{{ asset('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
	<script src="{{ asset('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
	<!-- SlimScroll -->
	<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
	<!-- Select2 -->
	<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
	<!-- iCheck -->
	<script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>

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
			            <li><a href="{{ url('/') }}">Daftar</a></li>
		          	</ul>
		        </div>
		        <!-- /.navbar-collapse -->
		        <!-- Navbar Right Menu -->
		        <div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li><a href="{{ route('login') }}">Login</a></li>
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
	<script>
		$(function () {
			//Initialize Select2 Elements
		    $('.select2').select2();
   	 		$('[data-mask]').inputmask()
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
			/*$('.alert').slideDown(500, function(){
			  	setTimeout(function(){
			      	$(".alert").slideUp(500);
			  	},5000);
			});*/
		});
	</script>
</body>
</html>
