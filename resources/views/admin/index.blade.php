@extends($current_template)

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Dashboard
			<small><?php echo $current_role->name; ?></small>
		</h1>

	</section>

	<!-- Main content -->
	<section class="content">

<!--Mostra o dashboard das Clinicas, que msotra as consultas que devem ser aceitas ou rejeitadas------------------>
		<?php if($current_role->slug != 'admins'){ ?>
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<div class="col-md-8">

					<!-- TABLE: LATEST ORDERS -->
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Melhores avaliados</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table class="table no-margin">
									<thead>
										<tr>
											<th>Fornecedor</th>
											<th>Avaliação</th>
											<th>Data</th>
											<th>Ação</th>
										</tr>
									</thead>
									<tbody>
									<?php /*
										<?php  if(count($consultas)>0) {foreach ($consultas as $consulta): ?>
											<tr>											
													<td><a href="{{ url('admin/gerenciamento-de-clientes/edit/'.$consulta->id_cliente) }}"><?php echo $consulta->nome; ?></a></td>
													<td class='clickable-row' data-href='{{ url('admin/consultas/edit/'.$consulta->id_consulta) }}'><?php echo $consulta->nome_tipo; ?></td>
													<td class='clickable-row' data-href='{{ url('admin/consultas/edit/'.$consulta->id_consulta) }}'>
														<?php echo ($consulta->datahorario) ? date_format(date_create($consulta->datahorario), 'd/m/Y H:i') : ''; ?></td>
													<td>
														<a href="/admin/aceitar/<?php echo $consulta->id_consulta; ?>" onclick="if(!confirm('Tem certeza que deseja aceitar essa consulta?')){return false;};" class="btn btn-success"><i class="ion-checkmark"></i></a>
													
														<?php /*<a href="/admin/rejeitar/<?php echo $consulta->id; ?>" onclick="if(!confirm('Tem certeza que deseja rejeitar essa consulta?')){return false;};" class="btn btn-danger"  ><i class="ion-close"></i></a>
														?>

														<input style="display:none" id="inputRej" value="<?php echo $consulta->id_consulta; ?>">

														<a class="btn btn-danger" 
															href="/admin/rejeitar/<?php echo $consulta->id_consulta; ?>" onclick="if(!confirm('Tem certeza que deseja rejeitar essa consulta?')){return false;};" class="btn btn-success"
															id="<?php echo $consulta->id_consulta; ?>" 
															data-target="#modalJustificativa" ><i class="ion-close"></i></a>
													</td>
											</tr>
										<?php  endforeach; }?>
										*/?>
									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
						</div>


						<!-- modal de justificativa-->
						<!--div class="modal fade" id="modalJustificativa" 
						     tabindex="-1" role="dialog" 
						     aria-labelledby="favoritesModalLabel">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" 
						          data-dismiss="modal" 
						          aria-label="Close">
						          <span aria-hidden="true">&times;</span></button>
						        <h4 class="modal-title" 
						        id="favoritesModalLabel">Digite uma justificativa para sua recusa</h4>
						      </div>
						      <div class="modal-body">
						      	<textarea id="justificativa" class="form-control textarea-modal" placeholder="Digite aqui..." required> </textarea>
						      </div>
						      <div class="modal-footer">

						        <button type="button" 
						           class="btn btn-default" 
						           data-dismiss="modal">Cancelar</button>
						        
						        <div id="botao-justificativa" data="" class="btn btn-primary">Enviar</div>
						        
						      </div>
						    </div>
						  </div>
						</div-->


						<!-- /.box-body -->
						<div class="box-footer clearfix">

							<a href="{{ url('admin/consultas') }}" class="btn btn-sm btn-default btn-flat pull-right">Ver todos agendamentos</a>
						</div>
						<!-- /.box-footer -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->

				<div class="col-md-4">


					<!-- PRODUCT LIST -->
					<div class="box box-primary">
						<div class="box-header with-border">
							<h3 class="box-title">Últimos cadastrados</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>

							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table class="table no-margin">
									<thead>
										<tr>
											<th>Cliente</th>
											<th>Data</th>
										</tr>
									</thead>
									<tbody>
										<?php if(isset($consultas_hoje) && count($consultas_hoje)>0) {foreach ($consultas_hoje as $consulta): ?>
											<tr onclick="location.href='{{ url('admin/consultas/edit/'.$consulta->id_consulta) }}'">											
													<td><?php echo $consulta->nome; ?></td>
													<td>
														<?php echo ($consulta->datahorario) ? date_format(date_create($consulta->datahorario), 'd/m/Y H:i') : ''; ?></td>
											</tr>
										<?php endforeach; }?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- /.box -->
					</div>
					<!-- /.col -->
				</div>
				<!-- /.row -->
				<?php } ?>







