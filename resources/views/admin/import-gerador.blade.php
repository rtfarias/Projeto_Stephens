@extends($current_template)

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Importar
			<small>SQL</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="{{ url('/admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
			<li><a href="{{ url('/admin/gerador') }}"> Gerador</a></li>
			<li class="active">Importar SQL</li>
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

						</ul>
						<div class="spacer"></div>
						<form id="mainForm" class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{ url('/admin/gerador/import-sql') }}">
							<div class="tab-content">
								<div id="info-tab" class="tab-pane fade in active">
									{{ csrf_field() }}

									<div class="form-group">
										<label for="label" class="col-md-3 control-label">Arquivo SQL</label>

										<div class="col-md-7">
											<input id="label" type="file" name="sql" />
										</div>
									</div>

								</div>
							</div>
						</form>
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
	
</script>
@endsection
