@extends($current_template)

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<?php echo (isset($user)) ? 'Editar' : 'Criar'; ?>
			<small>Informações Clínica</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="{{ url('/admin/users') }}">Cadastro de Clínicas</a></li>
			<li class="active"><?php echo (isset($user)) ? 'Editar' : 'Criar'; ?></li>
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
							<?php if(isset($user)){ ?>
								<li><a data-toggle="pill" href="#image-tab">Imagem</a></li>
							<?php } ?>
						</ul>
						<div class="spacer"></div>
						<form id="mainForm" class="form-horizontal" role="form" method="POST" onsubmit="return validaFormulario(this)" action="{{ url('/admin/users/save') }}">
						<div class="tab-content">

								<div id="info-tab" class="tab-pane fade in active">
									{{ csrf_field() }}

									<input type="hidden" name="thumbnail_principal" value="<?php echo (isset($user)) ? $user->thumbnail_principal : ''; ?>">
									<?php if(isset($user)){ ?>
										<input type="hidden" name="id" value="<?php echo $user->id; ?>"/>
									<?php } ?>

									<div class="form-group">
										<label for="name" class="col-md-2 control-label">Nome</label>

										<div class="col-md-8">
											<input id="name" type="text" class="form-control" value="<?php echo (isset($user)) ? $user->first_name : ''; ?>" name="name" required />
										</div>
									</div>

									<div class="form-group">
										<label for="email" class="col-md-2 control-label">E-mail</label>

										<div class="col-md-8">
											<input id="email" type="email" class="form-control" value="<?php echo (isset($user)) ? $user->email : ''; ?>" name="email" required/>
										</div>
									</div>

									<div class="form-group">
										<label for="cnpj" class="col-md-2 control-label">CNPJ</label>

										<div class="col-md-8">
											<input id="cnpj" type="text" class="form-control" value="<?php echo (isset($user)) ? $user->cnpj : ''; ?>" name="cnpj"/>
										</div>
									</div>

									<div class="form-group">
										<label for="responsavel" class="col-md-2 control-label">Nome Responsável</label>

										<div class="col-md-8">
											<input id="responsavel" type="text" class="form-control" value="<?php echo (isset($user)) ? $user->responsavel : ''; ?>" name="responsavel" required/>
										</div>
									</div>

									<div class="form-group">
										<label for="descricao" class="col-md-2 control-label">Descrição</label>

										<div class="col-md-8">
											<textarea id="descricao" type="text" class="form-control" value="" name="descricao" ><?php echo (isset($user)) ? $user->descricao : ''; ?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label for="telefone" class="col-md-2 control-label">Fone</label>
										<div class="col-md-2">
											<input id="telefone" type="tel" class="form-control" value="<?php echo (isset($user)) ? $user->telefone : ''; ?>" name="telefone" />
										</div>

										<label for="telefone2" class="col-md-1 control-label">Fone 2</label>
										<div class="col-md-2">
											<input id="telefone2" type="tel" class="form-control" value="<?php echo (isset($user)) ? $user->telefone2 : ''; ?>" name="telefone2" />
										</div>

										<label for="celular" class="col-md-1 control-label">Cel.</label>
										<div class="col-md-2">
											<input id="celular" type="tel" class="form-control" value="<?php echo (isset($user)) ? $user->celular : ''; ?>" name="celular" />
										</div>
									</div>
									

									<div class="form-group">
										<label for="cep" class="col-md-2 control-label">CEP</label>

										<div class="col-md-8">
											<input id="cep" type="tel" class="form-control" value="<?php echo (isset($user)) ? $user->cep : ''; ?>" name="cep" required />
										</div>
									</div>

									<div class="form-group">
										<label for="endereco" class="col-md-2 control-label">Endereço</label>

										<div class="col-md-8">
											<textarea id="endereco" type="text" class="form-control" value="" name="endereco" ><?php echo (isset($user)) ? $user->endereco : ''; ?></textarea>
										</div>
									</div>

									<div class="form-group">
										<label for="bairro" class="col-md-2 control-label">Bairro</label>

										<div class="col-md-8">
											<input id="bairro" type="text" class="form-control" value="<?php echo (isset($user)) ? $user->bairro : ''; ?>" name="bairro" >
										</div>
									</div>

									<div class="form-group">
										<label for="numero" class="col-md-2 control-label">Número</label>

										<div class="col-md-8">
											<input id="numero" type="text" class="form-control" value="<?php echo (isset($user)) ? $user->numero : ''; ?>" name="numero" >
										</div>
									</div>

									<div class="form-group">
										<label for="complemento" class="col-md-2 control-label">Complemento</label>

										<div class="col-md-8">
											<input id="complemento" type="text" class="form-control" value="<?php echo (isset($user)) ? $user->complemento : ''; ?>" name="complemento" >
										</div>
									</div>

									<div class="form-group">
										<label for="estado" class="col-md-2 control-label">Estado</label>

										<div class="col-md-8">
											<select id="estado" type="text" class="form-control select2"  name="estado" required>
												@foreach($estados as $estado)
											     <option <?php if(isset($user) && $estado->id == $user->estado) echo 'selected'; ?>  value="{{ $estado->id }}">{{ $estado->sigla}}</option>
											    @endforeach
											</select>
										</div>
									</div>

									<div class="form-group">
										<label for="cidade" class="col-md-2 control-label">Cidade</label>

										<div class="col-md-8">
										
											<select id="cidade" type="text" class="form-control select2"  name="cidade" required>

												@foreach($cidades as $cidade)
											     <option <?php if(isset($user) && $cidade->id == $user->cidade) echo 'selected'; ?> value="{{ $cidade->id }}">{{ $cidade->cidade}}</option>
											    @endforeach
											</select>
										</div>
									</div>


									<div class="form-group">

										<label for="hora_inicio_manha" class="col-md-2 control-label">Hora Inicio Manhã</label>

										<div class="col-md-3">
											<input id="hora_inicio_manha" type="time" class="form-control" value="<?php echo (isset($user)) ? $user->hora_inicio_manha : ''; ?>" name="hora_inicio_manha" >
										</div>

										<label for="hora_fim_manha" class="col-md-2 control-label">Hora Fim Manhã</label>

										<div class="col-md-3">
											<input id="hora_fim_manha" type="time" class="form-control" value="<?php echo (isset($user)) ? $user->hora_fim_manha : ''; ?>" name="hora_fim_manha">
										</div>
									</div>

									<div class="form-group">

										<label for="hora_inicio_tarde" class="col-md-2 control-label">Hora Inicio Tarde</label>

										<div class="col-md-3">
											<input id="hora_inicio_tarde" type="time" class="form-control" value="<?php echo (isset($user)) ? $user->hora_inicio_tarde : ''; ?>" name="hora_inicio_tarde" >
										</div>

										<label for="hora_fim_tarde" class="col-md-2 control-label">Hora Fim Tarde</label>

										<div class="col-md-3">
											<input id="hora_fim_tarde" type="time" class="form-control" value="<?php echo (isset($user)) ? $user->hora_fim_tarde : ''; ?>" name="hora_fim_tarde">
										</div>
									</div>

									<div class="form-group">

										<label for="hora_inicio_noite" class="col-md-2 control-label">Hora Inicio Noite</label>

										<div class="col-md-3">
											<input id="hora_inicio_noite" type="time" class="form-control" value="<?php echo (isset($user)) ? $user->hora_inicio_noite : ''; ?>" name="hora_inicio_noite" >
										</div>

										<label for="hora_fim_tarde" class="col-md-2 control-label">Hora Fim Noite</label>

										<div class="col-md-3">
											<input id="hora_fim_noite" type="time" class="form-control" value="<?php echo (isset($user)) ? $user->hora_fim_noite : ''; ?>" name="hora_fim_noite">
										</div>
									</div>

									<div class="form-group">
										<label class="col-md-7 col-md-offset-2"  for="input-geocode">
											<h2>Localização no Mapa</h2>
											<span>
												Preencha seu endereço no campo de endereço, e com o auxílio do mapa, mova o PIN vermelho para o ponto exato do seu local no mapa.
												<b>Preencha os dados que ficarem faltantes (Ex: número, sala, ...).</b>
											</span>
										</label>
										<div class="localizacaoExataMapa col-md-8 col-md-offset-2">
											<div class="campos" style="width:100%; margin-right:0px;">
												<input type="text"  id="enderecoGmaps" class="form-control" required />
												<div id="mapa" style="width: 100%; height: 400px;"></div>
											</div>
										</div>
									</div>

									<div class="form-group" style="display:none;">
										<label class="col-md-3 control-label" for="input-geocode">Latitude e longitude</label>
										<div class="col-md-4">
										<input type="text" name="latitude" data-lat="<?php echo (isset($user)) ? $user->latitude : ''; ?>"  value="<?php echo (isset($user)) ? $user->latitude : ''; ?>" id="latitude" class="form-control" required />
										</div>
										<div class="col-md-4">
											<input type="text" name="longitude"  data-log="<?php echo (isset($user)) ? $user->longitude : ''; ?>"  value="<?php echo (isset($user)) ? $user->longitude : ''; ?>" id="longitude" class="form-control" required />
										</div>
									</div>

									<script type="text/javascript" src='https://maps.google.com/maps/api/js?libraries=places&key=AIzaSyCFBn3jbRWy7hU7-QLfn5V0HdPxDJFhHEA'></script>

									<script src="<?php echo URL('locationpicker.jquery.js');?>"></script>

									<script type="text/javascript">
										
										if(($("#longitude").val() != '') || ($("#longitude").val() != '')){
											var lat = $("#latitude").val();
											var lng = $("#longitude").val();
											var zoom = 18;
										} else {
										  var lat = -15.753151;
										  var lng = -47.8802272;
										  var zoom = 15;
										}

										$('#mapa').locationpicker({
										  location: {latitude: lat, longitude: lng},
										  radius: 10,
										  zoom: zoom,
										  inputBinding: {
										        latitudeInput: $('#latitude'),
										        longitudeInput: $('#longitude'),
										        locationNameInput: $('#enderecoGmaps')
										    },
										  enableAutocomplete: true,
										  onchanged: function (currentLocation, radius, isMarkerDropped) {
										     // var addressComponents = $(this).locationpicker('map').location.addressComponents;
										      //updateControls(addressComponents);
										  },
										});

									</script>



									<div class="form-group">
										<label for="password" class="col-md-2 control-label">Senha</label>

										<div class="col-md-8">
											<input id="password" type="password" class="form-control" value="" name="password" required/>
										</div>
									</div>


									<div class="form-group">
										<label for="passwordrepeat" class="col-md-2 control-label">Redigitar Senha</label>

										<div class="col-md-8">
											<input id="passwordrepeat" type="password" class="form-control" value="" name="passwordrepeat" required/>
										</div>
									</div>

									<?php if(!Sentinel::getUser()->inRole('admins')){ ?>
										<input type="hidden" name="id_role" value="<?php echo (isset($user)) ? $user->roleUser->role->id : $userLogado->roleUser->role->id; ?>">
									<?php }else{ ?>
										<div class="form-group">
											<label for="id_role" class="col-md-2 control-label">Grupo</label>
											<div class="col-md-8">
												<select id="id_role" class="form-control select2" name="id_role">
													<?php foreach ($roles as $role): ?>
														<?php if(isset($user)){
																	if($user->roleUser->role->id == $role->id){
																		$selected = 'selected';
																	}else{
																		$selected = '';
																	}
															   }else if($role->name == 'Clínicas'){ $selected = 'selected'; }
														else{ $selected = ''; } ?>
														<option <?php echo $selected; ?> value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
													<?php endforeach ?>
												</select>
											</div>
										</div>
									<?php } ?>
								</div>


							</form>
							<?php if(isset($user)){ ?>
								<div id="image-tab" class="tab-pane fade">
									<script>
										var image_campo = 'thumbnail_principal';
									</script>
									<div class="form-horizontal">
										<div class="form-group">
											<label for="image" class="col-md-3 control-label">Imagem</label>
											<div class="col-md-7">
												<form action="{{ url('admin/users/upload') }}" method="post" class="form single-dropzone" id="my-dropzone" enctype="multipart/form-data">
													<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
													<div id="img-thumb-preview">
														<img id="img-thumb" class="user size-lg img-thumbnail img-responsive" src="<?php echo (isset($user) && $user->thumbnail_principal != '') ? url('/uploads/users/'.$user->id.'/'.$user->thumbnail_principal) : 'http://placehold.it/300x100'; ?>">
													</div>
													<button type="button" style="display:none;" id="crop-image" class="btn btn-success">Salvar Corte</button>
													<button id="upload-submit" class="btn btn-default margin-t-5"><i class="fa fa-upload"></i> Enviar Imagem</button>
												</form>
												<form class="hidden" action="{{ url('admin/users/crop') }}" id="cropForm" method="POST">
													<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
													<input type="hidden" name="data_crop">
													<input type="hidden" name="file_name">
												</form>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
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

	function validaFormulario(form){

		if (document.getElementById('password').value == document.getElementById("passwordrepeat").value){
			return true;
		} else {
			alert("As senhas não conferem!")
			return false;
		}
	}

	$(document).ready(function(){

		$('[name="estado"]').on('change', function(){
			//alert(this.value);
			if( $('[name="estado"]').val() ) {
				$.getJSON(  '/admin/users/busca_cidades?estado=' + $('[name="estado"]').val() , function(result){
			    	var options = '<option value=""></option>';	
					for (var i = 0; i < result.length; i++) {
						options += '<option value="' + result[i].id + '">' + result[i].cidade + '</option>';
					}	
					$('#cidade').html(options).show();
			    });
			} else {
				$('#estado').html('<option value=""> Escolha um estado</option>');
			}

			
		});

		$('[name="id_role"]').change(function(){
			var id_role = $(this).find('option:selected').val();
			if(id_role == 2){
				$('[name="id_empresa"]').attr('disabled', false);
			}else{
				$('[name="id_empresa"]').attr('disabled', true);
			}
		});
		$('#telefone').mask('(99)9999-9999');
		$('#telefone2').mask('(99)9999-9999');
		$('#celular').mask('(99)99999-9999');
		$('#cep').mask('99999-999');
		$('#cnpj').mask('99.999.999/9999-99');

	});
</script>
@endsection
