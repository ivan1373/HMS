@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>DODAVANJE NOVOG KORISNIKA</h1>
</div>
@endsection
@section('content')
<br>
<div class="container">
    <!-- general form elements -->
    <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">Novi Zaposlenik</h3>
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
              <form role="form" method="post" action="{{url('/admin/dodaj_radnika')}}">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Ime</label>
                    <input type="text" name="name" class="form-control" placeholder="Unesite Ime">
                  </div>
                  <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" name="email" class="form-control" placeholder="Unesite E-mail adresu">
                  </div>
                  <div class="form-group">
                    <label>Lozinka</label>
                    <input type="text" name="password" class="form-control" placeholder="Unesite Lozinku">
                  </div>
                  <div class="form-group">
                  <label>Vrsta Korisnika</label>
                  <select name="role" class="form-control" style="width: 100%;">
                    <option selected="selected" value="Recepcioner">Regular</option>
                    <option value="Administrator">Administrator</option>
                  </select>
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