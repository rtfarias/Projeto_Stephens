@extends($current_template)

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo (isset($modulo)) ? 'Editar' : 'Criar'; ?>
			<small>Módulo</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li class="active"><?php echo (isset($modulo)) ? 'Editar' : 'Criar'; ?> Módulo</li>
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
							<li><a data-toggle="pill" href="#campos-tab">Campos</a></li>
						</ul>
						<div class="spacer"></div>
						<form id="mainForm" class="form-horizontal" role="form" method="POST" action="{{ url('/admin/gerador/save') }}">
							<div class="tab-content">
								<div id="info-tab" class="tab-pane fade in active">
									{{ csrf_field() }}
									<?php if(isset($modulo)){ ?>
										<input type="hidden" name="id" value="<?php echo $modulo->id; ?>"/>
									<?php } ?>
									<div class="form-group">
										<label for="label" class="col-md-3 control-label">Label</label>

										<div class="col-md-7">
											<input id="label" type="text" class="form-control" value="<?php echo (isset($modulo)) ? $modulo->label : ''; ?>" name="label" />
										</div>
									</div>
									<div class="form-group">
										<label for="item_modulo" class="col-md-3 control-label">Item do Módulo</label>
										<div class="col-md-7">
											<input id="item_modulo" type="text" <?php echo (isset($modulo)) ? 'readonly' : ''; ?> class="form-control" value="<?php echo (isset($modulo)) ? $modulo->item_modulo : ''; ?>" name="item_modulo" />
										</div>
									</div>
									<div class="form-group">
										<label for="items_modulo" class="col-md-3 control-label">Itens do Módulo</label>
										<div class="col-md-7">
											<input id="items_modulo" type="text" <?php echo (isset($modulo)) ? 'readonly' : ''; ?> class="form-control" value="<?php echo (isset($modulo)) ? $modulo->items_modulo : ''; ?>" name="items_modulo" />
										</div>
									</div>
									<div class="form-group">
										<label for="name" class="col-md-3 control-label">Nome Pasta</label>
										<div class="col-md-7">
											<input id="nome" type="text" <?php echo (isset($modulo)) ? 'readonly' : ''; ?> class="form-control" value="<?php echo (isset($modulo)) ? $modulo->nome : ''; ?>" name="nome" />
										</div>
									</div>
									<div class="form-group">
										<label for="name" class="col-md-3 control-label">Rota</label>
										<div class="col-md-7">
											<input id="rota" type="text" <?php echo (isset($modulo)) ? 'readonly' : ''; ?> class="form-control" value="<?php echo (isset($modulo)) ? $modulo->rota : ''; ?>" name="rota" />
										</div>
									</div>

									<div class="form-group">
										<label for="nome_tabela" class="col-md-3 control-label">Nome da tabela</label>
										<div class="col-md-7">
											<input id="nome_tabela" type="text" <?php echo (isset($modulo)) ? 'readonly' : ''; ?> class="form-control" value="<?php echo (isset($modulo)) ? $modulo->nome_tabela : ''; ?>" name="nome_tabela" />
										</div>
									</div>
									<div class="form-group">
										<label for="imagem" class="col-md-3 control-label">Imagem</label>
										<div class="col-md-7">
											<input id="imagem" type="checkbox" value="1" <?php echo (isset($modulo) && $modulo->imagem) ? 'checked' : ''; ?> name="imagem" />
										</div>
									</div>
									<div class="form-group">
										<label for="galeria" class="col-md-3 control-label">Galeria</label>
										<div class="col-md-7">
											<input id="galeria" type="checkbox" value="1" <?php echo (isset($modulo) && $modulo->galeria) ? 'checked' : ''; ?> name="galeria" />
										</div>
									</div>
									<div class="form-group">
										<label for="name" class="col-md-3 control-label">Tipo</label>
										<div class="col-md-7">
											<select name="id_tipo_modulo" <?php echo (isset($modulo)) ? 'readonly' : ''; ?> id="id_tipo_modulo" class="form-control">
												<?php foreach ($tipos as $tipo): ?>
													<?php if(isset($modulo) && $tipo->id == $modulo->id_tipo_modulo){ $selected = 'selected'; }else{ $selected = ''; } ?>
													<option <?php echo $selected; ?> value="<?php echo $tipo->id; ?>"><?php echo $tipo->nome; ?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="name" class="col-md-3 control-label">Menu</label>
										<div class="col-md-7">
											<select name="menu" id="menu" class="form-control">
												<option <?php echo (isset($modulo) && $modulo->menu) ? 'selected' : ''; ?> value="1">Sim</option>
												<option <?php echo (isset($modulo) && !$modulo->menu) ? 'selected' : ''; ?> value="0">Não</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="name" class="col-md-3 control-label">Ordem</label>
										<div class="col-md-7">
											<input type="number" name="ordem" id="ordem" class="form-control" value="<?php echo (isset($modulo)) ? $modulo->ordem : '0'; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="name" class="col-md-3 control-label">Ícone</label>
										<div class="col-md-7">
											<input type="text" name="icone" id="icone" class="form-control" value="<?php echo (isset($modulo)) ? $modulo->icone : 'fa-circle-o'; ?>">
										</div>
									</div>
								</div>
								<div id="campos-tab" class="tab-pane fade">

									<div class="spacer"></div>
									<table class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Label</th>
												<th>Nome Tabela</th>
												<th>Valor Padrão</th>

												<th>Listagem</th>
												<th>Required</th>
												<th>Tipo Campo</th>
												<th>Ordem</th>
												<th>Ação</th>
											</tr>

										</thead>
										<tbody id="tbody-campos">
											<?php if(isset($modulo)){ ?>
												<?php $count = 0; ?>
												<?php foreach ($campos as $campo): ?>
													<tr>
														<input type="hidden" name="edit-campo-id[]" value="<?php echo $campo->id; ?>">
														<input type="hidden" name="old-campo-nome[]" value="<?php echo $campo->nome; ?>"/>
														<td><input id="label-<?php echo $count; ?>" type="text" class="form-control" name="edit-campo-label[]" value="<?php echo $campo->label; ?>"/></td>
														<td><input id="nome-<?php echo $count; ?>" type="text" class="form-control" name="edit-campo-nome[]" value="<?php echo $campo->nome; ?>"/></td>
														<td><input type="text" class="form-control" name="edit-campo-valor-padrao[]" value="<?php echo $campo->valor_padrao; ?>"/></td>
														<td>
															<select class="form-control" name="edit-campo-listagem[]">
																<option <?php echo ($campo->listagem == 1) ? 'selected' : ''; ?> value="1">Sim</option>
																<option <?php echo ($campo->listagem == 0) ? 'selected' : ''; ?> value="0">Não</option>

															</select>
														</td>
														<td>
															<select class="form-control" name="edit-campo-required[]">
																<option <?php echo ($campo->required == 1) ? 'selected' : ''; ?> value="1">Sim</option>
																<option <?php echo ($campo->required == 0) ? 'selected' : ''; ?> value="0">Não</option>

															</select>
														</td>
														<td>
															<select class="form-control" name="edit-campo-tipo-campo[]">
																<option <?php echo ($campo->tipo_campo == 'INT') ? 'selected' : ''; ?> value="INT">Inteiro</option>
																<option <?php echo ($campo->tipo_campo == 'I') ? 'selected' : ''; ?> value="I">Input Text</option>
																<option <?php echo ($campo->tipo_campo == 'N') ? 'selected' : ''; ?> value="N">Number</option>
																<option <?php echo ($campo->tipo_campo == 'T') ? 'selected' : ''; ?> value="T">Textarea</option>
																<option <?php echo ($campo->tipo_campo == 'D') ? 'selected' : ''; ?> value="D">Date</option>
																<option <?php echo ($campo->tipo_campo == 'DT') ? 'selected' : ''; ?> value="DT">Datetime</option>
																<option <?php echo ($campo->tipo_campo == 'TIME') ? 'selected' : ''; ?> value="TIME">Time</option>
																<option <?php echo ($campo->tipo_campo == 'S') ? 'selected' : ''; ?> value="S">Select Boolean</option>
																<option <?php echo ($campo->tipo_campo == 'SI') ? 'selected' : ''; ?> value="SI">Select Ícones</option>
															</select>
														</td>
														<td><input type="text" class="form-control" name="edit-campo-ordem[]" value="<?php echo $campo->ordem; ?>"/></td>
														<td><button type="button" data-id="<?php echo $campo->id; ?>" class="btn btn-danger delete_campo"><i class="fa fa-trash-o"></i></button></td>
													</tr>
													<script type="text/javascript">
													$(document).ready(function(){
														$('#label-<?php echo $count; ?>').slugify({ slug: '#nome-<?php echo $count; ?>', type: '_' });
													});

													</script>
													<?php $count++; ?>
												<?php endforeach ?>
											<?php } ?>
										</tbody>

									</table>
									<div class="col-lg-12 text-center">
										<button type="button" class="btn btn-success" id="add_campo">Adicionar Campo</button>
									</div>
									<div class="spacer"></div>
									<script type="text/javascript">
									$('.delete_campo').click(function(){
										var id_campo = $(this).attr('data-id');
										var tr = $(this).closest('tr');
										$.ajax({
											url:'/admin/campo-modulo/delete/'+id_campo,
											dataType:'JSON',
											data:{
												_token : '{{ csrf_token() }}'
											},
											type:'POST',
											beforeSend:function(){
												$('.loading').fadeIn();
											},
											success:function(data){
												$('.loading').fadeOut();
												tr.remove();
											},
										});
									});

									$('#add_campo').click(function(){
										var count = $('#tbody-campos tr').length;
										$('#tbody-campos').append('<tr> <td><input id="label-'+count+'" type="text" class="form-control" name="campo-label[]"/></td> <td><input id="nome-'+count+'" type="text" class="form-control" name="campo-nome[]"/></td> <td><input type="text" class="form-control" name="campo-valor-padrao[]"/></td> <td><select class="form-control" name="campo-listagem[]"><option value="1">Sim</option><option value="0">Não</option></select></td><td><select class="form-control" name="campo-required[]"><option value="1">Sim</option><option value="0">Não</option></select></td> <td> <select class="form-control" name="campo-tipo-campo[]"><option value="INT">Inteiro</option> <option value="I">Input Text</option><option value="N">Number</option> <option value="T">Textarea</option> <option value="D">Date</option> <option value="DT">Datetime</option><option value="TIME">Time</option><option value="S">Select Boolean</option> <option value="SI">Select Ícones</option></select> </td><td><input type="text" class="form-control" name="campo-ordem[]"/></td> <td><button type="button" class="btn btn-danger delete_campo"><i class="fa fa-trash-o"></i></button></td> </tr>');
										var id_selected = $('#tbody-campos tr:last-child').prev().find('[name="campo-tipo-campo[]"] option:selected').val();
										$('#tbody-campos tr:last-child [name="campo-tipo-campo[]"] option[value="'+id_selected+'"]').prop('selected', true);
										$('.delete_campo').click(function(){
											$(this).closest('tr').remove();
										});
										$('#label-'+count).slugify({ slug: '#nome-'+count, type: '_' });
									});
									</script>
									<div class="spacer"></div>
									<table class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Label</th>
												<th>Nome Tabela</th>
												<th>Módulo</th>
												<th>Campo Módulo</th>
												<th>Listagem</th>
												<th>Ordem</th>
												<th>Ação</th>
											</tr>

										</thead>
										<tbody id="tbody-fks">
											<?php if(isset($fks)){ ?>
												<?php $count = 0; foreach ($fks as $fk): ?>
													<tr data-count="<?php echo $count; ?>">
														<input type="hidden" name="edit-fk-id[]" value="<?php echo $fk->id; ?>">
														<input type="hidden" name="old-fk-nome[]" value="<?php echo $fk->nome; ?>">
														<td>
															<input type="text" class="form-control" name="edit-fk-label[]" value="<?php echo $fk->label; ?>">
														</td>
														<td>
															<input type="text" class="form-control" name="edit-fk-nome[]" value="<?php echo $fk->nome; ?>">
														</td>
														<td>
															<select class="form-control" name="edit-fk-modulo[]">
																<?php foreach ($modulos as $oneModulo): ?>
																	<option <?php echo ($oneModulo->id == $fk->id_modulo_relacionado) ? 'selected' : ''; ?> value="<?php echo $oneModulo->id; ?>"><?php echo $oneModulo->label; ?></option>
																<?php endforeach; ?>
															</select>
														</td>
														<td>
															<select class="form-control" name="edit-fk-campo-label[]">
																<?php foreach ($modulos as $oneModulo): ?>
																	<optgroup data-id="<?php echo $oneModulo->id; ?>" label="<?php echo $oneModulo->label; ?>">
																		<?php foreach ($oneModulo->campos as $campo): ?>
																			<option <?php echo ($campo->id == $fk->id_campo_modulo_relacionado) ? 'selected' : ''; ?> value="<?php echo $campo->id; ?>"><?php echo $campo->label; ?></option>
																		<?php endforeach; ?>
																	</optgroup>
																<?php endforeach; ?>
															</select>
														</td>
														<td>
															<select class="form-control" name="edit-fk-listagem[]">
																<option <?php echo ($fk->listagem == 1) ? 'selected' : ''; ?> value="1">Sim</option>
																<option <?php echo ($fk->listagem == 0) ? 'selected' : ''; ?> value="0">Não</option>

															</select>
														</td>
														<td>
															<input type="text" class="form-control" name="edit-fk-ordem[]" value="<?php echo $fk->ordem; ?>">
														</td>
														<td>
															<button type="button" class="btn btn-danger removeFk"><i class="fa fa-trash-o"></i></button>
														</td>
													</tr>
													<script>
														$('tr[data-count="<?php echo $count; ?>"] .removeFk').click(function(){
															var tr = $(this).closest('tr');
															$.ajax({
																url:'/admin/gerador/remove-fk',
																dataType:'JSON',
																data:{
																	id_fk: tr.find('[name="edit-fk-id[]"]').val()
																},
																type:'POST',
																beforeSend:function(){
																	$('.loading').fadeIn();
																},
																success:function(data){
																	$('.loading').fadeOut();
																	tr.remove();
																},
															});
														});
														$('tr[data-count="<?php echo $count; ?>"] [name="edit-fk-modulo[]"]').change(function(){
															var campo_label_select = $(this).closest('tr').find('[name="edit-fk-campo-label[]"]');
															var id_modulo_selected = $(this).find('option:selected').val();
															alert(id_modulo_selected);
															campo_label_select.find('option:selected').prop('selected',false);
															campo_label_select.find('optgroup').hide();
															campo_label_select.find('optgroup[data-id="'+id_modulo_selected+'"]').show();
															campo_label_select.find('optgroup[data-id="'+id_modulo_selected+'"] option:eq(0)').prop('selected',true);
														});
														$('tr[data-count="<?php echo $count; ?>"] [name="edit-fk-campo-label[]"] optgroup').hide();
														$('tr[data-count="<?php echo $count; ?>"] [name="edit-fk-campo-label[]"] option:selected').closest('optgroup').show();

													</script>
												<?php $count++; endforeach; ?>
											<?php } ?>
										</tbody>

									</table>
									<div class="col-lg-12 text-center">
										<button type="button" class="btn btn-success" id="add_fk">Adicionar Foreign Key</button>
									</div>
									<div class="spacer"></div>
									<script type="text/javascript">
										$('#add_fk').click(function(){
											$.ajax({
												url:'/admin/gerador/add-fk',
												type:'POST',
												data:{
													count : $('#tbody-fks tr').length+1,
													<?php if(isset($modulo)){ ?>
														id_modulo: '<?php echo $modulo->id; ?>'
													<?php } ?>
												},
												dataType:'html',
												success:function(data){
													$('#tbody-fks').append(data);
												}
											});
										});
									</script>
								</div>
							</form>
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<div class="text-center">
							<button type="submit" class="btn btn-primary">
								<i class="fa fa-btn fa-pencil"></i> <?php echo (isset($modulo))? 'Salvar' : 'Gerar'; ?>
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
$('[type="submit"]').click(function(e){
	if(!$('#tbody-campos tr').length){
		e.preventDefault();
		alert('Você deve adicionar ao menos um campo para o módulo');
	}
});
$(document).ready(function(){
	$('#label').slugify({ slug: '#rota', type: '-' });
	$('#label').on('keydown change',function(){
		var nome = $('#rota').val();
		var nome_tabela = $('#rota').val().replace(/-/g,"_");
		nome = nome.charAt(0).toUpperCase() + nome.slice(1);
		while(nome.indexOf('-') != -1){
			index = nome.indexOf('-') + 1;
			nome = nome.substr(0, index-1)+nome[index].toUpperCase()+nome.substr(index+1);
		}
		$('#nome').val(nome);
		$('#nome_tabela').val(nome_tabela);
		$('#item_modulo').val(nome_tabela);
	});
});
</script>
@endsection
