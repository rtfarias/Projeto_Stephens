@extends($current_template)

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo (isset($cliente)) ? 'Editar' : 'Criar'; ?>
			<small>Informações Clientes</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="{{ url('/admin/clientes') }}">Clientes</a></li>
			<li class="active"><?php echo (isset($cliente)) ? 'Editar' : 'Criar'; ?></li>
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
							<li class=""><a data-toggle="pill" href="#solicitacoes-tab">Solicitações</a></li>
							<li class=""><a data-toggle="pill" href="#avaliacoes-tab">Avaliações Recebidas</a></li>
							<?php /*<li><a data-toggle="pill" href="#image2-tab">Imagem Secundária</a></li><?php */ ?>
							<?php if($modulo->galeria){ ?>
								<li><a data-toggle="pill" href="#imagens-tab">Galeria</a></li>
							<?php } ?>
							<!--li><a data-toggle="pill" href="#seo-tab">SEO</a></li-->
						</ul>
						<div class="spacer"></div>
						<form id="mainForm" class="form-horizontal" role="form" method="POST" action="{{ url('/admin/clientes/save') }}">
						<div class="tab-content">

								<div id="info-tab" class="tab-pane fade in active">
									{{ csrf_field() }}
									<?php if($modulo->imagem){ ?>
										<input type="hidden" name="thumbnail_principal" value="<?php echo (isset($cliente)) ? $cliente->thumbnail_principal : ''; ?>">
									<?php } ?>
									<?php if(isset($cliente)){ ?>
										<input type="hidden" name="id" value="<?php echo $cliente->id; ?>"/>
									<?php } ?>
									<?php foreach($fields as $field){ ?>
										<?php if(get_class($field) == 'App\CampoModulo'){ ?>
											<?php $campo = $field->nome; ?>
											<div class="form-group" style="display: <?php if($field->nome == 'udid' || $field->nome == 'id_facebook' || $field->nome == 'latitude' || $field->nome == 'longitude' || $field->nome == 'criado_em' || $field->nome == 'editado_em' || $field->nome == 'estado') echo 'none'; ?>">
												<label for="<?php echo $field->nome; ?>" class="col-md-3 control-label"><?php echo $field->label; ?> <?php echo ($field->required) ? '*' : ''; ?></label>
												<?php if($field->tipo_campo == 'INT'){ ?>
													<div class="col-md-7">
														<input id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> type="number" step="1" class="form-control" value="<?php echo (isset($cliente)) ? $cliente->$campo : $field->valor_padrao; ?>" name="<?php echo $field->nome; ?>" />
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'I'){ ?>
													<div class="col-md-7">
														<input id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> type="text" class="form-control" value="<?php echo (isset($cliente)) ? $cliente->$campo : $field->valor_padrao; ?>" name="<?php echo $field->nome; ?>" />
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'N'){ ?>
													<div class="col-md-7">
														<input id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> type="number" class="form-control" value="<?php echo (isset($cliente)) ? $cliente->$campo : $field->valor_padrao; ?>" name="<?php echo $field->nome; ?>" />
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'T'){ ?>
													<div class="col-md-7">
														<textarea id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> class="form-control tinymce" name="<?php echo $field->nome; ?>"><?php echo (isset($cliente)) ? $cliente->$campo : $field->valor_padrao; ?></textarea>
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'D'){ ?>
													<div class="col-md-7">
														<input id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> type="date" class="form-control" value="<?php echo (isset($cliente)) ? $cliente->$campo : $field->valor_padrao; ?>" name="<?php echo $field->nome; ?>" />
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'DT'){ ?>
													<div class="col-md-7">
														<input id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> type="datetime-local" class="form-control" value="<?php echo (isset($cliente)) ? date_format(date_create($cliente->$campo), 'd/m/Y H:i') : $field->valor_padrao; ?>" name="<?php echo $field->nome; ?>" />
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'TIME'){ ?>
													<div class="col-md-7">
														<input id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> type="time" class="form-control" value="<?php echo (isset($cliente)) ? $cliente->$campo : $field->valor_padrao; ?>" name="<?php echo $field->nome; ?>" />
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'S'){ ?>
													<div class="col-md-7">
														<select id="<?php echo $field->nome; ?>" <?php echo ($field->required) ? 'required' : ''; ?> class="form-control" name="<?php echo $field->nome; ?>">
															<option <?php echo (isset($cliente) && $cliente->$campo == 1) ? 'selected' : ''; ?> value="1">Sim</option>
															<option <?php echo (isset($cliente) && $cliente->$campo == 0) ? 'selected' : ''; ?> value="0">Não</option>
														</select>
													</div>
												<?php } ?>
												<?php if($field->tipo_campo == 'SI'){ ?>
													<div class="col-md-7">
														<select id="cidade" required class="form-control select2" name="cidade" >
															@foreach($cidades as $cidade)
														     <option value="{{ $cidade->id }}">{{ $cidade->cidade}}</option>
														    @endforeach
														</select>
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
															<option <?php echo (isset($cliente) && $cliente->$campo == $option->id) ? 'selected' : ''; ?> value="<?php echo $option->id; ?>"><?php echo $option->$campoNome; ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
										<?php } ?>
									<?php } ?>
								</div>

								<div id="seo-tab" class="tab-pane fade">
									<div class="form-group">
										<label for="meta_keywords" class="col-md-3 control-label">URL Amigável</label>

										<div class="col-md-7">
											<input type="text" class="form-control" name="slug" value="<?php echo isset($cliente) ? $cliente->slug : ''; ?>">
										</div>
									</div>
									<div class="form-group">
										<label for="meta_keywords" class="col-md-3 control-label">Palavras Chave</label>

										<div class="col-md-7">
											<div id="meta_keywords"></div>
										</div>
									</div>
									<div class="form-group">
										<label for="meta_descricao" class="col-md-3 control-label">Meta Descrição</label>

										<div class="col-md-7">
											<textarea id="meta_descricao" type="text" class="form-control" name="meta_descricao"><?php echo (isset($cliente)) ? $cliente->meta_descricao : ''; ?></textarea>
										</div>
									</div>
									<script>
										new Taggle('meta_keywords', {
											<?php if(isset($cliente) && $cliente->meta_keywords != ''){ ?>
												tags: [
													<?php $tags = explode(',',$cliente->meta_keywords); ?>

													<?php foreach($tags as $tag){ ?>
												    	'<?php echo $tag; ?>',
												   <?php } ?>
												],
											<?php }else{ ?>
												tags: [
													'cliente'
												],
											<?php } ?>
										    duplicateTagClass: 'bounce',
											 hiddenInputName: 'meta_keywords[]'
										});
									</script>
								</div>
							</form>

							<div id="solicitacoes-tab" class="tab-pane fade col-md-10 col-md-offset-1">
								<div class="box box-primary">
									<table class="table no-margin ">
										<thead>
											<tr>
												<th>Categoria</th>
												<th>Fornecedor Aceito</th>
												<th>Data Solicitação</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($solicitacoes) && count($solicitacoes)>0) {foreach ($solicitacoes as $solicitacao): ?>
											<tr >											
													<td><?php echo $solicitacao->nome_categoria; ?></td>
													<td><?php echo $solicitacao->nome_fornecedor; ?></td>
													<td>
														<?php echo ($solicitacao->criado_em) ? date_format(date_create($solicitacao->criado_em), 'd/m/Y H:i') : ''; ?></td>
													<td>
														
															<?php if($solicitacao->finalizado == 1){?>
															<a class="btn btn-success"><i class="ion-checkmark"></i></a>
															<?php
															}else if($solicitacao->finalizado == 0){?>
															<a class="btn btn-danger"><i class="ion-close"></i></a>
															<?php
															}else if($solicitacao->finalizado == 2){?>
															<a class="btn btn-warning"><i class="ion-android-time"></i></a>
															<?php
															}
															?>
														
													
														<?php /*<a href="/admin/rejeitar/<?php echo $consulta->id; ?>" onclick="if(!confirm('Tem certeza que deseja rejeitar essa consulta?')){return false;};" class="btn btn-danger"  ><i class="ion-close"></i></a>
														*/?>

														
													</td>
												</tr>
												<?php endforeach; }?>
											</tbody>
										</table>
									</div>
							</div>

							<div id="avaliacoes-tab" class="tab-pane fade col-md-10 col-md-offset-1">
								<div class="box box-primary">
									<table class="table no-margin ">
										<thead>
											<tr>
												<th>Avaliação</th>
												<th>Fornecedor</th>
												<th>Comentário</th>
												<th>Data Avalição</th>
												<th>Histórico</th>
											</tr>
										</thead>
										<tbody>
										<?php if(isset($avaliacoes) && count($avaliacoes)>0) {foreach ($avaliacoes as $avaliacao): ?>
											<tr >											
													<td class="col-md-3">
														<?php 

														$cont = $avaliacao->avaliacao;
														$estrelas = 'Estrelas';
														if($cont < 2)
															$estrelas = 'Estrela';

														 for ($i=0; $i < 5; $i++) { 

															if($cont > 0){
															?>
															<i class="ion-ios-star star-avaliacao"></i>
														<?php }else{ ?>
															<i class="ion-ios-star-outline star-avaliacao"></i>

														<?php } $cont--;  } ?>
													</td>
													<td class="col-md-2"><?php echo $avaliacao->nome_fornecedor; ?></td>
													<td class="col-md-5"><?php echo $avaliacao->comentario; ?></td>
													<td>
														<?php echo ($avaliacao->criado_em) ? date_format(date_create($avaliacao->criado_em), 'd/m/Y') : ''; ?>
													</td>

													<td>
														<?php if($current_role->hasAccess($current_module->nome_tabela.'.update')){ ?>
															<a data-target="#modalMensagens" data-toggle="modal" class="btn btn-success botao-mensagens" id="<?php echo $avaliacao->id_solicitacao; ?>" ><i class="ion-android-mail"></i></a>
														<?php } ?>
													</td>
							
												</tr>
												<?php endforeach; }?>
											</tbody>
										</table>
									</div>
							</div>







					<div id="modalMensagens" class="modal fade" role="dialog">
						<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
									<button class="close" data-dismiss="modal"><i class="ion-close"></i></button>
									<h4 class="modal-title">Dados da solicitação</h4>
								</div>
								<div class="modal-body">

									<div id="cabecalho"></div>
									

									<div class="spacer"></div>
									<div class="box-body">
										<table id="table-mensagens" class="table no-margin table-modal">
											<thread>
												<tr>
													<th>Enviado por</th>
													<th>Data</th>
													<th>Mensagem</th>
												</tr>
											</thread>
											<tbody>
												
			
											</tbody>
										</table>
									</div>


								</div>
								<div class="modal-footer">
									
								</div>
							</div>
						</div>
						
					</div>









							<?php if($modulo->imagem){ ?>
								<div id="image-tab" class="tab-pane fade">
									<script type="text/javascript">
										var image_campo = 'thumbnail_principal';
									</script>
									<div class="form-horizontal">
										<div class="form-group">
											<label for="image" class="col-md-3 control-label">Imagem</label>
											<div class="col-md-7">
												<form action="{{ url('admin/clientes/upload') }}" method="post" class="form single-dropzone" id="my-dropzone" enctype="multipart/form-data">
													<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
													<div id="img-thumb-preview">
														<img id="img-thumb" class="user size-lg img-thumbnail img-responsive" src="<?php echo (isset($cliente) && $cliente->thumbnail_principal != '') ? url('/uploads/clientes/'.$cliente->thumbnail_principal) : 'http://placehold.it/300x100'; ?>">
													</div>
													<button type="button" style="display:none;" id="crop-image" class="btn btn-success">Salvar Corte</button>
													<button id="upload-submit" class="btn btn-default margin-t-5"><i class="fa fa-upload"></i> Enviar Imagem</button>
												</form>
												<form class="hidden" action="{{ url('admin/clientes/crop') }}" id="cropForm" method="POST">
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
										<?php if(isset($cliente) && count($cliente->imagens)){?>
											<?php foreach ($cliente->imagens as $image){?>
												<div id="item_<?php echo $image->id; ?>" class="item imagem-galeria-<?php echo $image->id; ?>">
													<div style="background-image: url(<?php echo "/uploads/clientes/$image->thumbnail_principal";?>);" class="thumb"></div>
													<span data="<?php echo $image->id; ?>" data-modulo="clientes" class="icon delete-image" aria-hidden="true"><i class="fa fa-trash"></i></span>
												</div>
											<?php }?>
										<?php }?>
									</div>
									<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<form class="dropzone" id="galeria-dropzone" method="POST" action="<?php echo (isset($cliente)) ? url('/admin/clientes/upload_galeria/'.$cliente->id) : url('/admin/clientes/upload_galeria/'.$nextId); ?> " enctype="multipart/form-data">
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
						<?php if(isset($cliente) && $current_role->hasAccess($current_module->nome_tabela.'.update') || !isset($cliente) && $current_role->hasAccess($current_module->nome_tabela.'.create')){ ?>
							<div class="text-center">
								<!--button type="submit" class="btn btn-primary">
									<i class="fa fa-btn fa-pencil"></i> Salvar
								</button-->
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

	$(document).ready(function(){



				// codes works on all bootstrap modal windows in application
	    $('.modal').on('hidden.bs.modal', function(e)
	    { 
	        $(".modal").html('<div class="modal-dialog">'+
						'<div class="modal-content">'+
								'<div class="modal-header">'+
								'	<button class="close" data-dismiss="modal"><i class="ion-close"></i></button>'+
								'	<h4 class="modal-title">Dados da solicitação</h4>'+
								'</div>'+
								'<div class="modal-body">'+

									'<div id="cabecalho"></div>'+
									

									'<div class="spacer"></div>'+
									'<div class="box-body">'+
										'<table id="table-mensagens" class="table no-margin table-modal">'+
											'<thread>'+
												'<tr>'+
													'<th>Enviado por</th>'+
													'<th>Data</th>'+
													'<th>Mensagem</th>'+
												'</tr>'+
											'</thread>'+
											'<tbody>'+
												
			
											'</tbody>'+
										'</table>'+
									'</div>'+


								'</div>'+
								'<div class="modal-footer">'+
									
								'</div>'+
							'</div>'+
						'</div>');
	    }) ;



		$('.botao-mensagens').click(function(e){
			var obj = e.currentTarget;
			console.log(obj);
			$.ajax({
				url: "admin/avaliacoes-fornecedores/mensagens_solicitacao",
				dataType: 'json',
				type: 'POST',
				data: {id: obj.id},
				success: function(resposta){
					var head = '<h4 id="solicitado_por" class="titulo-modal-mensagem"><b>Solicitado por:</b> '+resposta[0].nome_cliente+'</h4>'+
										'<h4 id="fornecedor" class="titulo-modal-mensagem"><b>Fornecedor:</b> '+resposta[0].nome_fornecedor+'</h4>';

					if(resposta[0].data_realizacao == null || resposta[0].data_realizacao == '')
						head += '<h5 id="data_solicitacao" class="info-modal pull-left"><b>Data atendimento:</b> Não concluído</h5>';
					else
						head += '<h5 id="data_solicitacao" class="info-modal pull-left"><b>Data atendimento:</b>'+resposta[0].data_realizacao+'</h5>';

					

					if(resposta[0].valor == null || resposta[0].valor == '')
						head += '<h5 id="valor" class="info-modal pull-left"><b>Valor:</b> Não informado</h5>';
					else
						head += '<h5 id="valor" class="info-modal pull-left"><b>Valor:</b> R$ '+resposta[0].valor+'</h5>';

					$.each(resposta, function(index, resposta){
						console.log(resposta);
										
						$('#cabecalho').append(head);

						var objeto = "<tr>";

						if(resposta.enviado_por == 0)
							objeto += "<td>Cliente</td>";
						else
							objeto += "<td>Fornecedor</td>";

						objeto += "<td>"+resposta.criado_em+"</td>"+
								"<td>"+resposta.mensagem+"</td>"+
							"</tr>";

						$('#table-mensagens').append(objeto);

					})
				},
				error: function(e){
					console.log(e);
				}
			})
		})



		/* VERIFICAR SE EMAIL JA EXISTE */
		  $('[name="email"]').blur(function() {
		      verificaSeEmailExiste($('[name="email"]').val());
		  });

		  $('[name="email"]').keypress(function(e) {
		    if(e.which == 13) {
		        verificaSeEmailExiste($('[name="email"]').val());
		    }
		  });

		  $('[name="email"]').keydown(function(e){
		      if(e.keyCode == 9) {
		        verificaSeEmailExiste($('[name="email"]').val());
		      }
		  });


		  var verificaSeEmailExiste = function(email){

		      $.ajax({
		        url: "admin/clientes/verifica_email",
		        dataType: 'json',
		        type: 'POST',
		        data: {
		            'email': email,
		        },
		        success: function(resultado) {
		          
		          if(resultado == true){
		            alert('E-mail já existe na base de dados! Você não pode cadastrar duas vezes o mesmo e-mail.');
		            $('#email').focus();
		            $('#email').val('');
		          }

		        },
		        error: function(xhr, ajaxOptions, thrownError) {
		            alertUtil.alertError(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		        }
		      });

		  }

		$('#telefone').mask('(99)9999-9999');
		$('#cep').mask('99999-999');

	});

</script>
@endsection
