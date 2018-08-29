@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>OSOBNE POSTAVKE</h1>
</div>
@endsection
@section('content')
<br>
<div class="container">
    <!-- general form elements -->
    <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">Promijenite osobne postavke</h3>
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
              <form role="form" method="post" action="{{url('/admin/osobne_postavke/')}}/{{Auth::user()->id}}">
              @csrf
              
                <div class="card-body">
                  <div class="form-group">
                    <label>Ime</label>
                    <input type="text" class="form-control" name="ime" value="{{Auth::user()->name}}">
                  </div>
                  <div class="form-group">
                    <label>E-mail</label>
                    <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}">
                  </div>
                  <div class="form-group">
                    <label>Lozinka</label>
                    <input type="text" class="form-control" name="lozinka" placeholder="unesite novu lozinku...">
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