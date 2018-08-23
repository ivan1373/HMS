@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>DODAVANJE NOVE SOBE</h1>
</div>
@endsection
@section('content')
<br>
<div class="container">
    <!-- general form elements -->
    <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">Nova Soba</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </ul>
                
              </div>
              @endif
              <form method="post" action="{{ url('/admin/dodaj_sobu')}}" role="form">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Naziv Sobe</label>
                    <input type="text" class="form-control" placeholder="Unesite naziv..." name="naziv">
                  </div>
                  <div class="form-group">
                    <label>Kratak Opis</label>
                    <textarea class="form-control" name="opis" rows="4"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Slika Sobe</label>
                    <input type="text" class="form-control" name="slika" aria-describedby="slikaHelp">
                    <small id="slikaHelp" class="form-text text-muted">Potrebno je unijeti URL adresu slike.</small>
                  </div>
                  <div class="form-group">
                  <label>Broj Kreveta</label>
                  <select name="brojKr" class="form-control" style="width: 100%;">
                    <option value="1" selected="selected">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                  </div><br>
                  <div>
                  <label>Balkon</label><br>
                  <input type="radio" value="DA" name="balkon" checked>DA <br>
                  <input type="radio" value="NE" name="balkon">NE
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Potvrdi <i class="fa fa-check"></i></button>
                  <button type="reset" class="btn btn-warning">Poništi <i class="fa fa-power-off"></i></button>
                </div>
              </form>
              @if(session()->has('spremanje'))
              
              <div style="background-color:#D4EDDA!important;color:green!important;" class="alert alert-success">
                  <strong>{{session()->get('spremanje')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
              </div>
                  
            @endif
            
</div>
                <!-- /.card-body -->
</div>
@endsection