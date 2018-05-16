@extends($current_template)

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo (isset($categoria)) ? 'Editar' : 'Criar'; ?>
			<small>Informações Categorias</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="{{ url('/admin/categorias') }}">Categorias</a></li>
			<li class="active"><?php echo (isset($categoria)) ? 'Editar' : 'Criar'; ?></li>
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
							<?php if($modulo->imagem){ ?>
								<li><a data-toggle="pill" href="#image-tab">Imagem</a></li>
							<?php } ?>
							<?php /*<li><a data-toggle="pill" href="#image2-tab">Imagem Secundária</a></li><?php */ ?>
							<?php if($modulo->galeria){ ?>
								<li><a data-toggle="pill" href="#imagens-tab">Galeria</a></li>
							<?php } ?>
						</ul>
						<div class="spacer"></div>
						<form id="mainForm" class="form-horizontal" role="form" method="POST" action="{{ url('/admin/categorias/save') }}">
						<div class="tab-content">

								<div id="info-tab" class="tab-pane fade in active">
									{{ csrf_field() }}
									<?php if($modulo->imagem){ ?>
										<input type="hidden" name="thumbnail_principal" value="<?php echo (isset($categoria)) ? $categoria->thumbnail_principal : ''; ?>">
									<?php } ?>
									<?php if(isset($categoria)){ ?>
										<input type="hidden" name="id" value="<?php echo $categoria->id; ?>"/>
									<?php } ?>
									<?php foreach($fields as $field){ ?>
										<?php if(get_class($field) == 'App\CampoModulo'){ ?>
											<?php $campo = $field->nome; ?>
											<div class="form-group">
												<label for="<?php echo $field->nome; ?>" class="col-md-3 control-label"><?php echo $field->label; ?> <?php echo ($field->required) ? '*' : ''; ?></label>
												<?php if($field->tipo_campo == 'INT'){ ?>
													<div class="col-md-7">
														<input id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> type="number" step="1" class="form-control" value="<?php echo (isset($categoria)) ? $categoria->$campo : $field->valor_padrao; ?>" name="<?php echo $field->nome; ?>" />
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'I'){ ?>
													<div class="col-md-7">
														<input id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> type="text" class="form-control" value="<?php echo (isset($categoria)) ? $categoria->$campo : $field->valor_padrao; ?>" name="<?php echo $field->nome; ?>" />
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'N'){ ?>
													<div class="col-md-7">
														<input id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> type="number" class="form-control" value="<?php echo (isset($categoria)) ? $categoria->$campo : $field->valor_padrao; ?>" name="<?php echo $field->nome; ?>" />
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'T'){ ?>
													<div class="col-md-7">
														<textarea id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> class="form-control tinymce" name="<?php echo $field->nome; ?>"><?php echo (isset($categoria)) ? $categoria->$campo : $field->valor_padrao; ?></textarea>
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'D'){ ?>
													<div class="col-md-7">
														<input id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> type="date" class="form-control" value="<?php echo (isset($categoria)) ? $categoria->$campo : $field->valor_padrao; ?>" name="<?php echo $field->nome; ?>" />
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'DT'){ ?>
													<div class="col-md-7">
														<input id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> type="datetime-local" class="form-control" value="<?php echo (isset($categoria)) ? date_format(date_create($categoria->$campo), 'd/m/Y H:i') : $field->valor_padrao; ?>" name="<?php echo $field->nome; ?>" />
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'TIME'){ ?>
													<div class="col-md-7">
														<input id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> type="time" class="form-control" value="<?php echo (isset($categoria)) ? $categoria->$campo : $field->valor_padrao; ?>" name="<?php echo $field->nome; ?>" />
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'S'){ ?>
													<div class="col-md-7">
														<select id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> class="form-control" name="<?php echo $field->nome; ?>">
															<option <?php echo (isset($categoria) && $categoria->$campo == 1) ? 'selected' : ''; ?> value="1">Sim</option>
															<option <?php echo (isset($categoria) && $categoria->$campo == 0) ? 'selected' : ''; ?> value="0">Não</option>
														</select>
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'SI'){ ?>
													<div class="col-md-5">
														<?php $icons = explode(',',file_get_contents('fonts/icons-font-awesome.txt')); ?>
														<select id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> class="form-control select2 select-icone" name="<?php echo $field->nome; ?>">
															<?php foreach ($icons as $icone): ?>
																<option <?php echo (isset($categoria) && $icone == $categoria->$campo) ? 'selected' : ''; ?> value="<?php echo $icone; ?>"><?php echo $icone; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
													<div class="icone-viewer">
														<i class="fa fa-3x"></i>
													</div>
												<?php } ?>
											</div>
										<?php }else{ ?>
											<?php $campo = $field->nome; ?>
											<div class="form-group">
												<label for="<?php echo $field->nome; ?>" class="col-md-3 control-label"><?php echo $field->label; ?> *</label>
												<div class="col-md-7">
													<select id="<?php echo $field->nome; ?>" required class="form-control select2" name="<?php echo $field->nome; ?>">
														<?php $nomeVariavel = 'array_'.$field->nome; ?>
														<?php foreach ($$nomeVariavel as $option): ?>
															<?php $campoNome = $field->campoRelacionado->nome; ?>
															<option <?php echo (isset($categoria) && $categoria->$campo == $option->id) ? 'selected' : ''; ?> value="<?php echo $option->id; ?>"><?php echo $option->$campoNome; ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
										<?php } ?>
									<?php } ?>
								</div>

								
							</form>
							<?php if($modulo->imagem){ ?>
								<div id="image-tab" class="tab-pane fade">
									<script type="text/javascript">
										var image_campo = 'thumbnail_principal';
									</script>
									<div class="form-horizontal">
										<div class="form-group">
											<label for="image" class="col-md-3 control-label">Imagem</label>
											<div class="col-md-7">
												<form action="{{ url('admin/categorias/upload') }}" method="post" class="form single-dropzone" id="my-dropzone" enctype="multipart/form-data">
													<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
													<div id="img-thumb-preview">
														<img id="img-thumb" class="user size-lg img-thumbnail img-responsive" src="<?php echo (isset($categoria) && $categoria->thumbnail_principal != '') ? url('/uploads/categorias/'.$categoria->thumbnail_principal) : 'http://placehold.it/300x100'; ?>">
													</div>
													<button type="button" style="display:none;" id="crop-image" class="btn btn-success">Salvar Corte</button>
													<button id="upload-submit" class="btn btn-default margin-t-5"><i class="fa fa-upload"></i> Enviar Imagem</button>
												</form>
												<form class="hidden" action="{{ url('admin/categorias/crop') }}" id="cropForm" method="POST">
													<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
													<input type="hidden" name="data_crop">
													<input type="hidden" name="file_name">
												</form>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>

							<?php if($modulo->galeria){ ?>

								<div id="imagens-tab" class="tab-pane fade">
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 lista-galeria">
										<?php if(isset($categoria) && count($categoria->imagens)){?>
											<?php foreach ($categoria->imagens as $image){?>
												<div id="item_<?php echo $image->id; ?>" class="item imagem-galeria-<?php echo $image->id; ?>">
													<div style="background-image: url(<?php echo "/uploads/categorias/$image->thumbnail_principal";?>);" class="thumb"></div>
													<span data="<?php echo $image->id; ?>" data-modulo="categorias" class="icon delete-image" aria-hidden="true"><i class="fa fa-trash"></i></span>
												</div>
											<?php }?>
										<?php }?>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<form class="dropzone" id="galeria-dropzone" method="POST" action="<?php echo (isset($categoria)) ? url('/admin/categorias/upload_galeria/'.$categoria->id) : url('/admin/categorias/upload_galeria/'.$nextId); ?> " enctype="multipart/form-data">
											<input type="hidden" name="_token" value="{{ csrf_token() }}" />
											<div class="fallback">
												<input name="file" type="file" multiple />
											</div>
										<form>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<?php if(isset($categoria) && $current_role->hasAccess($current_module->nome_tabela.'.update') || !isset($categoria) && $current_role->hasAccess($current_module->nome_tabela.'.create')){ ?>
							<div class="text-center">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-btn fa-pencil"></i> Salvar
								</button>
							</div>
						<?php } ?>
					</div>
				</div>
					<!-- /.box -->
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">

</script>
@endsection