<!--Mostra o dashboard ADMIN, que msotra as notcias que devem ser aceitas ou rejeitadas------------------>

		<?php if($current_role->slug == 'admins'){ ?>
			<!-- Main row -->
			<div class="row">
				<!-- Left col -->
				<div class="col-md-8">

				<?php /*

					<!-- TABLE: LATEST ORDERS -->
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Notícias criadas pelas clínicas</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
							</div>
						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table class="table no-margin">
									<thead>
										<tr>
											<th>Clinica</th>
											<th>Título</th>
											<th>Data Criação</th>
											<th>Ação</th>
										</tr>
									</thead>
									<tbody>
									
										<?php if(count($noticias)>0) {foreach ($noticias as $noticia): ?>
											<tr >											
													<td class='clickable-row' data-href='{{ url('admin/noticias/edit/'.$noticia->id) }}' > <?php echo $noticia->nome_clinica; ?></td>
													<td class='clickable-row' data-href='{{ url('admin/noticias/edit/'.$noticia->id) }}'><?php echo $noticia->titulo; ?></td>
													<td class='clickable-row' data-href='{{ url('admin/noticias/edit/'.$noticia->id) }}'>
														<?php echo ($noticia->criado_em) ? date_format(date_create($noticia->criado_em), 'd/m/Y H:i') : ''; ?></td>
													<td>
														<a href="/admin/aceitar_noticia/<?php echo $noticia->id; ?>" onclick="if(!confirm('Tem certeza que deseja enviar essa notícia?')){return false;};" class="btn btn-success"><i class="ion-checkmark"></i></a>
													
														<a href="/admin/rejeitar_noticia/<?php echo $noticia->id; ?>" onclick="if(!confirm('Tem certeza que deseja rejeitar essa notícia?')){return false;};" class="btn btn-danger"  ><i class="ion-close"></i></a>
														<a href="{{ url('admin/noticias/edit/'.$noticia->id) }}" class="btn btn-warning"  >VER</a>
														
													</td>
											</tr>
										<?php endforeach; }?>
										
									</tbody>
								</table>
							</div>
							<!-- /.table-responsive -->
						</div>




						<!-- /.box-body -->
						<div class="box-footer clearfix">

							<a href="{{ url('admin/noticias') }}" class="btn btn-sm btn-default btn-flat pull-right">Ver todas as  notícias</a>
						</div>
						<!-- /.box-footer -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->

			*/?>
				
				<!-- /.row -->
				<?php } ?>



			</section>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<script type="text/javascript">

	
			$(".clickable-row").click(function() {
		        window.location = $(this).data("href");
		    });

		    var product = $('a[href="#modal-form-edit"]').data('id');

		    $('#modalJustificativa').on('show.bs.modal', function(e) {
			  var product = $(e.relatedTarget).data('id');
			  $("#product_name").val(product);
			});

			var idConsultaSelecionada = '';

		    $(document).ready(function(){

		    	$('#modalJustificativa').on('show.bs.modal', function(e) {

			        var $modal = $(this),
			        esseyId = e.relatedTarget.id;
					idConsultaSelecionada = esseyId; 
			        
			    })

			    $("#botao-justificativa").click(function(){
		    		if($("#justificativa").val() == ' ' || $("#justificativa").val() == ''){
		    			alert('Você deve digitar uma justificativa.');
		    		}
		    		else{
		    			var data = {id: idConsultaSelecionada,justificativa: $("#justificativa").val()};
		    			console.log(data);
		    			$.ajax({
						  type: "POST",
						  url: '/admin/rejeitar',
						  data: data,
						  success: success,
						});
		    			function success(data, status){
		    				$('.modal').modal('toggle');
		    				 
            				alertUtil.alertSuccess('Consulta rejeitada com sucesso!');
		    				
					        setTimeout(function() {location.reload();}, 1000);
					    }
					}
			    });

			    var tamanholista = null;

			    setInterval(function(){
			    	$.ajax({
			    		type: "GET",
			    		url: "admin/verifica_atualizar",
			    		success: success,
			    		error: error
			    	})
			    	function success(data, status){

			    		if(tamanholista = null)
			    			tamanholista = data; 

			    		var tamanhoListaAtual = data;

			    		if(tamanhoListaAtual != tamanholista){
			    			location.reload();
			    		}

				    	tamanholista = tamanhoListaAtual;
			    		
			    	}
			    	function error(e){

			    	}
			    }, 20000);


		    });

		</script>



		@endsection
