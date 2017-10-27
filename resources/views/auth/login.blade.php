@extends('layouts.app')

@section('content')
<div class="login-box">
	<div class="login-logo">
		<img class="center-block" src="{{asset('image/ubaya.png')}}" height="150">
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<p class="login-box-msg">Silahkan login terlebih dahulu</p>
		<form method="POST" action="{{ route('login') }}">
			{{ csrf_field() }}

			<div class="form-group has-feedback{{ $errors->has('username') ? ' has-error' : '' }}">
		  	    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>
		  	    <span class="glyphicon glyphicon-user form-control-feedback"></span>
				@if ($errors->has('username'))
					<span class="help-block">
						<strong>{{ $errors->first('username') }}</strong>
					</span>
				@endif
	  	  	</div>
			<div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
		  	    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
		  	    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
				@if ($errors->has('password'))
					<span class="help-block">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
	  	  	</div>

			<div class="row">
				<div class="col-xs-8">
				  	<div class="checkbox icheck">
				    	<label>
				      		<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
				    	</label>
				  	</div>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<button type="submit" class="btn btn-primary btn-block btn-flat">
						Login
					</button>
				</div>
				<!-- /.col -->
			</div>
		</form>
	</div>
	<!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection
