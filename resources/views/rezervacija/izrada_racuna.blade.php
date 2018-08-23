@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>RAČUN</h1>
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
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fa fa-money"></i> račun
                    <small class="float-right">Datum: {{$danas}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  Blagajnik:
                  <address>
                    <strong>{{$rezervacija->user->name}}</strong><br>
                    Telefon: (111) 111-1111<br>
                    Email: {{$rezervacija->user->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  Klijent:
                  <address>
                    <strong>{{$rezervacija->ime}} {{$rezervacija->prezime}}</strong><br>
                    Telefon: (555) 555-5555<br>
                    Email: john.doe@example.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col"><br>
                  <b>Broj Rezervacije:</b> {{$rezervacija->id}}<br>
                  <b>Kraj Rezervacije:<b> {{$rezervacija->datum_do}}<br>
                  
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Količina</th>
                      <th>Usluga</th>
                      <th>Opis</th>
                      <th>Iznos po Jedinici</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>{{$brojDana}}</td>
                      <td>Najam Sobe</td>
                      <td>Lorem Ipsum</td>
                      <td>{{$rezervacija->soba->cijena_nocenja}} BAM</td>
                    </tr>
                    @if($rezervacija->dorucak)
                    <tr>
                      <td>{{$brojDana}}</td>
                      <td>Dorucak</td>
                      <td>Lorem Ipsum</td>
                      <td>7.50 BAM</td>
                    </tr>
                    @endif
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6"><br>
                  <p class="lead text-center">Posjetite nas opet!</p>
                   
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Iznos Do {{$rezervacija->datum_do}}</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Ukupno:</th>
                        <td>{{ $iznosBezPDV }} BAM</td>
                      </tr>
                      <tr>
                        <th>Porez (17%)</th>
                        <td>{{ $iznosBezPDV * 0.17}} BAM</td>
                      </tr>
                      <tr>
                        <th>Konačan Iznos:</th>
                        <td>{{ $konacanIznos }} BAM</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="{{ url('/admin/rezervacije/zavrsi/')}}/{{ $rezervacija->id }}" class="btn btn-primary float-right btnprn"><i class="fa fa-print"></i> Ispis</a>
                  
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