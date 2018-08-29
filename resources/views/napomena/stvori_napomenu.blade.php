@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>DODAVANJE NAPOMENE</h1>
</div>
@endsection
@section('content')
<br>
<div class="container">
    <!-- general form elements -->
    <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">Napomena</h3>
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
              <form role="form" method="post" action="{{url('/admin/stvori_napomenu')}}">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Naslov</label>
                    <input type="text" class="form-control" name="naslov">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Sadržaj</label>
                    <textarea class="form-control" rows="5" name="tekst"></textarea>
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
</div>
@endsection