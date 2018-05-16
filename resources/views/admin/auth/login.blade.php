<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Stephens - Viagens </title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="{{ url('css/admin/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ url('css/admin/AdminLTE.min.css') }}">
	<!-- iCheck -->
	<link rel="stylesheet" href="{{ url('plugins/iCheck/square/blue.css') }}">

	<link rel="stylesheet" href="{{ url('css/admin/style.css') }}">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<!-- Content Wrapper. Contains page content -->
  @if(\Session::has('type') && \Session::has('message'))
    <div class="alerta alerta-{{ \Session::get('type') }}" id="alerta">
      <div class="wrap-icone">
        <i class="icone fa fa-exclamation"></i>
      </div>
      <div class="text">
        <span class="titulo">{{ \Session::get('message') }}</span>
        <span></span>
      </div>
      <a href="#" class="fecha-alerta"><i class="fa fa-times"></i></a>
    </div>
  @endif

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<img src="{{ url('img/logo.png') }}">
		</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<p class="login-box-msg">Faça seu login!</p>
			@if(Session::has('errors'))
				<h4>{{ Session::get('errors') }}</h4>
			@endif
			{!! Form::open(['route' => 'admin/login']) !!}
				{{ csrf_field() }}
				<div class="form-group has-feedback">
					<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
					@if ($errors->has('email'))
					<span class="help-block">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input id="password" type="password" class="form-control" name="password" required>
					@if ($errors->has('password'))
						<span class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-8">
						<div class="checkbox icheck">
							<label>
								<input type="checkbox" name="remember"> Lembrar-me
							</label>
						</div>
					</div>
					<!-- /.col -->
					<div class="col-xs-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
					</div>
					<!-- /.col -->
				</div>
			{!! Form::close() !!}
			<p><a href="{{ url('admin/register') }}" class="text-center">Registrar-se</a></p>
			<p><a href="{{ url('admin/forgot_password') }}">Esqueceu a Senha?</a></p>

		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 2.2.3 -->
	<script src="{{ url('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="{{ url('js/admin/bootstrap.min.js') }}"></script>
	<!-- iCheck -->
	<script src="{{ url('plugins/iCheck/icheck.min.js') }}"></script>
	<script>
	$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' // optional
		});
	});
	</script>
</body>
</html>
