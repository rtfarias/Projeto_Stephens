<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="{{ (Sentinel::getUser()->thumbnail_principal != '') ? 'uploads/users/'.$id_condominio.'/'.Sentinel::getUser()->thumbnail_principal : 'img/logo.jpg' }}" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p>{{ Sentinel::getUser()->first_name }}</p>
				<!--a href="#"><i class="fa fa-circle text-success"></i> Online</a-->
			</div>
		</div>
		<!-- search form -->
		<form action="{{ url('admin/busca') }}" method="get" class="sidebar-form">
			<div class="input-group">
				<input type="text" name="q" class="form-control" placeholder="Busca...">
				<span class="input-group-btn">
					<button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
					</button>
				</span>
			</div>
		</form>
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">MENU DE NAVEGAÇÃO</li>
			<li>
				<a href="{{ url('/admin') }}">
					<i class="fa fa-files-o"></i>
					<span>Dashboard</span>
					<span class="pull-right-container">
						<!--<span class="label label-primary pull-right">4</span>-->
					</span>
				</a>
			</li>

			<?php foreach($modulos as $modulo){ ?>
				<?php if($current_role->hasAccess($modulo->nome_tabela.'.view')){ ?>
					<li><a href="{{ url('admin/'.$modulo->rota) }}"><i class="fa <?php echo $modulo->icone; ?>"></i><?php echo $modulo->label; ?></a></li>
				<?php } ?>
			<?php } ?>


		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
