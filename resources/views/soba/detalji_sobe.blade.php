@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>DETALJI O SOBI&nbsp;<b>{{ $soba->naziv }}</b></h1>
</div>
@endsection
@section('content')
<br>
<div class="container">
    <!-- general form elements -->
    <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">Detalji</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                    <ul class="list-group list-group-flush text-center">
                        <li class="list-group-item">
                            <h5>Naziv Sobe:   {{ $soba->naziv }}</h5>
                        </li>
                        <li class="list-group-item">
                            <h5>Opis Sobe:   {{ $soba->opis }}</h5>
                        </li>
                        <li class="list-group-item">
                            <h5>Broj Kreveta:   {{ $soba->brkreveta }}</h5>
                        </li>
                        <li class="list-group-item">
                            <h5>Balkon: {{ $soba->balkon == '1' ? 'DA' : 'NE'}}</h5>
                        </li>
                        @if($soba->status == 1)
                        <li class="list-group-item">
                            <h5>Rezervirano na: {{ $rezervacija->ime }} {{ $rezervacija->prezime }}</h5>
                        </li>
                        <li class="list-group-item">
                            <h5>Rezervirana do: {{ $krajRez }}</h5>
                        </li>
                        @endif
                        <li class="list-group-item">
                            <h5><i class="fa fa-wifi"></i>&nbsp;&nbsp;<i class="fa fa-shower"></i>&nbsp;&nbsp;<i class="fa fa-tv"></i>&nbsp;&nbsp;<i class="fa fa-coffee"></i></h5>
                        </li>
                    </ul>
                </div>
                <div class="card-footer">
                <a href="{{url('/admin/sobe')}}" class="btn btn-success">Natrag <i class="fa fa-backward"></i></a>
                </div>
              
</div>
                <!-- /.card-body -->
</div>
@endsection