@extends($current_template)

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Grupos
        <small>Listagem</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('admin') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Grupos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <a href="{{ url('admin/roles/add') }}" class="table-add"><i class="fa fa-plus"></i> Adicionar</a>
              <hr>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list-data-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nome</th>
                  <th class="th-action">Ação</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($listaRole as $role): ?>
                    <tr>
                      <td> <?php echo $role->name; ?></td>
                      <td>
                        <a href="/admin/roles/edit/<?php echo $role->id; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                        <a href="/admin/roles/delete/<?php echo $role->id; ?>" class="btn btn-danger deletar"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Nome</th>
                    <th>Ação</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <a href="{{ url('admin/roles/add') }}" class="table-add"><i class="fa fa-plus"></i> Adicionar</a>
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
