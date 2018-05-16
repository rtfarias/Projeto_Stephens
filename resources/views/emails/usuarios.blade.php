<!DOCTYPE html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
	<title>E-mail Fala Vizinho</title>
</head>
<body>
	<link href="https://fonts.googleapis.com/css?family=Ubuntu:300,700" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<style>
		body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,p,blockquote,hr,th,td {
			margin:0;
			padding:0;
		}
		.clear {width: 100%; clear: both; display: block; height: 0px;}
		.container {width: 100%; position:relative; display: block; padding:10px; background: #F1F1F1; box-sizing:border-box;}
		.email {width: 100%; position:relative; display: block; padding:20px; background: #FFFFFF; border:1px solid #E1E1E1; box-sizing:border-box;}
		.center{
			text-align: center;
			margin-bottom:20px;
			font-size:16px;
			font-weight: 600;
		}
		.logo {width: 120px;}
		* {font-family: 'Ubuntu', sans-serif; font-weight: 300; color: #666666; line-height: 30px; font-size: 14px; letter-spacing: -0.3px;}
		h3 {margin-top: 25px;}
		.link {border: 1px solid #00A2D8; font-weight: 700; line-height: 24px; font-size:14px; color:#00A2D8; letter-spacing: -0.5px; display: inline-block; border-radius: 10px; padding: 10px 10px; margin-right: 10px; margin-bottom: 20px;}
		.link .fa {color:#00A2D8; font-size: 18px; line-height: 24px; margin-right: 5px;}
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}
		small {line-height: 18px; color: #999999; font-size: 11px; margin-top: 20px;}
		h3 {font-size: 24px; line-height: 42px; color: #00A2D8;}
		strong {font-weight: 700;}
		strong {color: #00A2D8;}
		td, th {
			border: 1px solid #dddddd;
			text-align: left;
			padding: 3px 10px;
		}

		tr:nth-child(even) {
			background-color: #EEEEEE;
		}
	</style>

	<div class="container">
		<div class="email">
			<img src="http://www.duoapp.com.br/falavizinho/logofalavizinho.png" class="logo"/>
			<div>
				<p>
					Olá, <strong><?php echo $nome_sindico ?></strong>, seja bem-vindo ao Fala, Vizinho!<br/>
					Seu código de condomínio, para fazer o login, é o <strong><?php echo $condominio->id; ?></strong>.<br/>
					Obrigado por cadastrar o <strong><?php echo $condominio->nome; ?></strong>.
				</p>
			</div>
			<div><h3>Usuários cadastrados</h3></div>
			<table>
				<?php foreach ($condominio->torres as $torre): ?>
					<tr>
						<th><strong>Torre <?php echo $torre->nome; ?></strong></th>
						<th><strong>Usuário / Senha</strong></th>
					</tr>
					<?php foreach ($torre->unidades as $unidade): ?>
						<?php foreach ($unidade->condominos as $condomino): ?>
							<tr>
								<td width="20%"><?php echo $torre->nome; ?></td>
								<td width="80%"><?php echo $condomino->user->email; ?><br/>
								Senha: <?php echo $arrayPasswords[$condomino->user->id]; ?></td>
							</tr>
						<?php endforeach; ?>
					<?php endforeach; ?>
				<?php endforeach; ?>
			</table>
			<div class="rodape">
				<h3>Download do aplicativo</h3>
				<a class="link">
					<i class="fa fa-apple"></i>Disponível na App Store
				</a>
				<a class="link">
					<i class="fa fa-android"></i>Disponível na Google Play
				</a>
				<br/>
				Obrigado por fazer parte da nossa comunidade. Sempre faremos o melhor para você e seu condomínio.<br/>
				<small>&copy; Fala, Vizinho | Todos os direitos reservados | contato@falavizinho.com.br | www.falavizinho.com.br</small>
			</div>
		</div>
	</div>

</body>
</html>
