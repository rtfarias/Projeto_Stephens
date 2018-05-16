

<!DOCTYPE html>
<html>
   <head class="content-header">
       <meta charset="utf-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <title>Stephen Viagens | Autenticação</title>
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

       <!-- jQuery 2.2.3 -->
       <script src="{{ url('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>

       <!-- alertUtil.js -->
       <script src="{{ url('js/admin/alertUtil.js') }}"></script>

       <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
       <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
       <!--[if lt IE 9]>
       <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
       <![endif]-->
   </head>
   <body class="hold-transition login-page">
       <div class="carregando"></div>
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

          <div class="register-box">
       <div class="login-logo">
           <a href="{{ url('admin') }}"><b>Stephen Viagens</b></a>
       </div>
       <div class="panel panel-default">
           <div class="panel-heading">
               <h3 class="panel-title">Alteração de Senha</h3>
           </div>
           <div class="panel-body">
               <form class="" action="{{ url('password/reset/'.$token) }}" method="post">


                   <fieldset>

                       @if (session()->has('flash_message'))
                       <div class="alert alert-success">
                           {{ session()->get('flash_message') }}
                       </div>
                       @endif

                       @if (session()->has('error_message'))
                       <div class="alert alert-daner">
                           {{ session()->get('error_message') }}
                       </div>
                       @endif

                       <!-- Email field -->
                       <div class="form-group">
                           {!! Form::text('email', null, ['placeholder' => 'E-mail', 'class' => 'form-control', 'required' => 'required'])!!}
                           {!! errors_for('email', $errors) !!}
                       </div>

                       <!-- Password field -->
                       <div class="form-group">
                           {!! Form::password('password', ['placeholder' => 'Senha','class' => 'form-control', 'required' => 'required'])!!}
                           {!! errors_for('password', $errors) !!}
                       </div>

                       <!-- Password confirmation field -->
                       <div class="form-group">
                           {!! Form::password('password_confirmation', ['placeholder' => 'Confirmação de senha','class' => 'form-control', 'required' => 'required'])!!}
                           {!! errors_for('password', $errors) !!}
                       </div>

                       <!-- Hidden Token field -->
                       {!! Form::hidden('token', $token )!!}


                       <!-- Submit field -->
                       <div class="form-group">
                           {!! Form::submit('Alterar Senha', ['class' => 'btn btn btn-lg btn-primary btn-block']) !!}
                       </div>
                   </fieldset>
               </form>
           </div>
       </div>
   </div>


       <!-- Bootstrap 3.3.6 -->
       <script src="{{ url('js/admin/bootstrap.min.js') }}"></script>
       <!-- iCheck -->
       <script src="{{ url('plugins/iCheck/icheck.min.js') }}"></script>
       <script src="{{ url('js/admin/jquery.maskedinput.js') }}"></script>
       <script src="{{ url('plugins/input-mask/jquery.inputmask.js') }}"></script>
       <script src="{{ url('plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
       <script src="{{ url('plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
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


