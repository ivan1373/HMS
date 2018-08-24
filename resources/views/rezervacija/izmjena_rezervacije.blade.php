@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>IZMJENA DETALJA REZERVACIJE</h1>
</div>
@endsection
@section('content')
<br>
<div class="container">
    <!-- general form elements -->
    <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">Izmjena Rezervacije</h3>
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
              <form method="post" action="{{ url('/admin/rezervacije/izmjena_rez')}}/{{$rezervacija->id}}" role="form">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Ime Gosta</label>
                    <input type="text" class="form-control" name="ime" value="{{$rezervacija->ime}}">
                  </div>
                  <div class="form-group">
                    <label>Prezime Gosta</label>
                    <input type="text" class="form-control" name="prezime" value="{{$rezervacija->prezime}}">
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