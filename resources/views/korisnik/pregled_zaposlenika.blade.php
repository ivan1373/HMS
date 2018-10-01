@extends('administracija.dashboard')
@section('header')
<div class="jumbotron text-center">
  <h1>PREGLED KORISNIKA</h1>
</div>
@endsection
@section('content')
<div class="container">
    <ul class="nav nav-tabs" id="myTab" role="tablist" style="font-weight:bold;">
      <li class="nav-item">
        <a class="nav-link active bg-info" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Kartice</a>
      </li>&nbsp;
      <li class="nav-item">
        <a class="nav-link bg-dark" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Popis</a>
      </li>
    </ul>
</div><br>
<div class="tab-content" id="myTabContent">
<div class="container-fluid tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
  <div class="container tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      <br>
      <table class="table table-responsive tablesorter table-hover" align="center">
        <thead class="bg-secondary">
          <tr>
            <th>Ime <i class="fa fa-sort"></i></th>
            <th>E-mail <i class="fa fa-sort"></i></th>
            <th>Vrsta računa <i class="fa fa-sort"></i></th>
            <th>Radnja</th>
          </tr>
        </thead>
        <tbody id="myTable">
        @forelse($users as $user)
          <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>@if( $user->isregular == '1' && $user->isadmin == '1' )
                SUPERADMINISTRATOR
                @elseif( $user->isregular && $user->isadmin != '1')
                STANDARDNI
                @else
                ADMINISTRATOR
                @endif
            </td>
            <td>
                <a href="{{ url('/admin/pregled_korisnika/detalji/') }}/{{$user->id}}" class="btn btn-info">Detalji/ Postavke <i class="fa fa-info"></i></a>
                <form method="post" action="{{ url('/admin/pregled_korisnika/brisi/')}}/{{ $user->id }}">
                  @csrf
                  {{ method_field('delete') }}
                <button type="submit" onclick="return confirm('Da li ste sigurni?')" class="btn btn-danger btn-sm">Izbriši <i class="fa fa-trash"></i></button>
                </form>
            </td>
          </tr>
        @empty
          <p>Trenutno nema korisnika</p>
        @endforelse
        </tbody>
      </table>
    </div>
</div>      
@endsection