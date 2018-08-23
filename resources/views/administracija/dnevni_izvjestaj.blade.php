@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>IZVJEŠTAJ ZA DAN {{$datum}}</h1>
</div>
@endsection
@section('content')
<!-- Main content -->
<section class="content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row invoice-info">
                <div class="col-6 invoice-col text-center">
                  Izvještaj stvorio:
                  <address>
                    <strong>{{Auth::user()->name}}</strong><br>
                    Email: <b>{{Auth::user()->email}}</b>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-6 invoice-col text-center">
                  ID Korisnika:
                  <address>
                    <strong>{{Auth::user()->id}}</strong><br>
                    Vrsta Korisničkog Računa: <b>
                    @if( Auth::user()->isregular == '1' && Auth::user()->isadmin == '1' )
                    SUPERADMINISTRATOR
                    @elseif( Auth::user()->isregular && Auth::user()->isadmin != '1')
                    STANDARDNI
                    @else
                    ADMINISTRATOR
                    @endif </b>
                  </address>
                </div>
                <!-- /.col -->
              </div>
              <div class="row">
                <div class="col-12">
                  <table class="table table-striped text-center table-responsive">
                    <thead>
                    <tr>
                      <th>Točno Vrijeme</th>
                      <th>Novih Rezervacija</th>
                      <th>Novih Napomena</th>
                      <th>Novih Korisnika</th>
                      <th>Broj Slobodnih Soba</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>{{$vrijeme}}</td>
                      <td>{{$rezervacije}}</td>
                      <td>{{$napomene}}</td>
                      <td>{{$korisnici}}</td>
                      <td>{{$brSlobSoba}}/{{$brSoba}}</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="{{ url('/admin/izvjestaj')}}" class="btn btn-primary float-right btnprn"><i class="fa fa-print"></i> Ispis</a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    <!-- /.content -->
@endsection