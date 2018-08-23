@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>DOBRODOŠLI</h1>
</div>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $brSoba }}</h3>
                <p>Broj Slobodnih Soba</p>
              </div>
              <div class="icon">
                <i class="fa fa-bed"></i>
              </div>
              <a href="{{url('/admin/sobe')}}" class="small-box-footer">Više informacija <i class="fa fa-info"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $brKorisnika }}</h3>
                <p>Broj Korisnika</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{url('/admin/pregled_korisnika')}}" class="small-box-footer">Više informacija <i class="fa fa-info"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $brNapomena }}</h3>
                <p>Broj Napomena</p>
              </div>
              <div class="icon">
                <i class="fa fa-book"></i>
              </div>
              <a href="{{url('/admin/napomene')}}" class="small-box-footer">Više informacija <i class="fa fa-info"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $brojZ }}</h3>
                <p>Aktivne Rezervacije</p>
              </div>
              <div class="icon">
                <i class="fa fa-bell"></i>
              </div>
              <a href="{{url('/admin/rezervacije')}}" class="small-box-footer">Više informacija <i class="fa fa-info"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section><br><br>
    <!-- TO DO List -->
    <div class="container-fluid"><br>
      <div class="row">
      <div class="clearfix"></div>
        <div class="col-md-6">
          <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
              <h4 class="text-center">Odnos soba s obzirom na broj kreveta</h4>
              <div style="height: 500px; width: 100%;" id="myPieChart"></div>
              </div>
              <!-- /.card-body -->
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
              <h4 class="text-center">Odnos korisnika s obzirom na vrstu računa</h4>
              <div style="height: 500px; width: 100%;" id="myPieChart2"></div>
              </div>
              <!-- /.card-body -->
          </div>
        </div><br>
      </div><br><br>
      <div class="row">
        <div class="col-sm-6">
          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-bell mr-1"></i>
                  Današnje Rezervacije
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn bg-success btn-sm" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-danger btn-sm" data-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="list-group">
                  @forelse($rezervacije as $rezervacija)
                  <li class="list-group-item">
                  <h5 class="cite"><i class="fa fa-user"></i> {{$rezervacija->ime}}, <i class="fa fa-bed"></i> {{$rezervacija->soba->naziv}}, datum dolaska gosta: {{$rezervacija->datum_od}}</h5>
                  </li>
                  @empty
                    <p>Danas nema novih rezervacija!</p>
                  @endforelse
                </ul>
              </div>
              <!-- /.card-body -->
              
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-book mr-1"></i>
                  Današnje Napomene
                </h3>
                <div class="card-tools">
                  <button type="button" class="btn bg-success btn-sm" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-danger btn-sm" data-widget="remove">
                    <i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="list-group">
                  @forelse($napomene as $napomena)
                  <li class="list-group-item">
                  <h5 class="cite"><i class="fa fa-user"></i> {{$napomena->user->name}}, <i class="fa fa-note"></i> {{$napomena->naslov}}, {{$napomena->created_at->diffForHumans()}}</h5>
                  </li>
                  @empty
                    <p>Danas nema novih napomena!</p>
                  @endforelse
                </ul>
              </div>
              <!-- /.card-body -->
              
          </div>
        </div>
      </div>
    </div><br>
   
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart() {
      // Define the chart to be drawn.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Element');
      data.addColumn('number', 'Percentage');
      data.addRows([
        ['Jednokrevetne', <?php echo $jednokrevetne; ?>],
        ['Dvokrevetne', <?php echo $dvokrevetne; ?>],
        ['Trokrevetne', <?php echo $trokrevetne; ?>]
      ]);
      var options = {
            //title: 'Odnos soba s obzirom na broj kreveta',
            curveType: 'function',
            legend: { position: 'top' },
            pieHole: 0.4,
            
        };

      // Instantiate and draw the chart.
      var chart = new google.visualization.PieChart(document.getElementById('myPieChart'));
      chart.draw(data, options);
    }
    function drawChart2() {
      // Define the chart to be drawn.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Element');
      data.addColumn('number', 'Percentage');
      data.addRows([
        ['Regular', <?php echo $regular; ?>],
        ['Administrator', <?php echo $admin; ?>],
        ['SuperAdministrator', <?php echo $super; ?>]
      ]);
      var options = {
            //title: 'Odnos korisnika s obzirom na vrstu računa',
            curveType: 'function',
            legend: { position: 'top' },
            pieHole: 0.4,
            
        };

      // Instantiate and draw the chart.
      var chart = new google.visualization.PieChart(document.getElementById('myPieChart2'));
      chart.draw(data, options);
    }

    
  </script>
    
    <!-- /.content -->
@endsection