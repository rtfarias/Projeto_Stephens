@extends($current_template)

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Categorias
			<small>Listagem</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active">Categorias</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">

				<div class="box">
					<div class="box-header">
						<?php if($current_role->hasAccess($current_module->nome_tabela.'.create')){ ?>
							<a href="{{ url('admin/categorias/add') }}" class="table-add"><i class="fa fa-plus"></i> Adicionar</a>
						<?php } ?>
						<hr>
					</div>
					<!-- /.box-header -->
					<div class="box-body">

						<table id="list-data-table" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>ID</th>
									<?php foreach ($fields_listagem as $field): ?>
										<th><?php echo $field->label; ?></th>
									<?php endforeach ?>
									<th class="th-action">Ação</th>
								</tr>

							</thead>
							<tbody>
								<?php foreach ($categorias as $item): ?>
									<tr>
										<td><?php echo $item->id; ?></td>
										<?php foreach ($fields_listagem as $field): ?>
											<?php if(get_class($field) == 'App\CampoModulo'){ ?>
												<?php $campo = $field->nome; ?>
												<td>
													<?php switch ($field->tipo_campo) {
														case 'S':
															$valor = ($item->$campo) ? 'Sim' : 'Não';
															break;
														case 'N':
															$valor = number_format($item->$campo,2,',','.');
															break;
														case 'D':
															$valor = date('d/m/Y',strtotime($item->$campo));
															break;
														case 'DT':
															$valor = date('d/m/Y H:i:s',strtotime($item->$campo));
															break;
														case 'SI':
															$valor = '<i class="fa '.$item->$campo.'"></i>';
															break;
														default:
															$valor = $item->$campo;
															break;
													} ?>
													<?php echo $valor; ?>
												</td>
											<?php }else{ ?>
												<td>
													<?php $nomeVariavel = 'fk'.$field->id; ?>
													<?php echo $item->$nomeVariavel; ?>
												</td>
											<?php } ?>
										<?php endforeach ?>
										<td>
											<?php if($current_role->hasAccess($current_module->nome_tabela.'.update')){ ?>
												<a href="/admin/categorias/edit/<?php echo $item->id; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
											<?php } ?>
											<?php if($current_role->hasAccess($current_module->nome_tabela.'.delete')){ ?>
												<a href="/admin/categorias/delete/<?php echo $item->id; ?>" class="btn btn-danger deletar"><i class="fa fa-trash"></i></a>
											<?php } ?>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
							<tfoot>
								<tr>
									<th>ID</th>
									<?php foreach ($fields_listagem as $field): ?>
										<th><?php echo $field->label; ?></th>
									<?php endforeach ?>
									<th>Ação</th>
								</tr>
							</tfoot>
						</table>

					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<?php if($current_role->hasAccess($current_module->nome_tabela.'.create')){ ?>
							<a href="{{ url('admin/categorias/add') }}" class="table-add"><i class="fa fa-plus"></i> Adicionar</a>
						<?php } ?>
					</div>
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
