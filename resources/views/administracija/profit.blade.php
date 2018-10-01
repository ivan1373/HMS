@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>GRAF PROFITA  PO REZERVACIJAMA</h1>
</div>
@endsection
@section('content')
<div class="container">
<div class="card">
        <!-- /.card-header -->
      <div class="card-body d-flex justify-content-center">
      <div id="columnchart_values"></div>
    </div>
  <!-- /.card-body -->
</div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Kraj Rezervacije", "Iznos u BAM", { role: "style" } ],
        @foreach ($rezervacije as $rezervacija)
        [ "{{ $rezervacija->datum_do }}", {{ $rezervacija->iznos }}, '#17A2B8' ], 
        @endforeach
        //["Copper", 8.94, "#b87333"],
        
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        //title: "Density of Precious Metals, in g/cm^3",
        width: 600,
        height: 450,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
    
</script>
@endsection