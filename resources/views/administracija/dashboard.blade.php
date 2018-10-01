<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Projekt</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-info navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
            class="fa fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/admin/dashboard')}}" class="brand-link bg-dark">
      <img src="{{url('images/bbb.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><samp>Administracija</samp></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{url('images/aaa.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{url('/admin/osobne_postavke')}}" class="d-block">{{Auth::user()->name}}
          @if(Auth::user()->isAdmin())
           (Administrator)
          @elseif(Auth::user()->isRegular())
           (Standardni)
          @else
           (SuperAdmin)
          @endif
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <!--<li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Starter Pages
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>TTT</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>TTT</p>
                </a>
              </li>
              
            </ul>
          </li>-->
          @if(!Auth::user()->isRegular())
          <li class="nav-item">
                <a href="{{url('/admin')}}" class="nav-link">
                  <i class="fa fa-line-chart nav-icon"></i>
                  <p>Statistika</p>
                </a>
          </li>
          <li class="nav-item has-treeview menu-closed">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-bed"></i>
              <p>
                Sobe
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/admin/dodaj_sobu')}}" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Dodaj Sobu</p>
                </a>
              </li>
          @endif
          @if(!Auth::user()->isRegular())
              <li class="nav-item">
                <a href="{{url('/admin/sobe')}}" class="nav-link">
                  <i class="fa fa-search-plus nav-icon"></i>
                  <p>Pregled Soba</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-closed">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Korisnici
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/admin/dodaj_radnika')}}" class="nav-link">
                  <i class="fa fa-user-plus nav-icon"></i>
                  <p>Dodaj Korisnika</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/pregled_korisnika')}}" class="nav-link">
                  <i class="fa fa-users nav-icon"></i>
                  <p>Pregled Korisnika</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if(Auth::user()->isRegular())
          <li class="nav-item">
                <a href="{{url('/admin/sobe')}}" class="nav-link">
                  <i class="fa fa-search-plus nav-icon"></i>
                  <p>Pregled Soba</p>
                </a>
          </li>
          @endif
          <li class="nav-item has-treeview menu-closed">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-bell"></i>
              <p>
                Rezervacije
                
                @if($brojZ == 0)
                <i class="right fa fa-angle-left"></i>
                @else
                <span class="badge badge-warning right h-50">{{$brojZ}}</span>
                @endif
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/admin/nova_rez')}}" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Nova Rezervacija</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/rezervacije')}}" class="nav-link">
                  <i class="fa fa-calendar nav-icon"></i>
                  <p>Pregled Rezervacija</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-closed">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p>
                Napomene
                @if($napomene == 0)
                <i class="right fa fa-angle-left"></i>
                @else
                <span class="badge badge-info right h-50">{{$napomene}}</span>
                @endif
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/admin/stvori_napomenu')}}" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Dodaj Napomenu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/napomene')}}" class="nav-link">
                  <i class="fa fa-sticky-note nav-icon"></i>
                  <p>Pregled Napomena</p>
                </a>
              </li>
            </ul>
          </li>
          @if(Auth::user()->isSuperAdmin())
          <li class="nav-item">
                <a href="{{url('/admin/izvjestaj')}}" class="nav-link">
                  <i class="fa fa-file-pdf-o nav-icon"></i>
                  <p>Dnevni Izvještaj</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="{{url('/admin/profit')}}" class="nav-link">
                  <i class="fa fa-dollar nav-icon"></i>
                  <p>Profit</p>
                </a>
          </li>
          @endif
          <li class="nav-item">
                <a href="{{url('/')}}" class="nav-link">
                  <i class="fa fa-home nav-icon"></i>
                  <p>Početna Stranica</p>
                </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper bg-white">
    <!-- Content Header (Page header) -->
    @yield('header')
    <!-- /.content-header -->

    <!-- Main content -->
    <div id="app" class="content">
      @yield('content')
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5 class="text-center">{{Auth::user()->name}}</h5>
      <hr>
      <ul class="nav nav-sidebar">
          <li class="nav-item">
            <a href="{{url('/admin/osobne_postavke')}}" class="nav-link">
                <i class="fa fa-user-circle nav-icon"></i>
                <p>Osobne Postavke</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('logout') }}" class="nav-link">
                
                <i class="fa fa-sign-out nav-icon"></i>
                <p>Odjava</p>
            </a>
          </li>
      </ul>
    </div>
  </aside> 
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer bg-light no-print">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Završni rad Ivan Miloš 2018
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2018 <a href="#">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
    
  });

  $('.btnprn').printPage();

  $("table").tablesorter();
  
  
});
</script>

  
</body>
</html>
