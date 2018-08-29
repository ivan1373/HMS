@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>REZERVACIJA</h1>
</div>
@endsection
@section('content')
<br>
<div class="container">
    <!-- general form elements -->
    <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">Rezervacija Sobe</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              @if($errors->any())
              <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
                <ul>
                  @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                  @endforeach
                </ul>
                
              </div>
              @endif
              <form method="post" action="{{ url('/admin/nova_rez') }}" role="form">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Odaberite Sobu</label>
                    <select name="id_sobe" class="form-control" style="width: 100%;">
                      @foreach($sobe as $soba)
                        <option value="{{$soba->id}}">Naziv Sobe: <b>{{$soba->naziv}}</b>, Broj Kreveta: <b>{{$soba->brkreveta}}</b>, Balkon: <b>{{ $soba->balkon == '1' ? 'DA' : 'NE'}}</b></option>
                      @endforeach
                    </select>
                  </div>
                  <hr>
                  <div class="form-group">
                    <label>Ime Gosta</label>
                    <input type="text" class="form-control" placeholder="Unesite ime gosta..." name="ime">
                  </div>
                  <div class="form-group">
                    <label>Prezime Gosta</label>
                    <input type="text" class="form-control" placeholder="Unesite prezime gosta..." name="prezime">
                  </div>
                  <div class="form-group">
                    <label>Početak</label>
                    <input type="datetime-local" class="form-control" name="datum-od">
                  </div>
                  <div class="form-group">
                    <label>Kraj</label>
                    <input type="datetime-local" class="form-control" name="datum-do">
                  </div>
                  <div class="radio">
                    <label>Doručak <i class="fa fa-coffee"></i></label><br>
                    <input type="radio" value="DA" name="dorucak" checked>DA <br>
                    <input type="radio" value="NE" name="dorucak">NE
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Potvrdi <i class="fa fa-check"></i></button>
                  <button type="reset" class="btn btn-warning">Poništi <i class="fa fa-power-off"></i></button>
                </div>
              </form>
            @if(session()->has('spremanje'))
              
              <div class="alert alert-success">
                  <strong>{{session()->get('spremanje')}}</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    &times;</button>
              </div>
                  
            @endif
            
</div>
                <!-- /.card-body -->
</div>
@endsection