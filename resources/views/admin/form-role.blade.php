@extends($current_template)

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo (isset($role)) ? 'Editar' : 'Criar'; ?>
			<small>Informações Grupo</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="{{ url('/admin/roles') }}">Grupos</a></li>
			<li class="active"><?php echo (isset($role)) ? 'Editar' : 'Criar'; ?></li>
		</ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-lg-12">
				<div class="box">
					<div class="box-header">

					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<ul class="nav nav-pills nav-justified">
							<li class="active"><a data-toggle="pill" href="#info-tab">Informações</a></li>
							<li class=""><a data-toggle="pill" href="#permissions-tab">Permissões</a></li>
						</ul>
						<div class="spacer"></div>
						<form id="mainForm" class="form-horizontal" role="form" method="POST" action="{{ url('/admin/roles/save') }}">
						<div class="tab-content">

								<div id="info-tab" class="tab-pane fade in active">
									{{ csrf_field() }}
									<?php if(isset($role)){ ?>
										<input type="hidden" name="id" value="<?php echo $role->id; ?>"/>
									<?php } ?>

									<div class="form-group">
										<label for="name" class="col-md-3 control-label">Nome</label>

										<div class="col-md-7">
											<input id="name" type="text" class="form-control" value="<?php echo (isset($role)) ? $role->name : ''; ?>" name="name" />
										</div>
									</div>

									<div class="form-group">
										<label for="slug" class="col-md-3 control-label">Slug</label>

										<div class="col-md-7">
											<input id="slug" type="text" class="form-control" value="<?php echo (isset($role)) ? $role->slug : ''; ?>" name="slug" />
										</div>
									</div>
								</div>
								<div id="permissions-tab" class="tab-pane fade">
									<?php foreach ($modulos as $modulo): ?>
										<div class="col-md-4">
											<div class="box box-primary">
								            <div class="box-header with-border">
								              <h3 class="box-title"><?php echo $modulo->label; ?></h3>

								              <div class="box-tools pull-right">
								                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								                </button>
								                <input type="checkbox" name="all_permissions">
								              </div>
								            </div>
								            <!-- /.box-header -->
								            <div class="box-body" style="display: block;">
								              <div class="table-responsive">
								                <table class="table no-margin">
								                  <thead>
								                  <tr>
								                    <th class="text-center"><label for="<?php echo $modulo->nome_tabela.'-view'; ?>">Ver</label></th>
								                    <th class="text-center"><label for="<?php echo $modulo->nome_tabela.'-create'; ?>">Criar</label></th>
								                    <th class="text-center"><label for="<?php echo $modulo->nome_tabela.'-update'; ?>">Atualizar</label></th>
								                    <th class="text-center"><label for="<?php echo $modulo->nome_tabela.'-delete'; ?>">Deletar</label></th>
								                  </tr>
								                  </thead>
								                  <tbody>
								                  <tr>
								                    <td class="text-center"><input id="<?php echo $modulo->nome_tabela.'-view'; ?>" <?php echo (isset($roleSentinel) && $roleSentinel->hasAccess($modulo->nome_tabela.'.view')) ? 'checked' : ''; ?> type="checkbox" name="permission[]" value="<?php echo $modulo->nome_tabela; ?>.view"/></td>
								                    <td class="text-center"><input id="<?php echo $modulo->nome_tabela.'-create'; ?>" <?php echo (isset($roleSentinel) && $roleSentinel->hasAccess($modulo->nome_tabela.'.create')) ? 'checked' : ''; ?> type="checkbox" name="permission[]" value="<?php echo $modulo->nome_tabela; ?>.create"/></td>
								                    <td class="text-center"><input id="<?php echo $modulo->nome_tabela.'-update'; ?>" <?php echo (isset($roleSentinel) && $roleSentinel->hasAccess($modulo->nome_tabela.'.update')) ? 'checked' : ''; ?> type="checkbox" name="permission[]" value="<?php echo $modulo->nome_tabela; ?>.update"/></td>
								                    <td class="text-center"><input id="<?php echo $modulo->nome_tabela.'-delete'; ?>" <?php echo (isset($roleSentinel) && $roleSentinel->hasAccess($modulo->nome_tabela.'.delete')) ? 'checked' : ''; ?> type="checkbox" name="permission[]" value="<?php echo $modulo->nome_tabela; ?>.delete"/></td>
								                  </tr>
								                  </tbody>
								                </table>
								              </div>
								              <!-- /.table-responsive -->
								            </div>
								            <!-- /.box-body -->
								          </div>
										</div>
									<?php endforeach; ?>
								</div>
							</form>
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<div class="text-center">
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-btn fa-pencil"></i> Salvar
							</button>
						</div>
					</div>
				</div>
					<!-- /.box -->
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">
	$('[name="all_permissions"]').click(function(){
		if($(this).is(':checked')){
			var aux = true;
		}else{
			var aux = false;
		}
		$(this).closest('.box').find('[name="permission[]"]').prop('checked', aux);
	});

	$('[name="permission[]"]').change(function(){
		var $box = $(this).closest('.box');
		var flag = true;
		$box.find('[name="permission[]"]').each(function(){
			flag = flag && $(this).is(':checked');
		});
		$box.find('[name="all_permissions"]').prop('checked', flag);
	});
	$('[name="permission[]"]').trigger('change');
</script>
@endsection
