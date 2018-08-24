@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>IZMJENA PODATAKA</h1>
</div>
@endsection
@section('content')
<br>
<div class="container">
    <!-- general form elements -->
    <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">Soba {{$room->naziv}}</h3>
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
              <form method="post" action="{{ url('/admin/sobe/izmjena')}}/{{$room->id}}" role="form">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Naziv Sobe</label>
                    <input type="text" class="form-control" value="{{$room->naziv}}" name="naziv">
                  </div>
                  <div class="form-group">
                    <label>Kratak Opis</label>
                    <textarea class="form-control" name="opis" rows="4"></textarea>
                  </div>
                  <div class="form-group">
                    <label>Nova Cijena</label>
                    <input type="text" class="form-control" value="{{$room->cijena_nocenja}}" name="cijena">
                  </div>
                  <div class="form-group">
                  <label>Broj Kreveta</label>
                  <select name="brojKr" class="form-control" style="width: 100%;">
                    <option value="1" selected="selected">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                  </select>
                  </div><br>
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