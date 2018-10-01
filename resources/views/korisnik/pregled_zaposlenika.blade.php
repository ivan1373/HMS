@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>PREGLED KORISNIKA</h1>
</div>
@endsection
@section('content')
<div id="users" class="container-fluid">
  <div class="row">
  @foreach($users as $user)
    <div class="col-sm-4" align="center">
      <div class="card shadow" style="width: 15rem;">
        <img class="card-img-top" style="border:1px solid lightgray;" src="{{url('images/user1.png')}}" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">{{ $user->name }} <i class="fa fa-star {{($user->isadmin && $user->isregular) ? 'text-warning':'text-info'}}"></i></h5><hr>
              <p class="card-text">e-mail adresa: &nbsp;<cite>{{ $user->email }}</cite></p>
              <p id="rola" class="card-text">vrsta računa:&nbsp;
                  @if( $user->isregular == '1' && $user->isadmin == '1' )
                  SUPERADMINISTRATOR
                  @elseif( $user->isregular && $user->isadmin != '1')
                  STANDARDNI
                  @else
                  ADMINISTRATOR
                  @endif
              </p>
              <a href="{{ url('/admin/pregled_korisnika/detalji/') }}/{{$user->id}}" class="btn btn-info">Detalji/ Postavke <i class="fa fa-info"></i></a><hr>
              <form method="post" action="{{ url('/admin/pregled_korisnika/brisi/')}}/{{ $user->id }}">
                @csrf
                {{ method_field('delete') }}
              <button type="submit" onclick="return confirm('Da li ste sigurni?')" class="btn btn-danger btn-sm">Izbriši <i class="fa fa-trash"></i></button>
              </form>
          </div>
      </div>
    </div>
    
  @endforeach
  
  </div>
</div>           
@endsection