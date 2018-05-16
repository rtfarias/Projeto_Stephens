<!-- Logo -->
<a href="{{ url('admin') }}" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>P</b>I</span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>Stephen</b> Viagens</span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->

  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>

  </a>

  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Notifications: style can be found in dropdown.less -->
      <li class="dropdown notifications-menu" style="display:none">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-bell-o"></i>
          <span class="label label-warning">10</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have 10 notifications</li>
          <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
              <li>
                <a href="#">
                  <i class="fa fa-users text-aqua"></i> 5 new members joined today
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="fa fa-users text-aqua"></i> 5 new members joined today
                </a>
              </li>
            </ul>
          </li>
          <li class="footer"><a href="#">View all</a></li>
        </ul>
      </li>

        <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{ (Sentinel::getUser()->thumbnail_principal != '') ? 'uploads/users/'.Sentinel::getUser()->thumbnail_principal : 'img/logo.jpg' }}" class="user-image" alt="User Image">
          <span class="hidden-xs">{{ Sentinel::getUser()->first_name }}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="{{ (Sentinel::getUser()->thumbnail_principal != '') ? 'uploads/users/'.Sentinel::getUser()->thumbnail_principal : 'img/logo.jpg' }}" class="img-circle" alt="User Image">

            <p>
              {{ Sentinel::getUser()->first_name.' '.Sentinel::getUser()->last_name }}
              <small>Membro desde <?php echo date('M',strtotime(Sentinel::getUser()->created_at)); ?>. <?php echo date('Y',strtotime(Sentinel::getUser()->created_at)); ?></small>
            </p>
          </li>

          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="{{ url('admin/users/edit/'.Sentinel::getUser()->id) }}" class="btn btn-default btn-flat">Perfil</a>
            </div>
            <div class="pull-right">
              <a href="{{ url('admin/logout') }}" class="btn btn-default btn-flat">Sair</a>
            </div>
          </li>
        </ul>
      </li>


      <!-- Control Sidebar Toggle Button -->
      <!--li>
        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
      </li-->
    </ul>
  </div>
</nav>
