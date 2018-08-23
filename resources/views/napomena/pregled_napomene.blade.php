@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1 style="text-transform: uppercase;">{{ $napomena->naslov }}</h1>
  <cite>Autor: &nbsp;{{ $napomena->user->name }},&nbsp; {{ $napomena->created_at->diffForHumans() }}</cite><br><hr>
  <a class="btn btn-primary text-light" href="{{url('/admin/napomene')}}">Natrag <i class="fa fa-backward"></i></a>
</div>
@endsection
@section('content')
<br>
<div class="container text-center">
    <p><b>{{ $napomena->sadrzaj }}</b></p>
</div>
@endsection